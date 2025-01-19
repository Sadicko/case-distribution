<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Court;
use App\Models\Docket;
use App\Models\Location;
use App\Models\Registry;
use Livewire\Component;

class CaseAllocationReport extends Component
{
    public $startDate;
    public $endDate;
    public $legalYearStart;
    public $legalYearEnd;


    //for general court, location and registry info on print page.
    public $courtSelected = null;
    public $courtRegistry = null;
    public $courtLocation = null;

    //variables for listing
    public $categories;
    public $locations;
    public $registries;
    public $courts;
    public $dockets;

    //from filter variables
    public $selectedCourt = 'all';
    public $selectedLocation = 'all';
    public $selectedRegistry = 'all';

    public function mount($legalYearStart, $legalYearEnd)
    {
        $this->legalYearStart = $legalYearStart;
        $this->legalYearEnd = $legalYearEnd;

        $this->startDate = $legalYearStart->format('Y-m-d');
        $this->endDate = $legalYearEnd->format('Y-m-d');
        $this->locations = Location::fetchLocations()->get();
        // $this->categories = Category::getCategories()->with('courttypes')->get();
        // $this->registries = Registry::fetchRegistry()->get();

        $this->fetchReport();
    }

    public function fetchReport()
    {
//                 dd($this->selectedLocation . '-' . $this->selectedRegistry . '-' . $this->selectedCourt . '-' . $this->startDate . '-' . $this->endDate);

        sleep(0.5);

        $query = Docket::getDockets()->with('courts', 'judges');

        if (!empty($this->selectedLocation) && $this->selectedLocation != 'all') {
            $query->where('location_id', $this->selectedLocation);
            $this->courtLocation = Location::query()->find($this->selectedLocation);
        }
//
        if (!empty($this->selectedRegistry) && $this->selectedRegistry != 'all') {
            $query->whereHas('courts', function ($subQuery) {
                $subQuery->where('registry_id', $this->selectedRegistry);
            });
            $this->courtRegistry = Registry::query()->find($this->selectedRegistry);
        }

        if (!empty($this->selectedCourt) && $this->selectedCourt != 'all') {
            $query->where('court_id', $this->selectedCourt);
            $this->courtSelected = Court::query()->find($this->selectedCourt);
        }

        // Adjust the end date to be inclusive of the whole day
        $endDate = date('Y-m-d', strtotime($this->endDate . ' +1 day'));


        $this->dockets = $query->whereBetween('assigned_date', [$this->startDate . ' 00:00:00', $endDate . ' 00:00:00'])
            ->orderBy('assigned_date', 'desc')
            ->get();

        //get registries
        $this->registries = Registry::fetchRegistry()->whereHas('courts', function ($query) {
            $query->where('location_id', $this->selectedLocation);
        })->get();
        //get courts
        $this->courts =  Court::query()->where('registry_id', $this->selectedRegistry)->get();

        // dispatch event to the frontend
        $this->dispatch('search-completed');
    }

    public function clearFilter()
    {
        $this->reset('selectedCourt', 'selectedLocation', 'selectedRegistry');

        $this->startDate = $this->legalYearStart->format('Y-m-d');
        $this->endDate = $this->legalYearEnd->format('Y-m-d');

        $this->fetchReport();
    }

    public function render()
    {
        return view('livewire.case-allocation-report');
    }
}
