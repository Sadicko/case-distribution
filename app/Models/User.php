<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'slug',
        'first_name',
        'last_name',
        'username',
        'email',
        'phone',
        'password',
        'phone_verified_at',
        'status',
        'access_type',
        'approved_at',
        'is_approved',

        'status',
        'block',
        'require_password_reset',
        'is_expire',
        'expire_date',

        'invited_by',
        'invited_date',
        'accepted',
        'accepted_date',
        'is_online',
        'login_at',
        'logout_at',

        'location_id',
        'registry_id',
        'court_id',
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
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'invited_date' => 'datetime',
            'accepted_date' => 'datetime',
            'expire_date' => 'datetime',
            'login_at' => 'datetime',
            'logout_at' => 'datetime',
        ];
    }

    protected $append = ['full_name'];

    public function FullName(): Attribute
    {
        return new Attribute(
            get: fn () => $this->first_name . ' ' . $this->last_name,
        );
    }

    public function courttypes()
    {
        return $this->belongsTo(Courttype::class, 'created_by');
    }

    public function courts()
    {
        return $this->belongsTo(Court::class, 'court_id');
    }

    public function registries()
    {
        return $this->belongsTo(Registry::class, 'registry_id');
    }

    public function locations()
    {
        return $this->belongsTo(Location::class, 'location_id');
    }

    public function dockets()
    {
        return $this->hasMany(Docket::class, 'created_by', 'id');
    }

}
