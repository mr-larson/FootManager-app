<?php
namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\SoccerMatch;
use App\Models\Team;

class SoccerMatches extends Component
{
    use WithPagination;

    public $matchId;
    public $team_id_home;
    public $team_id_away;
    public $score_team_home;
    public $score_team_away;
    public $date;
    public $teams;

    protected $rules = [
        'team_id_home' => 'required|exists:teams,id',
        'team_id_away' => 'required|exists:teams,id',
        'score_team_home' => 'nullable|integer',
        'score_team_away' => 'nullable|integer',
        'date' => 'required|date',
    ];

    public function mount(): void
    {
        $this->teams = Team::all();
    }

    public function render()
    {
        $matches = SoccerMatch::with(['homeTeam', 'awayTeam'])->paginate(10);

        return view('livewire.pages.soccer-matches', ['matches' => $matches])
            ->layout('layouts.app');
    }

    public function createMatch(): void
    {
        $this->validate();

        SoccerMatch::create([
            'team_id_home' => $this->team_id_home,
            'team_id_away' => $this->team_id_away,
            'score_team_home' => $this->score_team_home,
            'score_team_away' => $this->score_team_away,
            'date' => $this->date,
        ]);

        $this->resetForm();
        session()->flash('message', 'Match created successfully.');
    }

    public function editMatch($id): void
    {
        $match = SoccerMatch::findOrFail($id);
        $this->matchId = $match->id;
        $this->team_id_home = $match->team_id_home;
        $this->team_id_away = $match->team_id_away;
        $this->score_team_home = $match->score_team_home;
        $this->score_team_away = $match->score_team_away;
        $this->date = $match->date->format('Y-m-d');
    }

    public function updateMatch(): void
    {
        $this->validate();

        $match = SoccerMatch::findOrFail($this->matchId);
        $match->update([
            'team_id_home' => $this->team_id_home,
            'team_id_away' => $this->team_id_away,
            'score_team_home' => $this->score_team_home,
            'score_team_away' => $this->score_team_away,
            'date' => $this->date,
        ]);

        $this->resetForm();
        session()->flash('message', 'Match updated successfully.');
    }

    public function deleteMatch($id): void
    {
        SoccerMatch::findOrFail($id)->delete();
        session()->flash('message', 'Match deleted successfully.');
    }

    public function resetForm(): void
    {
        $this->reset(['team_id_home', 'team_id_away', 'score_team_home', 'score_team_away', 'date', 'matchId']);
    }
}
