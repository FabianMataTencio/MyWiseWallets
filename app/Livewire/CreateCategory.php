<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Categorie;

class CreateCategory extends Component
{
    public $category;
    public $type_category;
    public $message;

    protected $rules = [
        'category' => 'required|string|max:255',
        'type_category' => 'required|integer|in:1,2',
    ];

    public function crearCategoria()
    {
        $this->validate();

        Categorie::create([
            'categoria' => $this->category,
            'user_id' => auth()->id(),
            'types_categories_id' => $this->type_category,
        ]);

        $this->message = __('Category has been created successfully.');
        $this->dispatch('categoryCreated');
        $this->reset(['category', 'type_category']);
    }


    public function render()
    {
        return view('livewire.create-category');
    }
}
