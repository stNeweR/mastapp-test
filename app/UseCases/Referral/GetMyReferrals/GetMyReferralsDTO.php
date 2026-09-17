<?php

namespace App\UseCases\Referral\GetMyReferrals;

use App\Models\Master;

/**
 * Входные данные для списка приведённых мастеров.
 */
final readonly class GetMyReferralsDTO
{
    public function __construct(
        public Master $master,
    ) {
    }
}
