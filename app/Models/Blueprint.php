<?php

namespace App\Models;

use Database\Factories\BlueprintFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blueprint extends Model
{
    /** @use HasFactory<BlueprintFactory> */
    use HasFactory;
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

    public function rawContents()
    {
        return $this->hasMany(RawContent::class);
    }
}