<?php

namespace App\Livewire;

use Livewire\Component;

use App\Models\Event;

class Calendar extends Component
{
    public $events = [];

    public function mount()
    {
        $this->events = Event::all()->toArray();
    }

    public function render()
    {
        return view('livewire.calendar');
    }
}
