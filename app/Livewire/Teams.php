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
    public $teamId;
    public $showPlayers = [];

    protected $rules = [
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'budget' => 'required|integer',
    ];

    public function mount(): void
    {
        // Initialize showPlayers array
        $this->showPlayers = Team::pluck('id')->flip()->map(function () {
            return false;
        })->toArray();
    }

    public function render()
    {
        $teams = Team::with('activePlayers')->paginate(8);

        return view('livewire.pages.teams', ['teams' => $teams])
            ->layout('layouts.app');
    }

    public function createTeam(): void
    {
        $this->validate();

        Team::create([
            'name' => $this->name,
            'description' => $this->description,
            'budget' => $this->budget,
        ]);

        $this->reset(['name', 'description', 'budget']);
        $this->mount(); // Re-initialize the showPlayers array
        session()->flash('message', 'Team created successfully.');
    }

    public function editTeam($id): void
    {
        $team = Team::findOrFail($id);
        $this->teamId = $team->id;
        $this->name = $team->name;
        $this->description = $team->description;
        $this->budget = $team->budget;
    }

    public function updateTeam(): void
    {
        $this->validate();

        $team = Team::findOrFail($this->teamId);
        $team->update([
            'name' => $this->name,
            'description' => $this->description,
            'budget' => $this->budget,
        ]);

        $this->reset(['name', 'description', 'budget', 'teamId']);
        $this->mount(); // Re-initialize the showPlayers array
        session()->flash('message', 'Team updated successfully.');
    }

    public function deleteTeam($id): void
    {
        Team::findOrFail($id)->delete();
        $this->mount(); // Re-initialize the showPlayers array
        session()->flash('message', 'Team deleted successfully.');
    }

    public function togglePlayers($teamId): void
    {
        $this->showPlayers[$teamId] = !$this->showPlayers[$teamId];
    }
}
