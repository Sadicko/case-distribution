<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;

class CourtLog extends Component
{
    use WithPagination;

    public $court;

    public function render()
    {
        return view('livewire.court-log', [
            'courtlogs' => $this->court->courtlogs()->latest()->paginate(10)
        ]);
    }
}
