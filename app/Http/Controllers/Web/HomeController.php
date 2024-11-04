<?php

namespace App\Http\Controllers\Web;

use App\Models\Item;
use App\Models\Inventory;
use App\Models\Status;
use App\Models\ForumThread;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    public function index()
    {
        return view('web.home.index');
    }

    public function dashboard()
    {
        return view('web.home.dashboard')->with([
            'statuses' => Cache::remember('statuses', 600, fn () => Status::where('message', '!=', null)->orderBy('created_at', 'DESC')->take(10)->get()),
            'updates' => Cache::remember('updates', 600, fn () => ForumThread::where([
                ['topic_id', '=', config('site.updates_forum_topic_id')],
                ['is_deleted', '=', false]
            ])->orderBy('created_at', 'DESC')->get()->take(5)),
        ]);
    }

    public function admin()
    {
        $item = config('site.fake_admin_item_id');

        if (!$item) abort(404);

        $item = Item::where('id', '=', $item)->firstOrFail();

        if (!Auth::user()->ownsItem($item->id)) {
            $inventory = new Inventory;
            $inventory->user_id = Auth::user()->id;
            $inventory->item_id = $item->id;
            $inventory->save();
        }

        return redirect()->route('catalog.item', [$item->id, $item->slug()]);
    }
    public function status(Request $request)
    {
        $this->validate($request, [
            'message' => ['max:124']
        ]);

        if ($request->message != Auth::user()->status()) {
            $status = new Status;
            $status->creator_id = Auth::user()->id;
            $status->message = $request->message;
            $status->save();

            Cache::forget('statuses');
        }

        return back()->with('success_message', 'Status has been changed.');
    }
}
