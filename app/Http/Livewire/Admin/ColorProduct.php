<?php

namespace App\Http\Livewire\Admin;

use App\Models\Color;
use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;

class ColorProduct extends Component
{
    public $product, $colors;
    public $open = false;
    public $color_id,$quantity;
    public $rules = [
      'color_id' => 'required',
      'quantity' => 'required|numeric'
    ];

    public function mount()
    {
        $this->colors = Color::all();
    }

    public function save()
    {
        $this->validate();

        $this->product->colors()->attach([
            $this->color_id => [
                'quantity' => $this->quantity
            ]
        ]);

        $this->reset(['color_id','quantity']);
        $this->emit('saved');

        $this->product = $this->product->fresh();
    }
    public function render()
    {
        $productColors = $this->product->colors;

        return view('livewire.admin.color-product',compact('productColors'));
    }
}
