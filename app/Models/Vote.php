<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    use HasFactory;

    protected $fillable = [
        'election_id',
        'student_id',
        'nominee_id',
    ];

    public function election()
    {
        return $this->belongsTo(Election::class);
    }

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    public function nominee()
    {
        return $this->belongsTo(Nominee::class);
    }
}