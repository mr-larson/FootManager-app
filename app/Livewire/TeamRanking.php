<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Team;
use App\Models\SoccerMatch;

class TeamRanking extends Component
{
    public $teams = [];

    public function mount(): void
    {
        $this->updateRankings();
    }

    public function updateRankings(): void
    {
        $teams = Team::all();

        foreach ($teams as $team) {
            $team->points = ($team->wins * 3) + ($team->draws);
        }

        $this->teams = $teams->sortByDesc('points')->values()->all();
    }

    public function render()
    {
        return view('livewire.team-ranking');
    }
}
