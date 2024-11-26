<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Courttype;
use App\Traits\AuditTrailLog;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class Categories extends Component
{
    use WithPagination, AuditTrailLog;

    //Create variables
    public $categoryName;
    public $status;
    public $courtType;

    //edit variables
    public $category;
    public $editCategoryName;
    public $editCourtType;
    public $editStatus;
    public $slug;

    //general variables
    public $query;
    public $courtTypes;

    public function mount()
    {
        $this->courtTypes = Courttype::query()->get();
    }


    protected $rules = [
        'categoryName' => 'required|string|max:225|unique:categories,name',
        'courtType' => 'required|integer',
        'status' => 'required',
    ];

    public function saveCategory()
    {
        $this->validate();
        Category::query()->create([
            'slug' => uniqid(),
            'name' => strtolower($this->categoryName),
            'status' => $this->status,
            'courttype_id' => $this->courtType,
            'created_by' => Auth::id(),
        ]);

        $this->createAuditTrail("Created new category #".$this->categoryName);

        $this->reset(['categoryName', 'courtType', 'status']);

        $this->dispatch('categoryUpdated'); // Emit an event to refresh the table
    }

    public function edit($slug)
    {
        $category = Category::query()->where('slug', $slug)->firstOrFail();

        $this->editCategoryName = $category->name;
        $this->editCourtType = $category->courttype_id;
        $this->editStatus = $category->status;
        $this->slug = $category->slug;

        $this->dispatch('show-edit-modal');
    }

    public function update()
    {
        $this->validate([
            'editCategoryName' => 'required|string|max:225',
            'editCourtType' => 'required|integer',
            'editStatus' => 'required',
        ]);

        $category = Category::query()->where('slug', $this->slug)->first();

        $category->update([
            'name' => strtoupper($this->editCategoryName),
            'courttype_id' => $this->editCourtType,
            'status' => $this->editStatus,
        ]);

        //log
        $this->createAuditTrail("Updated records for case category #".$this->editCategoryName);

        $this->reset(['editCategoryName', 'editCourtType', 'editStatus']);

        // Emit an event to refresh the table
        $this->dispatch('modal-hide');
    }



    public function search()
    {
        return Category::query()->with('courttypes')->when($this->query, function ($query){
            $query->whereLike(['name'], $this->query);
        })->latest()->paginate(15);
    }

    public function clear()
    {
        $this->query = '';
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.categories', [
            'categories' => $this->search(),
        ]);
    }
}
