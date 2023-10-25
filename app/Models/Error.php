<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Error extends Model
{
    use HasFactory;

    protected $table = 'errors';
    protected $primaryKey = 'errorID';
    protected $fillable = [
        'errorName',
        'description',
        'status',
        'assignedTo',
        'estimateTime',
        'reporter',
        'testTypeID',
        'errorTypeID',
        'stepsToReproduce',
        'expectedResult',
        'actualResult',
        'priority',
        'projectID',
    ];

    // Định nghĩa quan hệ với bảng users (assignedTo, reporter)
    public function assignedToUser()
    {
        return $this->belongsTo(User::class, 'assignedTo', 'userID');
    }

    public function reporterUser()
    {
        return $this->belongsTo(User::class, 'reporter', 'userID');
    }

    // Định nghĩa quan hệ với bảng testtypes và errortypes
    public function testType()
    {
        return $this->belongsTo(TestType::class, 'testTypeID', 'testTypeID');
    }

    public function errorType()
    {
        return $this->belongsTo(ErrorType::class, 'errorTypeID', 'errorTypeID');
    }

    // Định nghĩa quan hệ với bảng projects
    public function project()
    {
        return $this->belongsTo(Project::class, 'projectID', 'projectID');
    }

    // Định nghĩa quan hệ với bảng comments
    public function comments()
    {
        return $this->hasMany(Comment::class, 'errorID', 'errorID');
    }

    // Định nghĩa quan hệ với bảng events
    public function events()
    {
        return $this->hasMany(Event::class, 'errorID', 'errorID');
    }

    // Định nghĩa quan hệ với bảng errors_image
    public function images()
    {
        return $this->hasMany(ErrorImage::class, 'errorID', 'errorID');
    }
}
