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
    public $categories;
    public $selectedCategory = 'all';
    public $category = null;
    public $locations;
    public $registries;
    public $dockets;

    public function mount($legalYearStart, $legalYearEnd)
    {
        $this->legalYearStart = $legalYearStart;
        $this->legalYearEnd = $legalYearEnd;

        $this->startDate = $legalYearStart->format('Y-m-d');
        $this->endDate = $legalYearEnd->format('Y-m-d');
        $this->categories = Category::getCategories()->get();
        $this->locations = Location::fetchLocations()->get();
        $this->registries = Registry::fetchRegistry()->get();
        $this->fetchReport();
    }

    public function fetchReport()
    {
        $query = Docket::getDockets()->with('courts', 'judges');

        if (!empty($this->selectedCategory) && $this->selectedCategory != 'all') {
            $query->where('category_id', $this->selectedCategory);
            $this->category = Category::find($this->selectedCategory);
        }

        // Adjust the end date to be inclusive of the whole day
        $endDate = date('Y-m-d', strtotime($this->endDate . ' +1 day'));


        $this->dockets = $query->selectRaw('court_id, judge_id, COUNT(*) as case_load')
            ->whereBetween('assigned_date', [$this->startDate . ' 00:00:00', $endDate . ' 00:00:00'])
            ->groupBy('court_id', 'judge_id')
            ->orderBy('case_load', 'desc')
            ->get();
    }

    public function clearFilter()
    {
        $this->reset('selectedCategory');

        $this->startDate = $this->legalYearStart->format('Y-m-d');
        $this->endDate = $this->legalYearEnd->format('Y-m-d');

        $this->fetchReport();
    }


    public function render()
    {
        return view('livewire.case-load-by-registry');
    }
}
