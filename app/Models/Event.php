<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Event extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['title', 'start', 'end', 'soccer_match_id'];

    public static function scheduleMatches()
    {
        $teams = Team::all();
        $currentDate = Carbon::now();

        $matchPairs = $teams->chunk(2);

        foreach ($matchPairs as $pair) {
            if ($pair->count() == 2) {
                $teamHome = $pair[0];
                $teamAway = $pair[1];

                $matchDate = $currentDate->next(Carbon::SATURDAY);

                $soccerMatch = SoccerMatch::create([
                    'team_id_home' => $teamHome->id,
                    'team_id_away' => $teamAway->id,
                    'date' => $matchDate,
                ]);

                self::create([
                    'title' => "{$teamHome->name} vs {$teamAway->name}",
                    'start' => $matchDate->toDateTimeString(),
                    'end' => $matchDate->addHours(2)->toDateTimeString(),
                    'soccer_match_id' => $soccerMatch->id,
                ]);

                $matchDate = $currentDate->next(Carbon::SUNDAY);

                $soccerMatch = SoccerMatch::create([
                    'team_id_home' => $teamHome->id,
                    'team_id_away' => $teamAway->id,
                    'date' => $matchDate,
                ]);

                self::create([
                    'title' => "{$teamHome->name} vs {$teamAway->name}",
                    'start' => $matchDate->toDateTimeString(),
                    'end' => $matchDate->addHours(2)->toDateTimeString(),
                    'soccer_match_id' => $soccerMatch->id,
                ]);
            }
        }
    }

    public function isOngoing(): bool
    {
        $now = Carbon::now();
        return $now->between($this->start, $this->end);
    }

    public function soccerMatch(): BelongsTo
    {
        return $this->belongsTo(SoccerMatch::class);
    }
}
