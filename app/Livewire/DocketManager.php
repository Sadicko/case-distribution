<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Court;
use App\Models\Docket;
use App\Models\Location;
use App\Models\Registry;
use App\Traits\AuditTrailLog;
use Livewire\Component;
use Livewire\WithPagination;

class DocketManager extends Component
{
    use WithPagination, AuditTrailLog;

    public $categories;
    public $registries;
    public $locations;
    public $courts = [];
    public $selectedCategory = null;
    public $selectedCourt = null;
    public $selectedLocation = 'all';
    public $selectedRegistry = 'all';
    public $court;
    public $startDate;
    public $endDate;
    public $searchTerm;

    public function mount()
    {
        $this->categories = Category::fetchCategoriesWithRegistries()->with('courttypes')->get();
        $this->locations = Location::fetchLocations()->get();
    }

    public function updatedSelectedCategory($categoryId)
    {

        // When the category changes, fetch related courts
        $this->courts = Court::getCourts()
            ->whereHas('categories', function ($query) use ($categoryId) {
                $query->where('categories.id', $categoryId);
            })
            ->get();

        // Reset the selected court
        $this->selectedCourt = null;

        //dispatch event
        $this->dispatch('search-completed');
    }

    public function search()
    {

        //dd($this->searchTerm. '-' .$this->selectedCategory.'-' .$this->selectedCourt. '-' .$this->startDate. '-' .$this->endDate);

        $query = Docket::getDockets()->with('categories', 'courts', 'courts.currentJudge');

        //filter by search term
        if (!empty($this->searchTerm)) {
            $query->searchFullText(trim($this->searchTerm));
            //$query->whereLike([ 'suit_number', 'case_title'], trim(strtoupper($this->searchTerm)));
        }

        //filter by location
        if (!empty($this->selectedLocation) && $this->selectedLocation != 'all') {
            $query->where('location_id', $this->selectedLocation);
        }

        //filter by registry
        if (!empty($this->selectedRegistry) && $this->selectedRegistry != 'all') {
            $query->whereHas('courts', function ($subQuery) {
                $subQuery->where('registry_id', $this->selectedRegistry);
            });
        }

        //filter by category
        if (!empty($this->selectedCategory)) {
            $query->where('dockets.category_id', $this->selectedCategory);
        }

        //filter by court
//        dd($this->selectedCourt);
        if (!empty($this->selectedCourt)) {
            $query->where('court_id', $this->selectedCourt);
        }

        //filter by date range
        if (!empty($this->startDate) && !empty($this->endDate)) {

            $startDate = date('Y-m-d', strtotime($this->startDate));

            // Adjust the end date to be inclusive of the whole day
            $endDate = date('Y-m-d', strtotime($this->endDate . ' +1 day'));

            $query->whereBetween('assigned_date', [$startDate . ' 00:00:00', $endDate . ' 00:00:00']);
        }

        //get registries
        $this->registries = Registry::fetchRegistry()->whereHas('courts', function ($query) {
            $query->where('location_id', $this->selectedLocation);
        })->get();

        //get courts for admins. other users get courts from the updatedSelectedCategory method
        if (!empty($this->selectedRegistry) && $this->selectedRegistry != 'all') {
            $this->courts =  Court::query()->where('registry_id', $this->selectedRegistry)->get();
        }


        $this->dispatch('search-completed');

        return $query->latest()->paginate(15);
    }

    public function clear()
    {
        //clear inputs
        $this->reset(['selectedCategory', 'selectedCourt', 'searchTerm', 'endDate', 'startDate']);
        // Update transactions after clearing filters
        $this->search();
    }



    public function render()
    {

        return view('livewire.docket-manager', [
            'dockets' => $this->search(),
        ]);
    }
}
