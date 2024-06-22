<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id
 * @property string $name
 * @property string $description
 * @property int $budget
 * @property int $wins
 * @property int $draws
 * @property int $losses
 **/
class Team extends Model
{
    use HasFactory;
    use SoftDeletes;

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

    public function homeMatches(): Relation
    {
        return $this->hasMany(SoccerMatch::class, 'team_id_home');
    }

    public function awayMatches(): Relation
    {
        return $this->hasMany(SoccerMatch::class, 'team_id_away');
    }
}

