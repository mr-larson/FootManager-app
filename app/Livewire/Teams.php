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
    public $teamId; // For editing
    public $players = [];
    public $showPlayers = [];

    protected $rules = [
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'budget' => 'required|integer',
    ];

    public function mount()
    {
        $this->players = Player::all();
        // Initialize showPlayers array for all teams
        $teams = Team::all();
        foreach ($teams as $team) {
            $this->showPlayers[$team->id] = false;
        }
    }

    public function render()
    {
        $teams = Team::with(['activePlayers'])->paginate(8);

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
        ]);

        $this->reset(['name', 'description', 'budget']);
        session()->flash('message', 'Team created successfully.');
    }

    public function editTeam($id)
    {
        $team = Team::findOrFail($id);
        $this->teamId = $team->id;
        $this->name = $team->name;
        $this->description = $team->description;
        $this->budget = $team->budget;
    }

    public function updateTeam()
    {
        $this->validate();

        $team = Team::findOrFail($this->teamId);
        $team->update([
            'name' => $this->name,
            'description' => $this->description,
            'budget' => $this->budget,
        ]);

        $this->reset(['name', 'description', 'budget', 'teamId']);
        session()->flash('message', 'Team updated successfully.');
    }

    public function deleteTeam($id)
    {
        Team::findOrFail($id)->delete();
        session()->flash('message', 'Team deleted successfully.');
    }

    public function togglePlayers($teamId)
    {
        $this->showPlayers[$teamId] = !$this->showPlayers[$teamId];
    }
}
