<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class NoteResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'note_group_id' => $this->note_group_id,
            'body' => $this->body,
            'is_saved' => $this->is_saved,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
