<?php

namespace App\Enums;

/**
 * Реферальная программа, по которой пришёл мастер.
 */
enum ReferralProgram: string
{
    /** Мастер пригласил мастера по своему коду. */
    case MasterInvite = 'master_invite';

    /** Мастер пришёл по промокоду инфлюенсера. */
    case Influencer = 'influencer';
}
