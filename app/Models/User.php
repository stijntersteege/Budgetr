<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

/**
 * Class User
 * @package App\Models
 *
 * @property string $name
 * @property string $email
 * @property int $income
 * @property int $expenses
 */
class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    /**
     * Get the incomes associated with the user.
     */
    public function income(): HasMany
    {
        return $this->hasMany(Income::class);
    }

    /**
     * Get the expenses associated with the user.
     */
    public function expenses(): HasMany
    {
        return $this->hasMany(Expense::class);
    }

    /**
     * Get the monthly income of the user.
     */
    public function monthlyIncome()
    {
        return $this->income
                ->where('period', 'monthly')
                ->sum('amount') +
            ($this->income
                ->where('period', 'annually')
                ->sum('amount') / 12);
    }

    /**
     * Get the annual income of the user.
     */
    public function annualIncome()
    {
        return (
            $this->income
                ->where('period', 'monthly')
                ->sum('amount') * 12) +
            $this->income
                ->where('period', 'annually')
                ->sum('amount');
    }

    /**
     * Get the monthly expenses of the user.
     */
    public function monthlyExpenses()
    {
        return $this->expenses
                ->where('period', 'monthly')
                ->sum('amount') +
            ($this->expenses
                    ->where('period', 'annually')
                    ->sum('amount') / 12);
    }

    /**
     * Get the annual expenses of the user.
     */
    public function annualExpenses()
    {
        return (
                $this->expenses
                    ->where('period', 'monthly')
                    ->sum('amount') * 12) +
            $this->expenses
                ->where('period', 'annually')
                ->sum('amount');
    }
}
