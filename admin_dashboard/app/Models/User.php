<?php
namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'avatar',
        'password',
        'phone',
        'birth_date',
        'position',
        'about',
        'address',
        'country',
        'city',
        'state',
        'zip_code',
        'role',
        'facebook_id',
        'google_id',
        'is_premium',
        'device_id',
        'fcm_token',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'email_verified_at',
        'created_at',
        'updated_at',
        'password_reset_token',
        'password_reset_token_expiry',
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
            'password'          => 'hashed',
        ];
    }

    //for api image with url retrieve
    // public function getAvatarAttribute($value): string | null
    // {
    //     if (request()->is('api/*') && ! empty($value)) {
    //         return url($value);
    //     }
    //     return $value;
    // }

    /**
     * Get the identifier that will be stored in the JWT subject claim.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

/**
 * Return a key value array, containing any custom claims to be added to the JWT.
 *
 * @return array
 */
    public function getJWTCustomClaims()
    {
        return [];
    }
}
