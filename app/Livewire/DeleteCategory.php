<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Categorie;

class DeleteCategory extends Component
{
    public $categories;
    public $selectedCategory;

    protected $rules = [
        'selectedCategory' => 'required|exists:categories,id',
    ];

    protected $listeners = ['categoryCreated' => 'updateCategories'];

    public function mount()
    {
        $this->loadCategories();
    }

    public function updateCategories()
    {
        $this->loadCategories();
    }

    public function loadCategories()
    {
        $this->categories = Categorie::where('user_id', auth()->id())
            ->where('types_categories_id', '!=', 3)
            ->get();
    }


    public function eliminarCategoria()
    {
        $this->validate();

        $category = Categorie::find($this->selectedCategory);
        if ($category) {
            $category->delete();
            session()->flash('message', __('Category has been deleted successfully.'));
            $this->loadCategories();
            $this->selectedCategory = null;
        } else {
            session()->flash('error', __('Category not found.'));
        }
    }


    public function render()
    {
        return view('livewire.delete-category');
    }
}
