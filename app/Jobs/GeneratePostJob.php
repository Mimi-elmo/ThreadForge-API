<?php

namespace App\Jobs;
use App\Models\RawContent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;


class GeneratePostJob implements ShouldQueue
{
    use Queueable;

    public function __construct(
        public RawContent $rawContent
    ) {}

    public function handle(): void
    {
        logger('Generating post for RawContent ID: '.$this->rawContent->id);
    }
}