<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Product;
use App\Models\Subcategory;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;

class ShowFilters extends Component
{
    public $open;
    public $categorias;
    public $selCategoria;
    public $subcategoria;
    public $subcategory_id = [];

    public function render()
    {
        return view('livewire.show-filters');
    }

    public function mount()
    {
        $this->categorias = Category::all();
    }

    public function mostrar()
    {
        $this->open = true;
    }

    public function updatedselCategoria()
    {
        $this->subcategoria = Subcategory::where('category_id',$this->selCategoria)->get();
        $this->Filters();
    }

    public function updatedsubcategoryid()
    {
        $this->Filters();
    }

    public function Filters()
    {
        if ($this->selCategoria && $this->subcategory_id){
            $this->emit('filters',$this->selCategoria,$this->subcategory_id);
        }else {
            if($this->selCategoria){
                $this->emit('filters',$this->selCategoria);
            }
        }
    }
}
