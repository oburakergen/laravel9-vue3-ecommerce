<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'products';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable =  [
        'name',
        'image',
        'price',
        'quantity',
    ];

    /**
     * Scope a query to only include active pages.
     *
     * @param  $query  Builder
     *
     * @return Builder
     */
    public function scopeIsStock(Builder $query): Builder
    {
        return $query->where('quantity', '>' , 0);
    }

    /**
     * Scope a query to only include active pages.
     *
     * @param  $query  Builder
     *
     * @return Builder
     */
    public function scopeOrder(Builder $query): Builder
    {
        return $query->orderBy("quantity", "DESC");
    }
}
