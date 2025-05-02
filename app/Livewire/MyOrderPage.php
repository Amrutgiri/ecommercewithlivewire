<?php

namespace App\Livewire;

use App\Models\Order;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Illuminate\Support\Facades\Auth;

#[Title('My Order')]
class MyOrderPage extends Component
{
    use WithPagination;
    public function render()
    {
        $myOrders = Order::where('user_id',Auth::user()->id)->latest()->paginate(10);
        return view('livewire.my-order-page',[
            'orders' => $myOrders,
        ]);
    }
}
