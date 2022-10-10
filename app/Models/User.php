<?php

namespace App\Models;

use App\Models\Customer\CustomerDetails;
use App\Models\Surcharge\Surcharge;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;
use Silber\Bouncer\Database\HasRolesAndAbilities;
use Wildside\Userstamps\Userstamps;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRolesAndAbilities, CanResetPassword, SoftDeletes, Userstamps;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'status',
        'parent_id'
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
    ];

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }

    public function customerDetails()
    {
        return $this->hasOne(CustomerDetails::class);
    }

    public function children()
    {
        return $this->hasOne(User::class, 'parent_id');
    }

    public function parent()
    {
        return $this->belongsTo(User::class, 'parent_id');
    }

    function hasUeUserPrivilages()
    {
        if (
            $this->can('list-ueuser') ||
            $this->can('create-ueuser') ||
            $this->can('view-ueuser') ||
            $this->can('edit-ueuser') ||
            $this->can('delete-ueuser')
        ) {
            return true;
        }
        return false;
    }
    function hasIntegratorPrivilages()
    {
        if (
            $this->can('list-integrators') ||
            $this->can('create-integrators') ||
            $this->can('view-integrators') ||
            $this->can('edit-integrators') ||
            $this->can('delete-integrators')
        ) {
            return true;
        }
        return false;
    }
    function hasCustomerPrivilages()
    {
        if (
            $this->can('list-customer') ||
            $this->can('create-customer') ||
            $this->can('view-customer') ||
            $this->can('edit-customer') ||
            $this->can('delete-customer')
        ) {
            return true;
        }
        return false;
    }

    public function specialrate()
    {
        return $this->hasMany(SpecialRate::class);
    }
}
