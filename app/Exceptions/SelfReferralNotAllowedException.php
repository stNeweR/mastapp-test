<?php

namespace App\Exceptions;

use DomainException;

/**
 * Мастер пытается закрепиться за самим собой.
 */
class SelfReferralNotAllowedException extends DomainException
{
    public function __construct()
    {
        parent::__construct('Cannot attach to your own referral code.');
    }
}
