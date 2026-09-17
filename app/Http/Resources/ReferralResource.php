<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Привязка реферала — ответ на POST /api/referrals/attach.
 *
 * @mixin \App\Models\Referral
 */
class ReferralResource extends JsonResource
{
    /**
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'referrer_master_id' => $this->referrer_master_id,
            'referred_master_id' => $this->referred_master_id,
            'program' => $this->program->value,
            'status' => $this->status->value,
            'attached_at' => $this->created_at->toIso8601String(),
        ];
    }
}
