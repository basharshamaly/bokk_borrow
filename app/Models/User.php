<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
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
    ];

    public function actor()
    {
        return $this->morphTo();
    }
    public function employess()
    {
        return $this->hasMany(Employee::class, 'user_id', 'id');
    }
    public function students()
    {
        return $this->hasMany(Student::class, 'user_id', 'id');
    }
    public function doctors()
    {
        return $this->hasMany(Student::class, 'user_id', 'id');
    }
    public function user_books()
    {
        return $this->hasMany(user_books::class, 'user_id', 'id');
    }

    public function userbooks()
    {
        return $this->hasMany(UserBook::class, 'user_id', 'id');
    }
    public function borrow_book()
    {
        return $this->hasMany(borrowBook::class, 'user_id', 'id');
    }
}
