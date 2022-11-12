<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\User;
use App\Enums\AppointmentStatusEnum;
use App\Enums\AppointmentIdentifierUseEnum;
use App\Enums\AppointmentIdentifierTypeEnum;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Appointment>
 */
class AppointmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $users = User::pluck('id');
        $participants = [$users->first(), $users->last()];
        return [
            'identifier_use'    => AppointmentIdentifierUseEnum::OFFICIAL,
            'identifier_type'   => AppointmentIdentifierTypeEnum::DL,
            'identifier_system' => fake()->domainName(),
            'identifier_value'  => Str::random(5),
            'identifier_start'  => now(),
            'identifier_end'    => null,
            'identifier_assigner'   => fake()->company(),
            'status' => AppointmentStatusEnum::BOOKED,
            'participant_1' => $users->last(),
            'participant_2' => $users->first(),
            'performer' => $users->first(),
        ];
    }
}
