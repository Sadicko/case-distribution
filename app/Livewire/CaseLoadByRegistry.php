<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Docket;
use App\Models\Location;
use App\Models\Registry;
use Livewire\Component;

class CaseLoadByRegistry extends Component
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

    public $dockets;

    public function mount($legalYearStart, $legalYearEnd)
    {
        $this->legalYearStart = $legalYearStart;
        $this->legalYearEnd = $legalYearEnd;

        $this->startDate = $legalYearStart->format('Y-m-d');
        $this->endDate = $legalYearEnd->format('Y-m-d');
        $this->categories = Category::getCategories()->get();
        $this->locations = Location::fetchLocations()->get();
        // $this->registries = Registry::fetchRegistry()->get();

        $this->fetchReport();
    }

    public function fetchReport()
    {
        // dd($this->selectedLocation . '-' . $this->selectedRegistry . '-' . $this->startDate . '-' . $this->endDate);

        sleep(0.5);

        $query = Docket::getDockets()->with('courts', 'judges');

        if (!empty($this->selectedLocation) && $this->selectedLocation != 'all') {
            $query->where('location_id', $this->selectedLocation);
            $this->courtLocation = Location::find($this->selectedLocation);
        }

        if (!empty($this->selectedRegistry) && $this->selectedRegistry != 'all') {
            $query->whereHas('courts', function ($subQuery) {
                $subQuery->where('registry_id', $this->selectedRegistry);
            });
            $this->courtRegistry = Registry::find($this->selectedRegistry);
        }

        if (!empty($this->selectedCategory) && $this->selectedCategory != 'all') {
            $query->where('category_id', $this->selectedCategory);
            $this->courtCategory = Category::find($this->selectedCategory);
        }

        // Adjust the end date to be inclusive of the whole day
        $endDate = date('Y-m-d', strtotime($this->endDate . ' +1 day'));


        $this->dockets = $query->selectRaw('court_id, judge_id, COUNT(*) as case_load')
            ->whereBetween('assigned_date', [$this->startDate . ' 00:00:00', $endDate . ' 00:00:00'])
            ->groupBy('court_id', 'judge_id')
            ->orderBy('case_load', 'desc')
            ->get();

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
        return view('livewire.case-load-by-registry');
    }
}
