<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nominee extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'election_position_id',
        'image_url',
    ];

    public function student()
    {
        return $this->belongsTo(StudentDetail::class, 'student_id', 'id_number');
    }

    public function electionPosition()
    {
        return $this->belongsTo(ElectionPosition::class, 'election_position_id');
    }

    public function votes()
    {
        return $this->hasMany(Vote::class);
    }
    public function watchers()
    {
        return $this->hasMany(Watcher::class);
    }
    public function election()
    {
        return $this->hasOne(Election::class, 'id', 'election_id');
    }
    public function position()
    {
        return $this->hasOne(Position::class, 'id', 'position_id');
    }
}