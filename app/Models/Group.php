<?php

namespace App\Models;

use App\Models\GroupRank;
use App\Models\GroupMember;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Group extends Model
{
    use HasFactory;

    protected $table = 'groups';

    protected $fillable = [
        'owner_id',
        'name',
        'description',
        'thumbnail_url'
    ];

    public function owner()
    {
        return $this->belongsTo('App\Models\User', 'owner_id');
    }

    public function thumbnail()
    {
        if ($this->is_thumbnail_pending) {
            return asset('img/pending.png');
        } else if ($this->thumbnail_url == 'denied') {
            return asset('img/denied.png');
        }

        return Storage::url("thumbnails/{$this->thumbnail_url}.png");
    }

    public function slug()
    {
        return Str::slug($this->name);
    }

    public function members()
    {
        return GroupMember::where('group_id', '=', $this->id)->get();
    }

    public function ranks()
    {
        return GroupRank::where('group_id', '=', $this->id)->orderBy('rank', 'ASC')->get();
    }
}
