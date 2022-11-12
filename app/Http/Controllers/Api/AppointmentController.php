<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\Appointment;
use App\Enums\AppointmentStatusEnum;
use App\Http\Controllers\BaseController;
use App\Http\Requests\StoreAppointmentRequest;
use App\Http\Resources\AppointmentResource;
use App\Http\Requests\UpdateAppointmentRequest;

class AppointmentController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $appointment = AppointmentResource::collection(Appointment::all());
        $response = [
            'count' =>  count(Appointment::all()),
            'data'  =>  [
                'appointment'   =>  $appointment,
            ]
        ];
        return response()->json($response, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAppointmentRequest $request)
    {
        $data = $request->all();
        $data['status'] = $request->status ? $request->status : AppointmentStatusEnum::BOOKED;
        $data['participant_1'] = $request->participant_1 ? $request->participant_1 : User::pluck('id')->random();
        $data['participant_2'] = $request->participant_2 ? $request->participant_2 : User::pluck('id')->random();
        $data['performer'] = $request->performer ? $request->performer : User::pluck('id')->random();
        $appointment = Appointment::create($data);
        return $this->sendResponse(new AppointmentResource($appointment), 'Appointment created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $filter = Appointment::where('id', $id)->get();
        $appointment = AppointmentResource::collection($filter);
        $response = [
            'data'  =>  [
                'appointment'   =>  $appointment,
            ]
        ];
        return response()->json($response, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function showByPartsOrOrg($id)
    {
        $filter = Appointment::where('participant_1', $id)
                    ->orWhere('participant_2', $id)
                    ->orWhere('performer', $id)
                    ->get();
        $appointment = AppointmentResource::collection($filter);
        $response = [
            'data'  =>  [
                'count' =>  count($appointment),
                'appointment'   =>  $appointment,
            ]
        ];
        return response()->json($response, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAppointmentRequest $request, $id)
    {
        // Must to create repos here to modify, clearify and make faster the update method of the controller
        $appointment = Appointment::findOrFail($id);
        $status = $request->status;
        if($appointment)
        {
            if($status == 'arrived')
            {
                if($appointment->status->value == 'booked' && $appointment->status->value != 'fulfilled' && $appointment->status->value != 'cancelled' && $appointment->status->value != 'arrived')
                {
                    $appointment->update(['status' => $status]);
                    return $this->sendResponse(new AppointmentResource($appointment), 'Patient arrived successfully.');
                }
                elseif($appointment->status->value == 'arrived' && $appointment->status->value != 'booked' && $appointment->status->value != 'fulfilled' && $appointment->status->value != 'cancelled')
                {
                    return $this->sendError('Error.', ["When status is 'arrived', you can only change it into 'cancelled' or 'fulfilled"]);
                }
                elseif($appointment->status->value == 'fulfilled' && $appointment->status->value != 'booked' && $appointment->status->value != 'cancelled' && $appointment->status->value != 'arrived')
                {
                    return $this->sendError('Error.', ["When status is 'fulfilled', you can not change it"]);
                }
                elseif($appointment->status->value == 'cancelled' && $appointment->status->value != 'booked' && $appointment->status->value != 'fulfilled' && $appointment->status->value != 'arrived')
                {
                    return $this->sendError('Error.', ["When status is 'cancelled', you can not change it"]);
                }
                else {
                    return $this->sendError('Error.', ['The status you wanted is not a valid.']);
                }
            }
            elseif($status == 'cancelled')
            {
                if($appointment->status->value == 'booked' && $appointment->status->value != 'fulfilled' && $appointment->status->value != 'cancelled' && $appointment->status->value != 'arrived')
                {
                    $appointment->update(['status' => $status]);
                    return $this->sendResponse(new AppointmentResource($appointment), 'Appointment cancelled successfully.');
                }
                elseif ($appointment->status->value == 'arrived' && $appointment->status->value != 'fulfilled' && $appointment->status->value != 'booked' && $appointment->status->value != 'cancelled')
                {
                    $appointment->update(['status' => $status]);
                    return $this->sendResponse(new AppointmentResource($appointment), 'Appointment cancelled successfully after patient has arrived.');
                }
                elseif ($appointment->status->value == 'fulfilled' && $appointment->status->value != 'arrived' && $appointment->status->value != 'booked' && $appointment->status->value != 'cancelled')
                {
                    return $this->sendError('Error.', ["When status is 'fulfilled', you can not change it"]);
                }
                elseif ($appointment->status->value == 'cancelled' && $appointment->status->value != 'arrived' && $appointment->status->value != 'booked' && $appointment->status->value != 'fulfilled')
                {
                    return $this->sendError('Error.', ["When status is 'cancelled', you can not change it"]);
                }
                else {
                    return $this->sendError('Error.', ['The status you wanted is not a valid.']);
                }
            }
            elseif ($status == 'fulfilled')
            {
                if ($appointment->status->value == 'arrived' && $appointment->status->value != 'fulfilled' && $appointment->status->value != 'booked' && $appointment->status->value != 'cancelled')
                {
                    $appointment->update(['status' => $status]);
                    return $this->sendResponse(new AppointmentResource($appointment), 'Appointment fulfilled successfully.');
                }
                elseif ($appointment->status->value == 'booked' && $appointment->status->value != 'fulfilled' && $appointment->status->value != 'cancelled' && $appointment->status->value != 'arrived')
                {
                    return $this->sendError('Error.', ["When status is 'booked', you can only change it into 'arrived' or 'cancelled'"]);
                }
                elseif ($appointment->status->value == 'fulfilled' && $appointment->status->value != 'arrived' && $appointment->status->value != 'booked' && $appointment->status->value != 'cancelled')
                {
                    return $this->sendError('Error.', ["When status is 'fulfilled', you can not change it"]);
                }
                elseif ($appointment->status->value == 'cancelled' && $appointment->status->value != 'arrived' && $appointment->status->value != 'booked' && $appointment->status->value != 'fulfilled')
                {
                    return $this->sendError('Error.', ["When status is 'cancelled', you can not change it"]);
                }
                else {
                    return $this->sendError('Error.', ['The status you wanted is not a valid.']);
                }
            }
            elseif ($status == 'booked')
            {
                return $this->sendError('Error.', ["The 'booked' status has been given for new appointments only"]);
            }
            else {
                return $this->sendError('Error.', ['The status you wanted is not a valid.']);
            }
        }
        else {
            return $this->sendError('Error.', ["The appointment, you want to update, does not exist"]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Appointment $appointment)
    {
        $appointment->delete();
        return response(null, 204);
    }
}
