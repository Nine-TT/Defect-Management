<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Error extends Model
{
    protected $table = 'errors';
    protected $primaryKey = 'errorID';

    protected $fillable = [
        'issueName',
        'describe',
        'status',
        'assignedTo',
        'estimateTime',
        'reporter',
        'testTypeID',
        'errorTypeID',
    ];

    public $timestamps = true;

    public function assignedToUser()
    {
        return $this->belongsTo(User::class, 'assignedTo', 'userID');
    }

    public function reporterUser()
    {
        return $this->belongsTo(User::class, 'reporter', 'userID');
    }

    public function testType()
    {
        return $this->belongsTo(TestType::class, 'testTypeID', 'testTypeID');
    }

    public function errorType()
    {
        return $this->belongsTo(ErrorType::class, 'errorTypeID', 'errorTypeID');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'errorID', 'errorID');
    }

}
