<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaction extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'transactions';
    public const PROCESS = 'process';
    public const SUCCESS = 'success';
    public const REJECT = 'reject';


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable =  [
        'name',
        'lastname',
        'email',
        'phone',
        'order_id',
        'status',
    ];


    /**
     * Scope a query to only include active pages.
     *
     * @param  $query  Builder
     *
     * @return Builder
     */
    public function scopeProcess(Builder $query)
    {
        return $query->where('status', '=', static::PROCESS);
    }

    /**
     * Scope a query to only include active pages.
     *
     * @param  $query  Builder
     *
     * @return Builder
     */
    public function scopeSuccess(Builder $query)
    {
        return $query->where('status', '=', static::SUCCESS);
    }

    /**
     * Scope a query to only include active pages.
     *
     * @param  $query  Builder
     *
     * @return Builder
     */
    public function scopeReject(Builder $query)
    {
        return $query->where('status', '=', static::REJECT);
    }

    /**
     * @return BelongsTo
     */
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }
}
