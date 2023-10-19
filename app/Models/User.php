<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
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
