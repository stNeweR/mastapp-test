<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Сводка по реферальным деньгам — GET /api/referrals/earnings.
 *
 * @mixin \App\UseCases\Referral\GetEarningsSummary\EarningsSummaryDTO
 */
class EarningsSummaryResource extends JsonResource
{
    /**
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'total' => $this->total,
            'pending' => $this->pending,
            'paid' => $this->paid,
            'rewarded_count' => $this->rewardedReferrals,
        ];
    }
}
