<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'name',
        'active'
    ];

    // Lesson 18. Set default attributes when create new service (4:45)
    protected $attributes = [
        'active' => 0
    ];

    // Lesson 15. Accessor (11:10)
    public function getActiveAttribute($attribute)
    {
        return [
            0 => 'Inactive',
            1 => 'Active'
        ][$attribute];
    }
}
