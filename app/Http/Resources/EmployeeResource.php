<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        //return parent::toArray($request);
        return [
            'id'   => $this->id,
            'name' => $this->name . ' ' . $this->lastname,
            'email' => $this->email,
            'extension' => $this->extension,
            'jobtitle' => $this->jobtitle,
            'sector' => $this->sector,
            'birth_date' => $this->birth_date,
            'created_at' => $this->created_at->toDateString(),
        ];
    }
}
