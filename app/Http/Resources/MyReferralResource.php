<?php

namespace App\Http\Resources;

use App\Enums\ReferralStatus;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Элемент списка приведённых мастеров — GET /api/referrals/my.
 *
 * @mixin \App\Models\Referral
 */
class MyReferralResource extends JsonResource
{
    /**
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'name' => $this->referredMaster->name,
            'attached_at' => $this->created_at->toIso8601String(),
            'counted' => $this->status === ReferralStatus::Rewarded,
            'earned' => (int) $this->earnings_sum_amount,
        ];
    }
}
