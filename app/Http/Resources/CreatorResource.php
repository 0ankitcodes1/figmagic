<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CreatorResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "name" => $this->name,
            "email" => $this->email,
            "companyName" => $this->companyName,
            "role" => $this->role,
            "profilePic" => $this->profilePic,
            "apiLimiter" => $this->apiLimiter,
            "shareCount" => $this->shareCount,
            "status" => $this->status,
            "identifier" => $this->identifier,
        ];
    }
}
