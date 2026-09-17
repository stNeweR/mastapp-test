<?php

namespace App\Models;

use App\Enums\ReferralEarningStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Журнал начислений за рефералов.
 *
 * Одна строка = вознаграждение реферера за одного приведённого мастера.
 *
 * Статусы — см. App\Enums\ReferralEarningStatus.
 */
class ReferralEarning extends Model
{
    use HasFactory;

    protected $fillable = [
        'referrer_master_id',
        'referred_master_id',
        'referral_id',
        'payment_id',
        'payment_amount',
        'amount',
        'percent',
        'status',
    ];

    protected $casts = [
        'payment_amount' => 'integer',
        'amount' => 'integer',
        'status' => ReferralEarningStatus::class,
    ];

    public function referrerMaster(): BelongsTo
    {
        return $this->belongsTo(Master::class, 'referrer_master_id');
    }

    public function referredMaster(): BelongsTo
    {
        return $this->belongsTo(Master::class, 'referred_master_id');
    }

    public function referral(): BelongsTo
    {
        return $this->belongsTo(Referral::class);
    }

    public function payment(): BelongsTo
    {
        return $this->belongsTo(Payment::class);
    }
}
