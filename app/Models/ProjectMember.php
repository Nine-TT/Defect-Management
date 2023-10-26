<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectMember extends Model
{
    protected $table = 'projectmembers';
    protected $primaryKey = 'id';

    protected $fillable = [
        'userID',
        'projectID',
        'role',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'userID', 'userID');
    }

    public function project()
    {
        return $this->belongsTo(Project::class, 'projectID', 'projectID');
    }
}
