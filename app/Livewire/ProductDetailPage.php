<?php

namespace App\Livewire;

use App\Helpers\CartManagement;
use App\Livewire\Partials\Navbar;
use App\Models\Product;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Product Detail | APINFOTECH')]
class ProductDetailPage extends Component
{
    public $slug;
    public $quantity = 1;

    public function decreaseQuantity(){
        if($this->quantity > 1){
            $this->quantity--;
        }
    }
    public function increaseQuantity(){
        $this->quantity++;
    }

    public function addToCart($product_id){
        $total_count = CartManagement::addItemToCart($product_id);

        $this->dispatch('update-cart-count',total_count:$total_count)->to(Navbar::class);

       LivewireAlert::title('Product Added To Cart successfully!')
       ->success()
       ->toast()
       ->position('top-end')
       ->timer(3000)
       ->show();
    }
    public function mount($slug){
        $this->slug = $slug;
    }
    public function render()
    {
        return view('livewire.product-detail-page',[
            'product'=>Product::where('slug',$this->slug)->first(),
        ]);
    }
}
