<?php

namespace App\Enums;

use App\Traits\EnumToArray;

enum ApprovalStatus: string
{
    use EnumToArray;

    case Pending = 'Pending';
    case Approved = 'Approved';
    case Rejected = 'Rejected';
}
