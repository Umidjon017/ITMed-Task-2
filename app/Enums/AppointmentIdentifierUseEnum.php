<?php

namespace App\Enums;

enum AppointmentIdentifierUseEnum:string
{
    case USUAL      =   'usual';
    case OFFICIAL   =   'official';
    case TEMP       =   'temp';
    case SECONDARY  =   'secondary';
    case OLD        =   'old';
}
