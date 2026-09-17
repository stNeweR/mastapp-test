<?php

namespace App\Enums;

/**
 * Статус привязки реферала.
 */
enum ReferralStatus: string
{
    /** Привязан, но вознаграждение ещё не начислено. */
    case Pending = 'pending';

    /** Засчитан: вознаграждение начислено. */
    case Rewarded = 'rewarded';
}
