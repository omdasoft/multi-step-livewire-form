<?php

namespace App\Enums;

enum Role: string
{
    case ADMIN = 'Admin';
    case DOCTOR = 'Doctor';
}