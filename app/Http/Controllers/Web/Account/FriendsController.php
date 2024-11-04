<?php

namespace App\Http\Controllers\Web\Account;

use App\Models\User;
use App\Models\Friend;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class FriendsController extends Controller
{
    public function index()
    {
        $friendRequests = Cache::remember('user:'.Auth::user()->id.':friend_requests', 3600, fn () => Friend::where([
            ['receiver_id', '=', Auth::user()->id],
            ['is_pending', '=', true]
        ])->paginate(16));

        return view('web.account.friends')->with([
            'friendRequests' => $friendRequests
        ]);
    }

    public function update(Request $request)
    {
        $user = User::where('id', '=', $request->id)->firstOrFail();

        if ($user->id == Auth::user()->id) abort(404);

        switch ($request->action) {
            case 'accept':
                $friendRequest = Friend::where([
                    ['receiver_id', '=', Auth::user()->id],
                    ['sender_id', '=', $user->id],
                    ['is_pending', '=', true]
                ])->firstOrFail();
                $friendRequest->is_pending = false;
                $friendRequest->save();

                $this->flushCache($user->id);

                return back()->with('success_message', 'Friend request has been accepted.');
            case 'decline':
                $friendRequest = Friend::where([
                    ['receiver_id', '=', Auth::user()->id],
                    ['sender_id', '=', $user->id],
                    ['is_pending', '=', true]
                ])->firstOrFail();
                $friendRequest->delete();

                $this->flushCache($user->id);

                return back()->with('success_message', 'Friend request has been declined.');
            case 'send':
                if (!$user->setting->accepts_friends) abort(404);

                $isPending = Friend::where([
                    ['receiver_id', '=', Auth::user()->id],
                    ['sender_id', '=', $user->id],
                    ['is_pending', '=', true]
                ])->orWhere([
                    ['receiver_id', '=', $user->id],
                    ['sender_id', '=', Auth::user()->id],
                    ['is_pending', '=', true]
                ])->exists();

                if ($isPending)
                    return back()->withErrors(['You already have sent or recieved a friend request to or from this user.']);

                if ($this->areFriends($user->id))
                    return back()->withErrors(['You are already friends with this user.']);

                $friend = new Friend;
                $friend->receiver_id = $user->id;
                $friend->sender_id = Auth::user()->id;
                $friend->save();

                $this->flushCache($user->id);

                return back()->with('success_message', 'You have sent a friend request to this user!');
            case 'remove':
                if (!$this->areFriends($user->id))
                    return back()->withErrors(['You are not friends with this user.']);

                $friend = Friend::where('is_pending', '=', false)->where(function($query) use($user) {
                    $query->where([
                        ['receiver_id', '=', $user->id],
                        ['sender_id', '=', Auth::user()->id]
                    ])->orWhere([
                        ['receiver_id', '=', Auth::user()->id],
                        ['sender_id', '=', $user->id]
                    ]);
                })->first();
                $friend->delete();

                $this->flushCache($user->id);

                return back()->with('success_message', 'You have removed this user from your friends list.');
            default:
                abort(404);
        }
    }

    private function areFriends($userId)
    {
        $friendsArray = [];

        foreach (Auth::user()->friends() as $friend) {
            $friendsArray[] = $friend->id;
        }

        return in_array($userId, $friendsArray);
    }


    /** GHETTO !!!!!!!! */
    private function flushCache(int $userId)
    {
        $ids = [Auth::user()->id, $userId];

        foreach ($ids as $id) {
            Cache::forget("user:{$id}:friends");
            Cache::forget("user:{$id}:friend_requests");
            Cache::forget("user:{$id}:friend_request_count");
        }
    }
}
