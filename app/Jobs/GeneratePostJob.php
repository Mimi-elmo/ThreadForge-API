<?php

namespace App\Jobs;

use App\Ai\Agents\RepurposeStructuredAgent;
use App\Models\Post;
use App\Models\RawContent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class GeneratePostJob implements ShouldQueue
{
    use Queueable, InteractsWithQueue, SerializesModels;

    public function __construct(
        public RawContent $rawContent
    ) {
    }

    public function handle(): void
    {
        $response = (new RepurposeStructuredAgent)->prompt(
            $this->rawContent->content
        );

        $data = $response->structured;

        Post::create([
            'user_id' => $this->rawContent->user_id,
            'blueprint_id' => $this->rawContent->blueprint_id,
            'raw_content_id' => $this->rawContent->id,

            'hook_propose' => $data['hook_propose'],
            'body_points' => $data['body_points'],
            'technical_readability_score' => $data['technical_readability_score'],
            'suggested_hashtags' => $data['suggested_hashtags'],
            'tone_compliance_justification' => $data['tone_compliance_justification'],

            'status' => 'draft',
        ]);

        $this->rawContent->update([
            'status' => 'completed',
        ]);
    }
}