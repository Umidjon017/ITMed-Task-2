<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AppointmentResource extends JsonResource
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
            "identifier" => [
                "use"       => $this->identifier_use,
                "type"      => $this->identifier_type,
                "system"    => $this->identifier_system,
                "value"     => $this->identifier_value,
                "period"    => [
                    "start" => $this->identifier_start,
                    "end"   => $this->identifier_end,
                ],
                "assigner"  => $this->identifier_assigner,
            ],
            'status' => $this->status,
            'participant' => [
                [
                    'actor_1' => [
                        'reference' => 'Practitioner/'.$this->participant_1,
                    ],
                    'actor_2' => [
                        'reference' => 'Patient/'.$this->participant_2,
                    ],
                ]
            ],
            'performer' => [
                'refence' => 'Organization/'.$this->performer,
            ],
        ];
    }
}
