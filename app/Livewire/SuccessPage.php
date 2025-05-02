<?php

namespace App\Livewire;

use App\Models\Order;
use Livewire\Component;
use Livewire\Attributes\Title;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Url;
use Stripe\Checkout\Session as CheckoutSession;
use Stripe\Stripe;

#[Title('Succcess Order | APINFOTECH')]
class SuccessPage extends Component
{
    #[Url]
    public $session_id;
    public function render()
    {
        $latestOrder=Order::with(['address'])->where('user_id', Auth::user()->id)->latest()->first();
        if($this->session_id){
            Stripe::setApiKey(env('STRIPE_SECRET_KEY'));
            $sessionInfo=CheckoutSession::retrieve($this->session_id);

            if($sessionInfo->payment_status!='paid'){
                $latestOrder->payment_status='failed';
                $latestOrder->save();
                return $this->redirect('/cancel',navigate: true);
            }else if($sessionInfo->payment_status=='paid'){
                $latestOrder->payment_status='paid';
                $latestOrder->save();
            }

        }
        return view('livewire.success-page',[
            'order'=>$latestOrder,
        ]);
    }
}
