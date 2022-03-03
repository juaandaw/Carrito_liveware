<?php

namespace App\Http\Livewire;

use App\Models\Brand;
use App\Models\Color;
use App\Models\Product;
use App\Models\Size;
use App\ProductFilter;
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
        'from' => ['except' => ''],
        'to' => ['except' => '']
    ];

    public function mount()
    {
        $this->columnaCheck = $this->columnas;
    }

    public function render(ProductFilter $productFilter)
    {
        return view('livewire.show-products2', [
            'products' => $this->getProducts($productFilter),
        ]);
    }

    protected function getProducts(ProductFilter $productFilter)
    {
        $products = Product::query()
            ->filterBy($productFilter, array_merge(
                [
                    'search' => $this->search,
                    'from' => '2022-03-01',
                    'to' => '2022-03-03',

                ]
            ))
            ->orderByDesc('created_at')
            ->paginate($this->per_page);

        $products->appends($productFilter->valid());

        return $products;
    }

    public function mostrarOcultar()
    {
        $this->mostrar = true;

    }

    public function updatingPerPage()
    {
        $this->resetPage();
    }
}
