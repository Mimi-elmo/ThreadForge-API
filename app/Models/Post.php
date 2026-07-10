<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'user_id',
        'blueprint_id',
        'raw_content_id',
        'hook_propose',
        'body_points',
        'technical_readability_score',
        'suggested_hashtags',
        'tone_compliance_justification',
        'status',
    ];

    protected $casts = [
        'body_points' => 'array',
        'suggested_hashtags' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function blueprint()
    {
        return $this->belongsTo(Blueprint::class);
    }
    public function rawContent()
    {
        return $this->belongsTo(RawContent::class);
    }       
}