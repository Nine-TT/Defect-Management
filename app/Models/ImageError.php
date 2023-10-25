<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ErrorImage extends Model
{
    use HasFactory;

    protected $table = 'errors_image';
    protected $primaryKey = 'ErrorsImageID';
    protected $fillable = [
        'errorID',
        'imagePath',
    ];

    // Định nghĩa quan hệ với bảng errors
    public function error()
    {
        return $this->belongsTo(Error::class, 'errorID', 'errorID');
    }
}
