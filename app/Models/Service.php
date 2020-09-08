<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'name',
        'active',
        'image'
    ];

    // Lesson 18. Set default attributes when creating new service (4:45).
    // This attribute will be set to default in DB no matter what you set it in the controller
//    protected $attributes = [
//        'active' => 0
//    ];

    // Lesson 15. Accessor (11:10)
    public function getActiveAttribute($attribute)
    {
        return [
            0 => 'Inactive',
            1 => 'Active'
        ][$attribute];
    }
}
