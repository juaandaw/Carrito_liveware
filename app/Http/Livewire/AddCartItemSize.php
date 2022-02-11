<?php

namespace App\Http\Livewire;

use App\Models\Color;
use App\Models\Size;
use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;

class AddCartItemSize extends Component
{
    public $product;
    public $sizes;
    public $size_id = '';
    public $color_id = '';
    public $colors = [];
    public $qty = 1;
    public $quantity = 0;
    public $options = [];

    public function mount()
    {
        $this->sizes = $this->product->sizes;
        $this->options['image'] = \Storage::url($this->product->images->first()->url);
    }

    public function updatedColorId($value)
    {
        $size = Size::find($this->size_id);
        $color = $size->colors->find($value);
        $this->quantity = $color->pivot->quantity;
        $this->options['color'] = $color->name;
    }

    public function updatedSizeId($value)
    {
        $size = Size::find($value);
        $this->colors = $size->colors;
        $this->options['size'] = $size->name;

    }

    public function decrement()
    {
        $this->qty--;
    }
    public function increment()
    {
        $this->qty++;
    }

    public function addItem()
    {
        Cart::add([
           'id' => $this->product->id,
           'name' => $this->product->name,
           'qty' => $this->qty,
           'price' => $this->product->price,
           'weight' => 550,
           'options' => $this->options,
        ]);
        $this->quantity = qty_avaible($this->product,$this->color_id,$this->size_id);
        $this->reset('qty');
        $this->emitTo('dropdown-cart','render');
    }

    public function render()
    {
        return view('livewire.add-cart-item-size');
    }
}
