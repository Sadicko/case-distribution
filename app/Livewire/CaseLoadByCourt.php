<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Court;
use App\Models\Docket;
use App\Models\Location;
use App\Models\Registry;
use Livewire\Component;

class CaseLoadByCourt extends Component
{
    public $startDate;
    public $endDate;
    public $legalYearStart;
    public $legalYearEnd;


    public $courtCategory = null;
    public $courtRegistry = null;
    public $courtLocation = null;

    public $categories;
    public $locations;
    public $registries;

    public $selectedCategory = 'all';
    public $selectedLocation = 'all';
    public $selectedRegistry = 'all';

    public $courts;

    public function mount($legalYearStart, $legalYearEnd)
    {
        $this->legalYearStart = $legalYearStart;
        $this->legalYearEnd = $legalYearEnd;

        $this->startDate = $legalYearStart->format('Y-m-d');
        $this->endDate = $legalYearEnd->format('Y-m-d');
        $this->categories = Category::fetchCategoriesWithRegistries()->with('courttypes')->get();
        $this->locations = Location::fetchLocations()->get();
        // $this->registries = Registry::fetchRegistry()->get();

        $this->fetchReport();
    }

    public function fetchReport()
    {
        // dd($this->selectedLocation . '-' . $this->selectedRegistry . '-' . $this->startDate . '-' . $this->endDate);

        sleep(0.5);

        $query = Court::getCourts()->with('currentJudge');

        if (!empty($this->selectedLocation) && $this->selectedLocation != 'all') {
            $query->where('location_id', $this->selectedLocation);
            $this->courtLocation = Location::find($this->selectedLocation);
        }

        if (!empty($this->selectedRegistry) && $this->selectedRegistry != 'all') {
            $query->where('registry_id', $this->selectedRegistry);
            $this->courtRegistry = Registry::find($this->selectedRegistry);
        }

        if (!empty($this->selectedCategory) && $this->selectedCategory != 'all') {
            $query->whereHas('categories', function ($subQuery) {
                $subQuery->where('categories.id', $this->selectedCategory);
            });
            $this->courtCategory = Category::find($this->selectedCategory);
        }

        // Adjust the end date to be inclusive of the whole day
        $endDate = date('Y-m-d', strtotime($this->endDate . ' +1 day'));


        $this->courts = $query->orderBy('case_count', 'desc')->get();

        $this->registries = Registry::fetchRegistry()->whereHas('courts', function ($query) {
            $query->where('location_id', $this->selectedLocation);
        })->get();

        // dispatch event to the frontend
        $this->dispatch('search-completed');
    }

    public function clearFilter()
    {
        $this->reset('selectedCategory', 'selectedLocation', 'selectedRegistry');

        $this->startDate = $this->legalYearStart->format('Y-m-d');
        $this->endDate = $this->legalYearEnd->format('Y-m-d');

        $this->fetchReport();
    }


    public function render()
    {
        return view('livewire.case-load-by-court');
    }
}
