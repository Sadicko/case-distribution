<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Court;
use Livewire\Component;

class DocketManager extends Component
{

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

        $this->selectedCourt = null; // Reset the selected court

        $this->dispatch('search-completed');
    }

    public function search()
    {

        dd($this->searchTerm. '-' .$this->selectedCategory.'-' .$this->selectedCourt. '-' .$this->startDate. '-' .$this->endDate);


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
//        $categories = Category::query()->get();

        return view('livewire.docket-manager');
    }
}
