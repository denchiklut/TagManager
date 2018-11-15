<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class AnaliticsResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'url' => $this->url,
            'hach' => $this->hach,
            'call' => $this->call,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}