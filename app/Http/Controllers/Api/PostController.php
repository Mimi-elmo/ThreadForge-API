<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(
            Post::where('user_id', auth()->id())->latest()->get()
        );  
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'blueprint_id' => ['nullable', 'exists:blueprints,id'],
            'hook_propose' => ['required', 'string'],
            'body_points' => ['nullable', 'array'],
            'technical_readability_score' => ['nullable', 'integer', 'min:0', 'max:100'],
            'suggested_hashtags' => ['nullable', 'array'],
            'tone_compliance_justification' => ['nullable', 'string'],
        ]);

        $post = Post::create([
            'user_id' => auth()->id(),
            ...$validated,
            'status' => 'draft',
        ]);

        return response()->json($post, 201);
    }

    /**
     * Display the specified resource.
     */
        public function show(Post $post)    {
         return response()->json($post);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $post->update($request->only([
            'hook_propose',
            'body_points',
            'technical_readability_score',
            'suggested_hashtags',
            'tone_compliance_justification',
            'status'
        ]));
        return response()->json($post);
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();

        return response()->json([
            'message' => 'Post deleted successfully'
        ]);
    }
}
