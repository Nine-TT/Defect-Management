<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $primaryKey = 'userID';

    protected $fillable = [
        'firstName',
        'lastName',
        'birthday',
        'email',
        'address',
        'gender',
        'phoneNumber',
        'username',
        'password',
        'urlImage',
    ];
      protected $hidden = [
            'password',
            'remember_token',
        ];

    public function projects()
    {
        return $this->hasMany(Project::class, 'projectCreator', 'userID');
    }

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

}
