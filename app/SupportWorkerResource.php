<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class SupportWorkerResource extends JsonResource
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
            'contract_type' => $this->contract_type,
            'availability' => json_decode($this->availability),
            'specialities' => json_decode($this->specialities),
            'user' => $this->user,
            'sessions' => $this->sessions,
        ];
    }
}
