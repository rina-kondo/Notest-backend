<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\NoteResource;

class NoteGroupResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        /**
         * Transform the resource into an array.
         *
         * @param  \Illuminate\Http\Request  $request
         * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
         */
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'title' => $this->title,
            'save_duration' => $this->save_duration,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'notes' => NoteResource::collection($this->whenLoaded('notes'))
        ];
    }
}
