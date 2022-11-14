<?php

namespace Database\Factories;

use App\Models\User;
use App\Enums\AppointmentStatusEnum;
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
        $users = User::pluck('id')->random();
        return [
            'status' => AppointmentStatusEnum::BOOKED,
            'participant_1' => $users,
            'participant_2' => $users,
            'performer' => $users,
        ];
    }
}
