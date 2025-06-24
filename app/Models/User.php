<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'company_id',
        'name',
        'full_name',
        'image',
        'citizenship',
        'fin_code',
        'id_series',
        'id_number',
        'birth_date',
        'owner_id',
        'contact_numbers',
        'registration_address',
        'issuing_authority',
        'issue_date',
        'valid_until',
        'owner_or_tenant_id',
        'role',
        'email',
        'password',
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
        'password' => 'hashed',
        'contact_numbers' => 'array',
    ];

    protected function finCode(): Attribute
    {
        return Attribute::make(
            set: fn (string $value) => mb_strtoupper($value),
        );
    }

    public function owner()
    {
        return $this->belongsTo(Owner::class, 'owner_or_tenant_id');
    }

    public function tenant()
    {
        return $this->belongsTo(Tenant::class, 'owner_or_tenant_id');
    }

    // ownerOrTenant
    public function profile()
    {
        if ($this->role === 'owner') {
            return $this->owner();
        } elseif ($this->role === 'tenant') {
            return $this->tenant();
        }

        return null;
    }
    
    public function company() {
        return $this->hasOne(Company::class,'id','company_id');
    }

    public function applications()
    {
        return $this->hasMany(Application::class, 'user_id');
    }

    public function assignedApplications()
    {
        return $this->hasMany(Application::class, 'assigned_user_id');
    }

    public function viewedApplications()
    {
        return $this->hasMany(Application::class, 'viewed_by_user_id');
    }

    public function applicationComments()
    {
        return $this->hasMany(ApplicationComment::class, 'user_id');
    }
    
    public function sessions()
    {
        return $this->hasMany(AuthSession::class,'user_id','id');
    }
}
