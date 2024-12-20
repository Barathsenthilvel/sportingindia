<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'role_id',
        'name',
        'gender',
        'dob',
        'mobile',
        'email',
        'photo',
        'password',
        'is_approved',
        'approved_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'dob' => 'date',
        'is_approved' => 'integer',
        'approved_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Define a relationship with the Role model.
     */
    public function role()
    {
        return $this->belongsTo(Role::class);
    }
}
