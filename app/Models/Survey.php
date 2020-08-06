<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
    protected $fillable = [
        'name',
        'email'
    ];

    public function questionnaire()
    {
        return $this->belongsTo(Questionnaire::class);
    }

    public function responses()
    {
        return $this->hasMany(SurveyResponse::class);
    }
}
