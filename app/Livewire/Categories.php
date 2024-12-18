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
        'categoryName' => 'required|string|max:225',
        'courtType' => 'required|integer',
        'status' => 'required',
    ];

    public function saveCategory()
    {
        $this->validate();

        if ($this->checkIfCategoryExist()) {
            $this->addError('categoryName', 'Category name already taken for the specified court type');
            return;
        }


        Category::query()->create([
            'slug' => uniqid(),
            'name' => strtoupper($this->categoryName),
            'status' => $this->status,
            'courttype_id' => $this->courtType,
            'created_by' => Auth::id(),
        ]);

        $this->createAuditTrail("Created new category #" . $this->categoryName);

        $this->reset(['categoryName', 'courtType', 'status']);

        $this->dispatch('categoryUpdated'); // Emit an event to refresh the table
    }


    public function checkIfCategoryExist()
    {
        return Category::query()->where('name', strtoupper($this->categoryName))->where('courttype_id', $this->courtType)->exists();
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

        if ($this->checkIfUpdateCategoryExist()) {
            $this->addError('editCategoryName', 'Category name already taken for specified court type');
            $this->dispatch('show-edit-modal');
            return;
        }

        $category = Category::query()->where('slug', $this->slug)->first();

        $category->update([
            'name' => strtoupper($this->editCategoryName),
            'courttype_id' => $this->editCourtType,
            'status' => $this->editStatus,
        ]);

        //log
        $this->createAuditTrail("Updated records for case category #" . $this->editCategoryName);

        $this->reset(['editCategoryName', 'editCourtType', 'editStatus']);

        // Emit an event to refresh the table
        $this->dispatch('modal-hide');
    }

    public function checkIfUpdateCategoryExist()
    {
        return Category::query()
            ->where('name', strtoupper($this->editCategoryName)) // Check if the name matches
            ->where('courttype_id', $this->editCourtType) // Ensure it's the same court type
            ->where('slug', '!=', $this->slug) // Exclude the current record
            ->exists();
    }



    public function search()
    {
        return Category::query()->with('courttypes')->when($this->query, function ($query) {
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
