<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Election extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'voting_start',
        'voting_end',
        'election_start',
        'election_end',
        'is_archived',
    ];

    public function positions()
    {
        return $this->belongsToMany(Position::class, 'election_positions')
                    ->withPivot('available_positions');
    }
    public function electionPositions(){
        return $this->hasMany(ElectionPosition::class); 
    }

    public function nominees()
    {
        return $this->hasManyThrough(Nominee::class, ElectionPosition::class);
    }

    public function getFormattedElectionStartAttribute()
    {
        return Carbon::parse($this->attributes['election_start'])->format('F j, Y g:i A');
    }

    public function getFormattedVotingStartAttribute()
    {
        return Carbon::parse($this->attributes['voting_start'])->format('F j, Y g:i A');
    }

    public function getFormattedVotingEndAttribute()
    {
        return Carbon::parse($this->attributes['voting_end'])->format('F j, Y g:i A');
    }

    public function getFormattedElectionEndAttribute()
    {
        return Carbon::parse($this->attributes['election_end'])->format('F j, Y g:i A');
    }
}