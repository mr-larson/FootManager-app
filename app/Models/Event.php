<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Event extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'start', 'end'];

    public static function scheduleMatches()
    {
        $teams = Team::all();
        $currentDate = Carbon::now();

        foreach ($teams as $team) {
            $matchDate = $currentDate->next(Carbon::SATURDAY);
            self::create([
                'title' => $team->name . ' vs Another Team',
                'start' => $matchDate->toDateTimeString(),
                'end' => $matchDate->addHours(2)->toDateTimeString(),
            ]);

            $matchDate = $currentDate->next(Carbon::SUNDAY);
            self::create([
                'title' => $team->name . ' vs Another Team',
                'start' => $matchDate->toDateTimeString(),
                'end' => $matchDate->addHours(2)->toDateTimeString(),
            ]);
        }
    }
}
