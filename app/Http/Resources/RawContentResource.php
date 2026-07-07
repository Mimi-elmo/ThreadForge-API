<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RawContentResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'blueprint_id' => $this->blueprint_id,
            'content' => $this->content,
            'status' => $this->status,
            'created_at' => $this->created_at,
        ];
    }
}
