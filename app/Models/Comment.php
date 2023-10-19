<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use app\models\Error;

class Comment extends Model
{
    protected $table = 'comments';
    protected $primaryKey = 'commentID';

    protected $fillable = [
        'errorID',
        'userID',
        'content',
        'createdAt',
        'type',
    ];
    
    public $timestamps = true;

    public function error()
    {
        return $this->belongsTo(Error::class, 'errorID', 'errorID');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'userID', 'userID');
    }

}

