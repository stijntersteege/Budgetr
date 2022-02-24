<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Expense
 * @package App\Models
 *
 * @property int $user_id
 * @property string $description
 * @property int $amount
 * @property string $period
 */
class Expense extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'user_id',
        'description',
        'amount',
        'period',
    ];

    /**
     * Get the user associated with the income.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
