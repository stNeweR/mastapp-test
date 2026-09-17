<?php

namespace App\UseCases\Referral\GetMyReferrals;

use App\Models\Referral;
use Illuminate\Database\Eloquent\Collection;

/**
 * Список приведённых мастером рефералов с суммами начислений.
 */
class GetMyReferralsUseCase
{
    /**
     * @return Collection<int, Referral> привязки с подгруженным referredMaster
     *                                  и агрегатом earnings_sum_amount
     */
    public function handle(GetMyReferralsDTO $dto): Collection
    {
        return Referral::query()
            ->where('referrer_master_id', $dto->master->id)
            ->with('referredMaster')
            ->withSum('earnings', 'amount')
            ->latest()
            ->get();
    }
}
