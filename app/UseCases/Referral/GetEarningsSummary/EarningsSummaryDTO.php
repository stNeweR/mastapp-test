<?php

namespace App\UseCases\Referral\GetEarningsSummary;

/**
 * Сводка по реферальным деньгам мастера.
 */
final readonly class EarningsSummaryDTO
{
    public function __construct(
        /** Всего начислено. */
        public int $total,
        /** В ожидании выплаты. */
        public int $pending,
        /** Выплачено. */
        public int $paid,
        /** Сколько рефералов засчитано. */
        public int $rewardedReferrals,
    ) {
    }
}
