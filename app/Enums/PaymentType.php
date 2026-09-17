<?php

namespace App\Enums;

/**
 * Тип платежа мастера за подписку.
 *
 * card, sbp — настоящие деньги; promo, trial — без денег (amount = 0).
 */
enum PaymentType: string
{
    case Card = 'card';
    case Sbp = 'sbp';
    case Promo = 'promo';
    case Trial = 'trial';

    /** Платёж настоящими деньгами. */
    public function isMonetary(): bool
    {
        return in_array($this, [self::Card, self::Sbp], true);
    }
}
