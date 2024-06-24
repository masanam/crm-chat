<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ClientResource extends JsonResource
{
  public function toArray(Request $request): array
  {
    return [
      'id' => $this->id,
      'name' => $this->name,
      'email' => $this->email,
      'phone' => $this->phone,
      'meta_business' => $this->meta_business,
      'wa_business' => $this->wa_business,
      'quota' => $this->quota,
      'status' => $this->status,
      'logo' => $this->logo,
      'organization_id' => $this->organization_id,
      'organization' => [
        'name' => $this->organization->name,
        'website' => $this->organization->website,
        'address' => $this->organization->address,
        'description' => $this->organization->description,
        'industry' => $this->organization->industry,
        'use_case' => $this->organization->use_case,
        'number_of_team_members' => $this->organization->number_of_team_members,
      ],
    ];
  }
}
