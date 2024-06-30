<?php

namespace App\Livewire;

use Illuminate\View\View;
use Livewire\Component;

use App\Models\Event;

class Calendar extends Component
{
    public $events = [];

    public function mount(): void
    {
        $this->events = Event::all()->toArray();
    }

    public function render(): View
    {
        return view('livewire.calendar');
    }
}
