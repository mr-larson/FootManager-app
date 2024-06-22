<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Player;
use App\Models\Contract;

class Players extends Component
{
    public $firstname;
    public $lastname;
    public $age;
    public $position;
    public $cost;
    public $stats = [
        'speed' => null,
        'stamina' => null,
        'defense' => null,
        'attack' => null,
    ];
    public $players;
    public $playerId; // For editing
    public $search = ''; // Pour la recherche

    // Pour la gestion des contrats
    public $contracts;
    public $salary;
    public $start_date;
    public $end_date;

    protected $rules = [
        'firstname' => 'required|string|max:255',
        'lastname' => 'required|string|max:255',
        'age' => 'required|integer',
        'position' => 'required|string',
        'cost' => 'required|integer',
        'stats.speed' => 'required|integer',
        'stats.stamina' => 'required|integer',
        'stats.defense' => 'required|integer',
        'stats.attack' => 'required|integer',
        'salary' => 'nullable|integer',
        'start_date' => 'nullable|date',
        'end_date' => 'nullable|date',
    ];

    public function mount()
    {
        $this->players = Player::all();
    }

    public function updatedSearch()
    {
        $this->players = Player::where('firstname', 'like', '%' . $this->search . '%')
            ->orWhere('lastname', 'like', '%' . $this->search . '%')
            ->orWhere('position', 'like', '%' . $this->search . '%')
            ->orWhere('age', 'like', '%' . $this->search . '%')
            ->orWhere('cost', 'like', '%' . $this->search . '%')
            ->get();
    }

    public function createPlayer()
    {
        $this->validate();

        Player::create([
            'firstname' => $this->firstname,
            'lastname' => $this->lastname,
            'age' => $this->age,
            'position' => $this->position,
            'cost' => $this->cost,
            'stats' => $this->stats,
        ]);

        $this->resetForm();
        $this->players = Player::all(); // Refresh the players list

        session()->flash('message', 'Player created successfully.');
    }

    public function editPlayer($id)
    {
        $player = Player::findOrFail($id);
        $this->playerId = $player->id;
        $this->firstname = $player->firstname;
        $this->lastname = $player->lastname;
        $this->age = $player->age;
        $this->position = $player->position;
        $this->cost = $player->cost;
        $this->stats = is_array($player->stats) ? $player->stats : json_decode($player->stats, true);
        $this->contracts = Contract::where('player_id', $id)->get();
    }

    public function updatePlayer()
    {
        $this->validate();

        $player = Player::findOrFail($this->playerId);
        $player->update([
            'firstname' => $this->firstname,
            'lastname' => $this->lastname,
            'age' => $this->age,
            'position' => $this->position,
            'cost' => $this->cost,
            'stats' => $this->stats,
        ]);

        $this->resetForm();
        $this->players = Player::all(); // Refresh the players list

        session()->flash('message', 'Player updated successfully.');
    }

    public function deletePlayer($id)
    {
        Player::findOrFail($id)->delete();
        $this->players = Player::all(); // Refresh the players list

        $this->resetForm(); // Reset the form to return to create mode

        session()->flash('message', 'Player deleted successfully.');
    }

    public function manageContracts($playerId)
    {
        $this->contracts = Contract::where('player_id', $playerId)->get();
    }

    public function resetForm()
    {
        $this->reset(['firstname', 'lastname', 'age', 'position', 'cost', 'stats', 'playerId']);
    }

    public function render()
    {
        return view('livewire.pages.players')->layout('layouts.app');
    }
}
