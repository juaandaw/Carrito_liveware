<?php

namespace App\Http\Livewire;

use App\Models\Brand;
use App\Models\Color;
use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;

class ShowProducts2 extends Component
{
    public $search;
    public $page;
    public $path;
    public function render()
    {
        $products = Product::where('name','LIKE',"%{$this->search}%")->paginate(10);
        $this->path = $products->path();
        return view('livewire.show-products2',compact('products'))->layout('layouts.admin');
    }

    public function updatedPage()
    {
        $this->redirect($this->page);
    }
}
