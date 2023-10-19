<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TestType extends Model
{
    protected $table = 'testtypes';
    protected $primaryKey = 'testTypeID';

    protected $fillable = [
        'typeName',
    ];
}
