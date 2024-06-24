<?php
namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Team;
use App\Models\Player;

class Teams extends Component
{
    use WithPagination;

    public $name;
    public $description;
    public $budget;
    public $coach;
    public $formation;
    public $captain;
    public $teamId; // For editing
    public $players = [];

    protected $rules = [
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'budget' => 'required|integer',
        'coach' => 'nullable|string|max:255',
        'formation' => 'nullable|string|max:255',
        'captain' => 'nullable|integer|exists:players,id',
    ];

    public function mount()
    {
        $this->players = Player::all();
    }

    public function render()
    {
        $teams = Team::with(['activePlayers'])->paginate(10);

        return view('livewire.pages.teams', ['teams' => $teams])
            ->layout('layouts.app');
    }

    public function createTeam()
    {
        $this->validate();

        Team::create([
            'name' => $this->name,
            'description' => $this->description,
            'budget' => $this->budget,
            'coach' => $this->coach,
            'formation' => $this->formation,
            'captain' => $this->captain,
        ]);

        $this->reset(['name', 'description', 'budget', 'coach', 'formation', 'captain']);
        session()->flash('message', 'Team created successfully.');
    }

    public function editTeam($id)
    {
        $team = Team::findOrFail($id);
        $this->teamId = $team->id;
        $this->name = $team->name;
        $this->description = $team->description;
        $this->budget = $team->budget;
        $this->coach = $team->coach;
        $this->formation = $team->formation;
        $this->captain = $team->captain;
    }

    public function updateTeam()
    {
        $this->validate();

        $team = Team::findOrFail($this->teamId);
        $team->update([
            'name' => $this->name,
            'description' => $this->description,
            'budget' => $this->budget,
            'coach' => $this->coach,
            'formation' => $this->formation,
            'captain' => $this->captain,
        ]);

        $this->reset(['name', 'description', 'budget', 'coach', 'formation', 'captain', 'teamId']);
        session()->flash('message', 'Team updated successfully.');
    }

    public function deleteTeam($id)
    {
        Team::findOrFail($id)->delete();
        session()->flash('message', 'Team deleted successfully.');
    }
}
