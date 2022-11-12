<?php

namespace App\Models;

use App\Traits\Uuids;
use App\Enums\AppointmentStatusEnum;
use App\Enums\AppointmentIdentifierUseEnum;
use App\Enums\AppointmentIdentifierTypeEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Appointment extends Model
{
    use HasFactory, Uuids;

    protected $fillable = [
        'identifier_use',
        'identifier_type',
        'identifier_system',
        'identifier_value',
        'identifier_start',
        'identifier_end',
        'identifier_assigner',
        'status',
        'participant_1',
        'participant_2',
        'performer',
    ];

    /**
     * Write code on Method
     *
     * @return response()
     */
    protected $casts = [
        'status' => AppointmentStatusEnum::class,
        'identifier_use' => AppointmentIdentifierUseEnum::class,
        'identifier_type' => AppointmentIdentifierTypeEnum::class,
    ];
}
