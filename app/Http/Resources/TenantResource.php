<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class TenantResource extends JsonResource
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
            "name" => $this->name,
            'image' => $this->logo ? url("storage/{$this->logo}") : null,
            "uuid" => $this->uuid,
            "url" => $this->url,
            "contact" => $this->email,
            "created_at" => Carbon::parse($this->created_at)->format('d/m/Y'),
            
           
            // "cnpj" => $this->cnpj,
            // "logo" => $this->logo,
            // "active" => $this->active,
            // "subscription" => $this->subscription,
            // "expires_at" => $this->expires_at,
            // "subscription_id" => $this->subscription_id,
            // "subscription_active" => $this->subscription_active,
            // "subscription_suspended" => $this->subscription_suspended,
            
        ];
    }
}
