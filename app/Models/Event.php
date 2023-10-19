<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $table = 'events';
    protected $primaryKey = 'eventID';

    protected $fillable = [
        'eventType',
        'eventDescription',
        'eventDate',
        'userID',
        'errorID',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'userID', 'userID');
    }

    public function error()
    {
        return $this->belongsTo(Error::class, 'errorID', 'errorID');
    }

}

