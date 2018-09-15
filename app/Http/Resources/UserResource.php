<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'id' => $this->id,
            'name' => $this->name,
            'username' => $this->username,
            'email' => $this->email,
            'dob' => $this->dob,
            'gender' => $this->gender,
            'dbs' => $this->dbs_num,
            'profile_image' => $this->profile_image,
            'role' => $this->role,
            'Supportworker' => $this->support_worker,
            'sessions' => $this->sessions,
        ];
    }
}
