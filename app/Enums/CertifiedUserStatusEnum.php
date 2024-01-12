<?php

namespace App\Enums;

enum CertifiedUserStatusEnum:string
{
    case NEW = 'new';
    case INITIAL_ACCEPTANCE = 'initial_acceptance';
    case APPROVED = 'approved';

    case REJECTED = 'rejected';
}
