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
    public $product;
    public $category_id;
    public $subcategory_id;
    public $color_id;
    public $brand_id;
    public $mostrar = false;
    public $columnas = ['Nombre','Categoria','Subcategoria','Marca','Fecha de creacion','Color','Stock','Estado','Precio'];
    public $columnaCheck = [];
    protected $listeners = ['filters'];


    public function mount()
    {
        $this->columnaCheck = $this->columnas;
    }

    public function render()
    {
        $product = Product::query()
            ->with('subcategory','subcategory.category','colors','sizes.colors','brand')
            ->when($this->search,function (Builder $query){
                $query->where('name','LIKE',"%{$this->search}%");
            })
            ->when($this->category_id,function (Builder $query){
                $query->whereHas('subcategory.category',function (Builder $query) {
                    $query->where('category_id',$this->category_id);
                });
            })->when($this->subcategory_id,function (Builder $query){
                $query->whereIn('subcategory_id',$this->subcategory_id);
            })
            ->when($this->brand_id,function (Builder $query){
                $query->where('brand_id',$this->brand_id);
            })
            ->when($this->color_id,function (Builder $query){
                $query->whereHas('colors',function (Builder $query){
                    $query->where('color_id',$this->color_id);
                })->orWhereHas('sizes.colors',function (Builder $query){
                    $query->where('color_id',$this->color_id);
                });
            })->paginate();

        $products = $product ?: Product::where('name','LIKE',"%{$this->search}%")->paginate($this->per_page);

        return view('livewire.show-products2',compact('products'))->layout('layouts.admin');
    }

    public function mostrarOcultar()
    {
        $this->mostrar = true;

    }

    public function updatingPerPage()
    {
        $this->resetPage();
    }

    public function filters($category_id,
                            $subcategory_id,
                            $brand_id,
                            $color_id)
    {
        $this->category_id = $category_id;
        $this->subcategory_id = $subcategory_id;
        $this->brand_id = $brand_id;
        $this->color_id = $color_id;
    }
}
