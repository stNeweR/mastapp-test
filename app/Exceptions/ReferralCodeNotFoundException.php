<?php

namespace App\Exceptions;

use DomainException;

/**
 * Реферальный код не найден.
 */
class ReferralCodeNotFoundException extends DomainException
{
    public function __construct(string $code)
    {
        parent::__construct("Referral code '{$code}' not found.");
    }
}
