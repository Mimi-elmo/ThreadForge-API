<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBlueprintRequest;
use App\Http\Requests\UpdateBlueprintRequest;
use App\Http\Resources\BlueprintResource;
use App\Models\Blueprint;

class BlueprintController extends Controller
{
    public function index()
    {
        $blueprints = Blueprint::where('user_id', auth()->id())
            ->latest()
            ->get();

        return BlueprintResource::collection($blueprints);
    }

    public function store(StoreBlueprintRequest $request)
    {
        $blueprint = Blueprint::create([
            'user_id' => auth()->id(),
            ...$request->validated(),
        ]);

        return new BlueprintResource($blueprint);
    }

    public function show(Blueprint $blueprint)
    {
        $this->authorizeBlueprint($blueprint);

        return new BlueprintResource($blueprint);
    }

    public function update(UpdateBlueprintRequest $request, Blueprint $blueprint)
    {
        $this->authorizeBlueprint($blueprint);

        $blueprint->update($request->validated());

        return new BlueprintResource($blueprint);
    }

    public function destroy(Blueprint $blueprint)
    {
        $this->authorizeBlueprint($blueprint);

        $blueprint->delete();

        return response()->json([
            'message' => 'Blueprint deleted'
        ]);
    }

    private function authorizeBlueprint(Blueprint $blueprint)
    {
        abort_if($blueprint->user_id !== auth()->id(), 403);
    }
}