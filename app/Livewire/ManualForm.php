<?php

namespace App\Livewire;

use App\Models\Court;
use App\Models\Judge;
use Livewire\Component;

class ManualForm extends Component
{
    public $categories;
    public $locations;
    public $courts = [];
    public $judges = [];
    public $selectedLocation;
    public $selectedCourt;
    public $selectedJudge;

    public function updatedSelectedLocation($selectedLocation)
    {

        $this->courts = Court::getCourts()->whereHas('categories')->where('location_id', $selectedLocation)->orderBy('name', 'asc')->get();

        // Reset the selected court
        $this->selectedCourt = null;

        //dispatch event
        $this->dispatch('select2Updated');
    }
    public function updatedSelectedCourt($selectedCourt)
    {

//        dd($selectedCourt);
        $this->judges = Judge::query()->whereHas('courts', function ($query) use ($selectedCourt) {
            $query->where('court_id', $selectedCourt);
        })->orderBy('name', 'asc')->get();

        // Reset the selected judge
        $this->selectedJudge = null;

        $this->dispatch('select2Updated');
    }


    public function render()
    {
        return view('livewire.manual-form');
    }
}
