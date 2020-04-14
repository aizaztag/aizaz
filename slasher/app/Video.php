<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    public function watchable()
    {
        return $this->morphTo();
    }

    public function tags()
    {
        return $this->belongsToMany(Video::class , 'tag_video' , 'video_id' , 'tag_id');
    }
}
