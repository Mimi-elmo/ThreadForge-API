<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RawContent extends Model
{
    protected $fillable = [
        'user_id',
        'blueprint_id',
        'content',
        'status',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function blueprint()
    {
        return $this->belongsTo(Blueprint::class);
    }


    public function post()
    {
        return $this->hasOne(Post::class);
    }
}