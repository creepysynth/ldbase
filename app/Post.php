<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['title', 'body'];

    // one to one
    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }

    // one to many
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    // many to many
    // If you want your pivot table to have automatically maintained created_at and updated_at timestamps,
    // use the withTimestamps() method on the relationship definition.
    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable')->withTimestamps();
    }
}
