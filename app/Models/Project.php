<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $table = 'projects';
    protected $primaryKey = 'projectID';

    protected $fillable = [
        'projectName',
        'projectCreator',
        'description',
    ];

    public $timestamps = true;

    public function creator()
    {
        return $this->belongsTo(User::class, 'projectCreator', 'userID');
    }

    public function members()
    {
        return $this->hasMany(ProjectMember::class, 'projectID', 'projectID');
    }

    public function testTypes()
    {
        return $this->hasMany(TestType::class, 'projectID', 'projectID');
    }

    public function errorTypes()
    {
        return $this->hasMany(ErrorType::class, 'projectID', 'projectID');
    }
}
