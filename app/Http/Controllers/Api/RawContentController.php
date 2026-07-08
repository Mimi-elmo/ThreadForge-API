<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRawContentRequest;
use App\Http\Resources\RawContentResource;
use App\Jobs\GeneratePostJob;
use App\Models\RawContent;

class RawContentController extends Controller
{
    public function store(StoreRawContentRequest $request)
    {
        $rawContent = RawContent::create([
            'user_id' => auth()->id(),
            'blueprint_id' => $request->blueprint_id,
            'content' => $request->content,
            'status' => 'pending',
        ]);

        GeneratePostJob::dispatch($rawContent);

        return response()->json([
            'message' => 'Content accepted for processing',
            'data' => new RawContentResource($rawContent),
        ], 202);


    }
}
