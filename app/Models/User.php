<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
        'expiry_date',
        'member_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'expiry_date' => 'datetime',
    ];

    /**
     * Always encrypt the password when it is updated.
     *
     * @param $value
     * @return string
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }
    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    public function isAdmin()
    {
        // Assuming 'Admin' is the name of the admin role
        return $this->role->name === 'Admin';
    }

    /**
     * Check if the user's account is expired.
     *
     * @return bool
     */
    public function isExpired()
    {
        if ($this->member && $this->member->additionalInfo) {
            $membershipEndDate = $this->member->additionalInfo->membershipEndDate;

            if ($membershipEndDate) {
                // Add a 3-month grace period
                $gracePeriodEndDate = $membershipEndDate->copy()->addMonths(3);

                // Check if the current date is past the grace period
                return now()->greaterThan($gracePeriodEndDate);
            }
        }

        return false;
    }

    public function member()
    {
        return $this->belongsTo(Member::class, 'member_id');
    }
}
