<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;

class DocketLog extends Component
{
    use WithPagination;

    public $docket;

    public function render()
    {
        return view('livewire.docket-log', [
            'docketlogs' => $this->docket->docketlogs()->latest()->paginate(10)
        ]);
    }
}
