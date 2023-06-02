<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Role extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'roles';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable =  [
        'name',
        'isAdmin',
        'user_id'
    ];

    /**
     * @return HasOne
     */
    public function user(): HasOne
    {
        return $this->HasOne(User::class);
    }

    public function isAdmin(): bool
    {
        return $this->isAdmin;
    }
}
