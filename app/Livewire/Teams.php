<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Team;

class Teams extends Component
{
    public $name;
    public $description;
    public $budget;
    public $teams;
    public $teamId; // For editing

    protected $rules = [
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'budget' => 'required|integer',
    ];

    public function mount()
    {
        $this->teams = Team::all();
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
        $this->teams = Team::all(); // Refresh the teams list

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
        $this->teams = Team::all(); // Refresh the teams list

        session()->flash('message', 'Team updated successfully.');
    }

    public function deleteTeam($id)
    {
        Team::findOrFail($id)->delete();
        $this->teams = Team::all(); // Refresh the teams list

        session()->flash('message', 'Team deleted successfully.');
    }

    public function render()
    {
        return view('livewire.pages.teams')->layout('layouts.app');
    }
}

