<?php

namespace App\Livewire;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Title('Products | APINFOTECH')]
class ProductsPage extends Component
{
    use WithPagination;
    public function render()
    {
        $products = Product::where('is_active', 1);
        return view('livewire.products-page',[
            'products' => $products->paginate(6),
            'brands'=> Brand::where('is_active', 1)->get(['id','name','slug']),
            'categories'=> Category::where('is_active', 1)->get(['id','name','slug']),
        ]);
    }
}
