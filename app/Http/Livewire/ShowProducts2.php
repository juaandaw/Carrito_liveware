<?php

namespace App\Http\Livewire;

use App\Models\Brand;
use App\Models\Color;
use App\Models\Product;
use App\Models\Size;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use Livewire\WithPagination;

class ShowProducts2 extends Component
{
    use WithPagination;
    public $search;
    public $per_page;

    public function render()
    {

        $products = Product::where('name','LIKE',"%{$this->search}%")->paginate($this->per_page);

        return view('livewire.show-products2',compact('products'))->layout('layouts.admin');
    }

    public function updatingPerPage()
    {
        $this->resetPage();
    }
}
