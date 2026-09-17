<?php

namespace App\Models;

use App\Enums\ReferralProgram;
use App\Enums\ReferralStatus;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Привязка приведённого мастера к тому, кто его привёл.
 *
 * Программы — см. App\Enums\ReferralProgram, статусы — App\Enums\ReferralStatus.
 */
class Referral extends Model
{
    use HasFactory;

    protected $fillable = [
        'referrer_master_id',
        'referred_master_id',
        'program',
        'status',
    ];

    protected $casts = [
        'program' => ReferralProgram::class,
        'status' => ReferralStatus::class,
    ];

    /** Кто привёл. */
    public function referrerMaster(): BelongsTo
    {
        return $this->belongsTo(Master::class, 'referrer_master_id');
    }

    /** Кого привели. */
    public function referredMaster(): BelongsTo
    {
        return $this->belongsTo(Master::class, 'referred_master_id');
    }

    /** Начисления по этой привязке. */
    public function earnings(): HasMany
    {
        return $this->hasMany(ReferralEarning::class);
    }

    /**
     * Активные привязки — те, что ещё могут принести вознаграждение.
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('status', ReferralStatus::Rewarded);
    }
}
