<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
<<<<<<< HEAD
=======
use Illuminate\Database\Eloquent\Relations\HasMany;
>>>>>>> 077f2ba7555bf4d01cbea2e7efd19cf3d7a1f086
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
<<<<<<< HEAD
    /** @use HasFactory<\Database\Factories\UserFactory> */
=======
>>>>>>> 077f2ba7555bf4d01cbea2e7efd19cf3d7a1f086
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
<<<<<<< HEAD
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
=======
     * @var array<int, string>
     */
    protected $fillable = [
        'avatar',
        'name',
        'username',
        'email',
        'address',
        'role',
        'password',
        'created_at',
        'updated_at',
>>>>>>> 077f2ba7555bf4d01cbea2e7efd19cf3d7a1f086
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
<<<<<<< HEAD
     * @var list<string>
=======
     * @var array<int, string>
>>>>>>> 077f2ba7555bf4d01cbea2e7efd19cf3d7a1f086
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
        ];
    }
<<<<<<< HEAD
=======

    // public function review() : HasMany
    // {
    //     return $this->hasMany(Reviews::class, 'user_id');
    // }
    // public function permissions() : HasMany
    // {
    //     return $this->hasMany(Permissions::class, 'user_id');
    // }
    // public function collections() : HasMany
    // {
    //     return $this->hasMany(Collections::class, 'user_id');
    // }
>>>>>>> 077f2ba7555bf4d01cbea2e7efd19cf3d7a1f086
}
