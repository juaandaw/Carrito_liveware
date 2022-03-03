<?php

namespace App\Http\Livewire;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Color;
use App\Models\Product;
use App\Models\Subcategory;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use Carbon\Carbon;

class ShowFilters extends Component
{
    public $open;
    public $categorias;
    public $selCategoria;
    public $subcategoria;
    public $brands;
    public $colors;
    public $subcategory_id = [];
    public $priceFrom;
    public $priceTo;
    public $to;
    public $from;
    public $color_id;
    public $brand_id;
    public $search;
    protected $rules = [
        'selCategoria' => 'filled',
        'subcategory_id' => 'filled',
        'brand_id' => 'filled',
        'color_id' => 'filled',
        'priceFrom' => 'filled',
        'priceTo' => 'filled',
        'from' => 'filled',
        'to' => 'filled',
    ];



    public function render()
    {

        return view('livewire.show-filters');
    }

    public function mount()
    {
        $this->categorias = Category::all();
        $this->brands = Brand::all();
        $this->colors = Color::all();
    }

    public function mostrar()
    {
        $this->open = true;
    }

    public function updatedselCategoria()
    {
        $this->subcategoria = Subcategory::where('category_id',$this->selCategoria)->get();
    }

    public function filters()
    {

        if($this->selCategoria == "Elige una categoria"){
            $this->selCategoria = null;
        }elseif($this->brand_id == "Elige una marca"){
            $this->brand_id = null;
        }elseif($this->color_id == "Elige un color"){
            $this->color_id = null;
        }
        $this->validate();


        $this->emitTo('show-products2','filters',$this->selCategoria,
            $this->subcategory_id,
            $this->brand_id,
            $this->color_id,
            $this->priceFrom,
            $this->priceTo,
            $this->from,
            $this->to);

    }
}
