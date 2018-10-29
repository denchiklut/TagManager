<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class ComponyResource extends Resource
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
            'id_client' => $this->id_client,
            'id_campaign' => $this->id_campaign,
            'password' => $this->password,
            'signature' => $this->signature,
            'sig' => $this->sig,
            'url' => $this->url,
            'tm_id' => $this->tm_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}