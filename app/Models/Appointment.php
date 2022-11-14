<?php

namespace App\Models;

use App\Traits\Uuids;
use App\Enums\AppointmentStatusEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Appointment extends Model
{
    use HasFactory, Uuids;

    protected $fillable = [
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
    ];
}
