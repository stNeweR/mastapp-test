<?php

namespace App\UseCases\Referral\GetEarningsSummary;

use App\Enums\ReferralEarningStatus;
use App\Enums\ReferralStatus;
use App\Models\Referral;
use App\Models\ReferralEarning;

/**
 * Сводка по реферальным деньгам текущего мастера.
 */
class GetEarningsSummaryUseCase
{
    public function handle(GetEarningsSummaryDTO $dto): EarningsSummaryDTO
    {
        $earnings = ReferralEarning::where('referrer_master_id', $dto->master->id);

        return new EarningsSummaryDTO(
            total: (int) (clone $earnings)->sum('amount'),
            pending: (int) (clone $earnings)
                ->where('status', ReferralEarningStatus::Pending)
                ->sum('amount'),
            paid: (int) (clone $earnings)
                ->where('status', ReferralEarningStatus::Paid)
                ->sum('amount'),
            rewardedReferrals: Referral::where('referrer_master_id', $dto->master->id)
                ->where('status', ReferralStatus::Rewarded)
                ->count(),
        );
    }
}
