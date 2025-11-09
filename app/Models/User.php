<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * Kolom-kolom yang boleh diisi melalui mass assignment.
     * Password akan otomatis di-hash karena casting di bawah.
     * 
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * Kolom yang disembunyikan saat model di-serialize (misal: JSON response).
     * Password dan remember_token tidak boleh di-expose ke frontend.
     * 
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * Type casting untuk attributes:
     * - email_verified_at: dikonversi ke Carbon datetime
     * - password: otomatis di-hash dengan bcrypt
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

    /**
     * Relasi ke Projects (One to Many / Has Many)
     * 
     * Satu user bisa memiliki banyak projects.
     * Relasi ini memungkinkan kita mengakses semua project milik user:
     * $user->projects
     * $user->projects()->where('status', 'published')->get()
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function projects()
    {
        return $this->hasMany(Project::class);
    }
}
