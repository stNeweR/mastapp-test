<?php

namespace App\UseCases\Referral\AttachReferral;

use App\Exceptions\ReferralCodeNotFoundException;
use App\Exceptions\SelfReferralNotAllowedException;
use App\Models\Master;
use App\Models\Referral;
use App\Services\Referral\ReferralService;

/**
 * Закрепляет текущего мастера за владельцем реферального кода.
 *
 * Повторный вызов не создаёт вторую привязку (идемпотентность
 * обеспечивается ReferralService::registerReferral).
 */
class AttachReferralUseCase
{
    public function __construct(private ReferralService $referrals)
    {
    }

    /**
     * @throws ReferralCodeNotFoundException код не найден
     * @throws SelfReferralNotAllowedException мастер закрепляется за собой
     */
    public function handle(AttachReferralDTO $dto): Referral
    {
        $referrer = Master::where('referral_code', $dto->code)->first();

        if ($referrer === null) {
            throw new ReferralCodeNotFoundException($dto->code);
        }

        if ($referrer->id === $dto->master->id) {
            throw new SelfReferralNotAllowedException();
        }

        return $this->referrals->registerReferral($dto->master, $dto->code);
    }
}
