<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentDetail extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_number';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id_number',
        'year',
        'course',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}