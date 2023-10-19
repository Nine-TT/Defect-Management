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
        ];

    public function projects()
    {
        return $this->hasMany(Project::class, 'projectCreator', 'userID');
    }

}
