<?php

namespace App\Enums;

/**
 * Статус начисления за реферала.
 */
enum ReferralEarningStatus: string
{
    /** Начислено, ожидает выплаты. */
    case Pending = 'pending';

    /** Выплачено. */
    case Paid = 'paid';
}
