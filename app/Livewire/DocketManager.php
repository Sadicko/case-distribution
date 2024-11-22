<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Court;
use App\Models\Docket;
use App\Traits\AuditTrailLog;
use Livewire\Component;
use Livewire\WithPagination;

class DocketManager extends Component
{
    use WithPagination, AuditTrailLog;

    public $categories;
    public $courts = [];
    public $selectedCategory;
    public $selectedCourt;
    public $startDate;
    public $endDate;
    public $searchTerm;

    public function mount()
    {
        $this->categories = Category::query()->get();
        $this->selectedCategory = null;
        $this->selectedCourt = null;
    }

    public function updatedSelectedCategory($categoryId)
    {

        // When the category changes, fetch related courts
        $this->courts = Court::query()
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

//        dd($this->searchTerm. '-' .$this->selectedCategory.'-' .$this->selectedCourt. '-' .$this->startDate. '-' .$this->endDate);

        $query = Docket::query()->with('categories', 'courts', 'courts.currentJudge');

        if (!empty($this->searchTerm)){
            //$query->searchFullText(trim($this->searchTerm));
            $query->whereLike([ 'suit_number', 'case_title', 'date_filed'], trim(strtoupper($this->searchTerm)));
        }

        //filter by category
        if (!empty($this->selectedCategory)){
            $query->where('dockets.category_id', $this->selectedCategory);
        }

        //filter by court
        if (!empty($this->selectedCourt)){
            $query->where('court_id', $this->selectedCourt);
        }

        if (!empty($this->startDate) && !empty($this->endDate)) {
            $startDate = date('Y-m-d', strtotime($this->startDate));
            $endDate = date('Y-m-d', strtotime($this->endDate));

            $query->whereBetween('date_filed', [$startDate, $endDate]);
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
