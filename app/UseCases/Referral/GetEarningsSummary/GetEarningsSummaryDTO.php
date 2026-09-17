<?php

namespace App\UseCases\Referral\GetEarningsSummary;

use App\Models\Master;

/**
 * Входные данные для сводки по реферальным начислениям.
 */
final readonly class GetEarningsSummaryDTO
{
    public function __construct(
        public Master $master,
    ) {
    }
}
