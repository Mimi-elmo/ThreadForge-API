<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blueprint extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'target_audience',
        'tone',
        'max_characters',
        'max_hashtags',
        'rules',
    ];

    protected $casts = [
        'rules' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}