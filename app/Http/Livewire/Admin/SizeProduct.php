<?php

namespace App\Http\Livewire\Admin;

use App\Models\Size;
use Livewire\Component;

class SizeProduct extends Component
{
    public $product,$name;
    public $open = false;
    public $name_edit;
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

    public function edit(Size $size)
    {
        $this->open = true;
        $this->size = $size;
        $this->name_edit = $size->name;

    }

    public function update()
    {
        $this->validate([
            'name_edit' => 'required'
        ]);
        $this->size->name = $this->name_edit;
        $this->size->save();

        $this->product = $this->product->fresh();

        $this->open = false;
    }
    public function render()
    {
        $sizes = $this->product->sizes; // me traigo todos los registros de la relacion talla con este producto
        return view('livewire.admin.size-product',compact('sizes'));
    }
}
