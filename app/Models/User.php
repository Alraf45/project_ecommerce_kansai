<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Kolom yang bisa diisi massal (fillable)
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'is_active',
        'last_login',
    ];

    /**
     * Kolom yang disembunyikan ketika serialisasi
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Konversi tipe data otomatis
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'last_login' => 'datetime',
        'is_active' => 'boolean',
    ];

    /**
     * Relasi ke model Cart (satu user punya satu cart)
     */
    public function cart()
    {
        return $this->hasOne(Cart::class);
    }



    public function getProfilePictureUrlAttribute()
{
    return $this->profile_picture 
        ? asset('storage/' . $this->profile_picture)
        : asset('img/default-avatar.png'); // fallback default
}

}
