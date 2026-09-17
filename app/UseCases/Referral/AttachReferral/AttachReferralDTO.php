<?php

namespace App\UseCases\Referral\AttachReferral;

use App\Http\Requests\AttachReferralRequest;
use App\Models\Master;

/**
 * Входные данные для привязки текущего мастера к владельцу реферального кода.
 */
final readonly class AttachReferralDTO
{
    public function __construct(
        public Master $master,
        public string $code,
    ) {
    }

    public static function fromRequest(AttachReferralRequest $request, Master $master): self
    {
        return new self(
            master: $master,
            code: $request->validated('code'),
        );
    }
}
