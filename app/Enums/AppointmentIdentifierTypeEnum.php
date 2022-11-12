<?php

namespace App\Enums;

enum AppointmentIdentifierTypeEnum:string
{
    case DL     = 'DL';
    case PPN    = 'PPN';
    case TPPN   = 'TPPN';
    case MNUZB  = 'NNUZB';
    case RED    = 'REO';
    case TAX    = 'TAX';
    case CZ     = 'CZ';
    case BCT    = 'BCT';
    case RI     = 'RI';
}
