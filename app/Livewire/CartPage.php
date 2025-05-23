<?php

namespace App\Livewire;

use App\Helpers\CartManagement;
use App\Livewire\Partials\Navbar;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Cart | APINFOTECH')]
class CartPage extends Component
{
    public $cart_items=[];
    public $grand_total;

    public function mount(){
        $this->cart_items = CartManagement::getCartItemsFromCookie();
        $this->grand_total = CartManagement::calculateGrandTotal($this->cart_items);
    }

    public function decreaseQuantity($product_id){
        $this->cart_items = CartManagement::decreaseQuantity($product_id);
        $this->grand_total = CartManagement::calculateGrandTotal($this->cart_items);
    }
    public function increaseQuantity($product_id){
        $this->cart_items = CartManagement::increaseQuantity($product_id);
        $this->grand_total = CartManagement::calculateGrandTotal($this->cart_items);
    }
    public function removeItem($product_id){
        $this->cart_items=CartManagement::removeCartItem($product_id);
        $this->grand_total = CartManagement::calculateGrandTotal($this->cart_items);
        $this->dispatch('update-cart-count',total_count:count($this->cart_items))->to(Navbar::class);

        LivewireAlert::title('Product Remove from Cart successfully!')
       ->info()
       ->toast()
       ->position('top-end')
       ->timer(3000)
       ->show();
    }

    public function render()
    {
        return view('livewire.cart-page');
    }
}
