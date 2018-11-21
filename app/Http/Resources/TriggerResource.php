<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class TriggerResource extends Resource
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
            'id_campaign' => $this->id_campaign,
            'trigger' => $this->trigger,
            'new_campaign' => $this->new_campaign,
            'templates' => $this->templates,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
