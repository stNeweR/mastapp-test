<?php

namespace App\Models;

use App\Enums\PaymentType;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Платёж мастера за подписку.
 *
 * Типы платежей — см. App\Enums\PaymentType.
 */
class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'master_id',
        'amount',
        'type',
    ];

    protected $casts = [
        'amount' => 'integer',
        'type' => PaymentType::class,
    ];

    public function master(): BelongsTo
    {
        return $this->belongsTo(Master::class);
    }

    /** Платёж настоящими деньгами. */
    public static function isMonetary(self $payment): bool
    {
        return $payment->type->isMonetary() && $payment->amount > 0;
    }

    /** Только денежные платежи. */
    public function scopeMonetary(Builder $query): Builder
    {
        return $query->whereIn('type', [PaymentType::Card, PaymentType::Sbp]);
    }
}
