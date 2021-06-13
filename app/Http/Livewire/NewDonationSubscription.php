<?php

namespace App\Http\Livewire;

use Livewire\Component;

class NewDonationSubscription extends Component
{
    public $price_selector;
    public $price = 0;
    public $prices = [
        '5',
        '10',
        '15',
        '25',
        '50',
        '100',
    ];
    public $total;

    protected $listeners = ['paymentMethod'];

    public function paymentMethod($payment_method)
    {
        auth()->user()->updateDefaultPaymentMethod($payment_method);

        $this->donate();
    }

    public function donate()
    {
        $amount = $this->total * 100;

        auth()->user()->newSubscription(
            // TODO: Define the product name and the pricing
            'CubaEscucha Monthly Donation', 'price_1J1jrMBDtpph984XG6SVHfzQ'
        )->add();

        return redirect()->to('/donate/thank-you');
    }

    public function render()
    {
        $this->total = ($this->price_selector == 'custom') ? $this->price : $this->price_selector ;

        return view('livewire.new-donation-subscription');
    }
}
