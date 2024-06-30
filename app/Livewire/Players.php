<?php
namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Player;
use App\Models\Contract;

class Players extends Component
{
    use WithPagination;

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
    public $playerId;
    public $search = '';
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

    public function mount(): void
    {
        $this->contracts = [];
    }

    public function render()
    {
        $players = Player::query()
            ->where('firstname', 'like', '%' . $this->search . '%')
            ->orWhere('lastname', 'like', '%' . $this->search . '%')
            ->orWhere('position', 'like', '%' . $this->search . '%')
            ->orWhere('age', 'like', '%' . $this->search . '%')
            ->orWhere('cost', 'like', '%' . $this->search . '%')
            ->paginate(15);

        return view('livewire.pages.players', ['players' => $players])
            ->layout('layouts.app');
    }

    public function updatedSearch(): void
    {
        $this->resetPage();
    }

    public function createPlayer(): void
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
        session()->flash('message', 'Player created successfully.');
    }

    public function editPlayer($id): void
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

    public function updatePlayer(): void
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
        session()->flash('message', 'Player updated successfully.');
    }

    public function deletePlayer($id): void
    {
        Player::findOrFail($id)->delete();
        session()->flash('message', 'Player deleted successfully.');
        $this->resetForm();
    }

    public function manageContracts($playerId): void
    {
        $this->contracts = Contract::where('player_id', $playerId)->get();
    }

    public function resetForm(): void
    {
        $this->reset(['firstname', 'lastname', 'age', 'position', 'cost', 'stats', 'playerId']);
    }
}
