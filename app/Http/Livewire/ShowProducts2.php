<?php

namespace App\Http\Livewire;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Color;
use App\Models\Product;
use App\Models\Size;
use App\Models\Subcategory;
use App\ProductFilter;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use Livewire\WithPagination;

class ShowProducts2 extends Component
{
    use WithPagination;
    public $search;
    public $per_page;
    public $category_id;
    public $subcategories;
    public $subcategory_id;
    public $sizes;
    public $size_name;
    public $color_id;
    public $brand_id;
    public $priceFrom;
    public $priceTo;
    public $to;
    public $from;
    public $mostrar = false;
    public $columnas = ['Nombre','Categoria','Subcategoria','Marca','Fecha de creacion','Color','Stock','Estado','Precio'];
    public $columnaCheck = [];
    protected $listeners = ['filters'];
    protected $queryString = [
        'search' => ['except' => ''],
        'category_id' => ['except' => 'all'],
        'subcategory_id' => ['except' => 'all'],
        'color_id' => ['except' => 'all'],
        'brand_id' => ['except' => 'all'],
        'size_name' => ['except' => 'all'],
        'priceFrom' => ['except' => ''],
        'priceTo' => ['except' => ''],
        'from' => ['except' => ''],
        'to' => ['except' => '']
    ];

    public function mount()
    {
        $this->reset(['category_id','subcategory_id','brand_id','color_id','size_name','from','to','priceFrom','priceTo']);
        $this->categorias = Category::all();
        $this->brands = Brand::all();
        $this->colors = Color::all();
        $this->sizes = Size::all()->unique('name');
        $this->subcategories = Subcategory::all();
        $this->columnaCheck = $this->columnas;
    }

    public function render(ProductFilter $productFilter)
    {
        return view('livewire.show-products2', [
            'products' => $this->getProducts($productFilter),
        ])->layout('layouts.admin');
    }

    protected function getProducts(ProductFilter $productFilter)
    {
        $products = Product::query()
            ->filterBy($productFilter, array_merge(
                [
                    'search' => $this->search,
                    'category' => $this->category_id,
                    'subcategory' => $this->subcategory_id,
                    'brand' => $this->brand_id,
                    'color' => $this->color_id,
                    'size' => $this->size_name,
                    'priceFrom' => $this->priceFrom,
                    'priceTo' => $this->priceTo,
                    'from' => $this->from,
                    'to' => $this->to,

                ]
            ))
            ->orderByDesc('created_at')
            ->paginate($this->per_page);;


        $products->appends($productFilter->valid());

        return $products;
    }

    public function updatedCategoryId($value)
    {
        $this->subcategories = Subcategory::where('category_id',$value)->get();
        $this->brands = Brand::whereHas('categories',function(Builder $query)use ($value){
            $query->where('category_id',$value);
        })->get();

        $this->reset(['subcategory_id','brand_id']);
    }

    public function updatedpriceFrom()
    {
        $this->resetPage();
    }

    public function mostrarOcultar()
    {
        $this->mostrar = true;

    }

    public function updatedSubcategoryid()
    {
        $this->resetPage();
    }

    public function updatingPerPage()
    {
        $this->resetPage();
    }
}
