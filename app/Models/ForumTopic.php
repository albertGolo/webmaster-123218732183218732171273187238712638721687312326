<?php

namespace App\Models;

use App\Models\ForumThread;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ForumTopic extends Model
{
    use HasFactory;

    protected $table = 'forum_topics';

    protected $fillable = [
        'name',
        'description',
        'home_page_priority',
        'is_staff_only_viewing',
        'is_staff_only_posting'
    ];

    public function threads($hasPagination = true)
    {
        if (Auth::check() && Auth::user()->isStaff())
            $threads = ForumThread::where('topic_id', '=', $this->id)->orderBy('is_pinned', 'DESC')->orderBy('updated_at', 'DESC');
        else
            $threads = ForumThread::where([
                ['topic_id', '=', $this->id],
                ['is_deleted', '=', false]
            ])->orderBy('is_pinned', 'DESC')->orderBy('updated_at', 'DESC');

        return ($hasPagination) ? $threads->paginate(15) : $threads->get();
    }

    public function lastPost()
    {
        return Cache::remember("forum_topic:{$this->id}:last_post", 300, fn () => ForumThread::where([
            ['topic_id', '=', $this->id],
            ['is_deleted', '=', false]
        ])->orderBy('updated_at', 'DESC')->first());
    }

    public function slug()
    {
        return Str::slug($this->name);
    }
}
