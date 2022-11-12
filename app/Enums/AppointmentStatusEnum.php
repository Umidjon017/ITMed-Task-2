<?php

namespace App\Enums;

enum AppointmentStatusEnum:string
{
    case PROPOSED   =   'proposed';
    case PENDING    =   'pending';
    case BOOKED     =   'booked';
    case ARRIVED    =   'arrived';
    case FULFILLED  =   'fulfilled';
    case CANCELLED  =   'cancelled';
    case NOSHOW     =   'noshow';
    case ENTERED_IN_ERROR   =   'entered-in-error';
    case CHECKED_IN =   'checked-in';
    case WAITLIST   =   'waitlist';
}
