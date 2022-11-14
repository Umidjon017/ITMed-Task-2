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
                "use" => "secondary",
                "type" => "RI",
                "system" => "http://some-company.uz",
                "value" => "84052",
                "period" => [
                    "start" => "2022-05-18",
                    "end" => null
                ],
                "assigner" => "SomeCompany LLC",
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
