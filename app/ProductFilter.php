<?php

namespace App;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class ProductFilter extends QueryFilter
{

    public function rules(): array
    {
        return [
            'search' => 'filled',
            'category_id' => 'exists:categories,id',
            'subcategory_id' => 'exists:subcategories,id',
            'brand_id' => 'exists:brands,id',
            'color_id' => 'exists:colors,id',
            'from' => 'filled|date_format:Y-m-d',
            'to' => 'filled|date_format:Y-m-d',
            'priceFrom' => 'filled',
            'priceTo' => 'filled',
        ];
    }

    public function search($query, $search)
    {
        return $query->where(function($query) use ($search) {
                    $query->where('name', 'LIKE', "%{$search}%");
                });
    }

    public function from($query, $date)
    {
        $date = Carbon::createFromFormat('Y-m-d', $date);

        $query->whereDate('created_at', '>=', $date);
    }

    public function to($query, $date)
    {
        $date = Carbon::createFromFormat('Y-m-d', $date);

        $query->whereDate('created_at', '<=', $date);
    }
}
