<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Contract;
use App\Models\Player;
use App\Models\Team;

class Contracts extends Component
{
    use WithPagination;

    public $contractId;
    public $player_id;
    public $team_id;
    public $salary;
    public $start_date;
    public $end_date;
    public $players;
    public $teams;

    protected $rules = [
        'player_id' => 'required|exists:players,id',
        'team_id' => 'required|exists:teams,id',
        'salary' => 'required|integer',
        'start_date' => 'required|date',
        'end_date' => 'required|date',
    ];

    public function mount(): void
    {
        $this->players = Player::all();
        $this->teams = Team::all();
    }

    public function render()
    {
        $contracts = Contract::with(['player', 'team'])->paginate(10);

        return view('livewire.pages.contracts', ['contracts' => $contracts])
            ->layout('layouts.app');
    }

    public function createContract(): void
    {
        $this->validate();

        Contract::create([
            'player_id' => $this->player_id,
            'team_id' => $this->team_id,
            'salary' => $this->salary,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
        ]);

        $this->resetForm();
        session()->flash('message', 'Contract created successfully.');
    }

    public function editContract($id): void
    {
        $contract = Contract::findOrFail($id);
        $this->contractId = $contract->id;
        $this->player_id = $contract->player_id;
        $this->team_id = $contract->team_id;
        $this->salary = $contract->salary;
        $this->start_date = $contract->start_date->format('Y-m-d');
        $this->end_date = $contract->end_date->format('Y-m-d');
    }

    public function updateContract(): void
    {
        $this->validate();

        $contract = Contract::findOrFail($this->contractId);
        $contract->update([
            'player_id' => $this->player_id,
            'team_id' => $this->team_id,
            'salary' => $this->salary,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
        ]);

        $this->resetForm();
        session()->flash('message', 'Contract updated successfully.');
    }

    public function deleteContract($id): void
    {
        Contract::findOrFail($id)->delete();
        session()->flash('message', 'Contract deleted successfully.');
    }

    public function resetForm(): void
    {
        $this->reset(['player_id', 'team_id', 'salary', 'start_date', 'end_date', 'contractId']);
    }
}
