<?php

namespace App;

use App\QueryFilters\Posts\Active;
use App\QueryFilters\Posts\MaxCount;
use App\QueryFilters\Posts\Sort;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pipeline\Pipeline;

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

    // Pipelines. Lesson 6.
    // NOTE: Pagination and max_count will not work together
    // because pagination overwrites the limit() method!
    public static function getPosts()
    {
        return app(Pipeline::class)
            ->send(Post::query())
            ->through([
                Active::class,
                Sort::class,
                MaxCount::class,
            ])
            ->thenReturn()
            ->paginate(5);
    }
}
