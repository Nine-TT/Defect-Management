<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class ErrorType extends Model
{
    protected $table = 'errortypes';
    protected $primaryKey = 'errorTypeID';

    protected $fillable = [
        'typeName',
        'projectID',
    ];
}
