<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;

class SizeProduct extends Component
{
    public $product,$name;
    public $rules = [
        'name' => 'required'
    ];

    public function save()
    {
        $this->validate();

        $this->product->sizes()->create([
            'name' => $this->name,
        ]);

        $this->product = $this->product->fresh();
    }
    public function render()
    {
        $sizes = $this->product->sizes; // me traigo todos los registros de la relacion talla con este producto
        return view('livewire.admin.size-product',compact('sizes'));
    }
}
