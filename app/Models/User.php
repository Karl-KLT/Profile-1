<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'image',
        'cover_image',
        'bio',
        'message',
        'country',
        'type',
        'email',
        'password',
        'email_active_code',


        'phoneNumber',
        'facebook',
        'instagram',
        'twitter',
        'linkedIn',
        'website',
        'location',
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

    public function toArray()
    {
        return collect(parent::toArray())->merge([
            'created_at' => Carbon::create($this->created_at)->diffForHumans(null,null,true,1),
            'updated_at' => Carbon::create($this->updated_at)->diffForHumans(null,null,true,1),
            'Skills' => $this->skills()->exists() ? $this->skills : null
        ]);
    }


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

    public function skills()
    {
        return $this->hasMany(Skill::class);
    }
}
