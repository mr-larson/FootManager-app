<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Team extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'teams';

    protected $fillable = [
        'name',
        'description',
        'budget',
        'wins',
        'draws',
        'losses',
    ];

    public function players(): BelongsToMany
    {
        return $this->belongsToMany(Player::class, 'contracts');
    }

    public function activePlayers(): BelongsToMany
    {
        return $this->players()->wherePivot('end_date', '>', now());
    }

    public function homeMatches(): HasMany
    {
        return $this->hasMany(SoccerMatch::class, 'team_id_home');
    }

    public function awayMatches(): HasMany
    {
        return $this->hasMany(SoccerMatch::class, 'team_id_away');
    }

    public function totalMatchesPlayed(): int
    {
        return $this->wins + $this->draws + $this->losses;
    }

    public function remainingBudget(): int
    {
        $totalSalary = $this->players()->sum('salary');
        return $this->budget - $totalSalary;
    }
}
