<?php

namespace App\Ai\Agents;

use Illuminate\Contracts\JsonSchema\JsonSchema;
use Laravel\Ai\Contracts\Agent;
use Laravel\Ai\Contracts\Conversational;
use Laravel\Ai\Contracts\HasStructuredOutput;
use Laravel\Ai\Contracts\HasTools;
use Laravel\Ai\Contracts\Tool;
use Laravel\Ai\Messages\Message;
use Laravel\Ai\Promptable;
use Stringable;

class RepurposeStructuredAgent implements Agent, Conversational, HasStructuredOutput, HasTools
{
    use Promptable;

    public function instructions(): Stringable|string
    {
        return <<<'PROMPT'
You are an expert technical content writer.

Transform the provided raw technical content into a high-quality X (Twitter) post.

Rules:
- Do not invent facts.
- Keep the hook under 280 characters.
- Return between 3 and 5 body points.
- Suggest at most one hashtag.
- Give a technical readability score between 0 and 100.
- Explain briefly why the generated post matches the requested tone.

Return ONLY structured data matching the schema.
PROMPT;
    }

    public function schema(JsonSchema $schema): array
    {
        return [
            'hook_propose' => $schema->string()->required(),

            'body_points' => $schema
                ->array()
                ->items($schema->string())
                ->required(),

            'technical_readability_score' => $schema
                ->integer()
                ->required(),

            'suggested_hashtags' => $schema
                ->array()
                ->items($schema->string())
                ->required(),

            'tone_compliance_justification' => $schema
                ->string()
                ->required(),
        ];
    }

    /**
     * @return Message[]
     */
    public function messages(): iterable
    {
        return [];
    }

    /**
     * @return Tool[]
     */
    public function tools(): iterable
    {
        return [];
    }
}