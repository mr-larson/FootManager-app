<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Contract;
use App\Models\Player;
use App\Models\Team;

class Contracts extends Component
{
    public $contractId;
    public $player_id;
    public $team_id;
    public $salary;
    public $start_date;
    public $end_date;
    public $contracts;
    public $players;
    public $teams;

    protected $rules = [
        'player_id' => 'required|exists:players,id',
        'team_id' => 'required|exists:teams,id',
        'salary' => 'required|integer',
        'start_date' => 'required|date',
        'end_date' => 'required|date',
    ];

    public function mount()
    {
        $this->contracts = Contract::all();
        $this->players = Player::all();
        $this->teams = Team::all();
    }

    public function createContract()
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
        $this->contracts = Contract::all(); // Refresh the contracts list

        session()->flash('message', 'Contract created successfully.');
    }

    public function editContract($id)
    {
        $contract = Contract::findOrFail($id);
        $this->contractId = $contract->id;
        $this->player_id = $contract->player_id;
        $this->team_id = $contract->team_id;
        $this->salary = $contract->salary;
        $this->start_date = $contract->start_date->format('Y-m-d');
        $this->end_date = $contract->end_date->format('Y-m-d');
    }

    public function updateContract()
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
        $this->contracts = Contract::all(); // Refresh the contracts list

        session()->flash('message', 'Contract updated successfully.');
    }

    public function deleteContract($id)
    {
        Contract::findOrFail($id)->delete();
        $this->contracts = Contract::all(); // Refresh the contracts list

        session()->flash('message', 'Contract deleted successfully.');
    }

    public function resetForm()
    {
        $this->reset(['player_id', 'team_id', 'salary', 'start_date', 'end_date', 'contractId']);
    }

    public function render()
    {
        return view('livewire.pages.contracts')->layout('layouts.app');
    }
}
