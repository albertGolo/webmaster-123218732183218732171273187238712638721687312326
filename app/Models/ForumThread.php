<?php

namespace App\Models;

use App\Models\ForumReply;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ForumThread extends Model
{
    use HasFactory;

    protected $table = 'forum_threads';

    protected $fillable = [
        'topic_id',
        'creator_id',
        'title',
        'body'
    ];

    public function creator()
    {
        return $this->belongsTo('App\Models\User', 'creator_id');
    }

    public function topic()
    {
        return $this->belongsTo('App\Models\ForumTopic', 'topic_id');
    }

    public function replies($hasPagination = true)
    {
        if (Auth::check() && Auth::user()->isStaff())
            $replies = ForumReply::where('thread_id', '=', $this->id)->orderBy('created_at', 'ASC');
        else
            $replies = ForumReply::where([
                ['thread_id', '=', $this->id],
                ['is_deleted', '=', false]
            ])->orderBy('created_at', 'ASC');

        return ($hasPagination) ? $replies->paginate(10) : $replies->get();
    }

    public function lastReply()
    {
        return Cache::remember("forum_thread:{$this->id}}:last_reply", 30, fn () => ForumReply::where('thread_id', '=', $this->id)->orderBy('created_at', 'DESC')->first());
    }
}
