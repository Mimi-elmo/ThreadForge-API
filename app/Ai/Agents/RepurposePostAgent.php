<?php

namespace App\Ai\Agents;

use Laravel\Ai\Contracts\Agent;
use Laravel\Ai\Contracts\Conversational;
use Laravel\Ai\Contracts\HasTools;
use Laravel\Ai\Contracts\Tool;
use Laravel\Ai\Messages\Message;
use Laravel\Ai\Promptable;
use Stringable;

class RepurposePostAgent implements Agent, Conversational, HasTools
{
    use Promptable;

    /**
     * Get the instructions that the agent should follow.
     */
    public function instructions(): Stringable|string
    {
            return <<<'PROMPT'
    You are an expert technical content writer.

    Transform the provided raw technical content into a Twitter/X post.

    Always return:

    - A strong hook.
    - 3 to 5 concise body points.
    - A technical readability score from 0 to 100.
    - Maximum one hashtag.
    - A short explanation of how well the tone matches the requested style.

    Never invent facts.
    PROMPT;
        }

        /**
         * Get the list of messages comprising the conversation so far.
     *
     * @return Message[]
     */
    public function messages(): iterable
    {
        return [];
    }

    /**
     * Get the tools available to the agent.
     *
     * @return Tool[]
     */
    public function tools(): iterable
    {
        return [];
    }
}
