<div>
    {{-- If your happiness depends on money, you will never be happy with yourself. --}}
    <select wire:model="price_selector">
        @forelse ($prices as $price)
            <option value="{{$price}}">$ {{$price}}.00</option>
        @empty
        @endforelse
        <option value="custom">{{__("Custom")}}</option>
    </select>

    @if ($price_selector == 'custom')
        <input type="text" wire:model="price" placeholder="{{ __('Enter a custom amount') }}" class="my-2">
    @else

    @endif

    @if (!auth()->user()->defaultPaymentMethod())
        <div class="my-6 border-t"></div>

        <label for="card-holder-name">{{__("Card holder name")}}</label>
        <input id="card-holder-name" type="text" placeholder="John Doe">

        <!-- Stripe Elements Placeholder -->
        <div id="card-element" class="mt-4 bg-white rounded-md shadow-sm border border-gray-300 px-3"></div>

        <button id="card-button" data-secret="{{ auth()->user()->createSetupIntent()->client_secret }}" class="mt-4 px-3 py-2 rounded shadow-md text-center hover:shadow text-sm font-semibold bg-yellow-400">
            {{__("Donate")}}
        </button>

        <script src="https://js.stripe.com/v3/"></script>

        <script>
            const stripe = Stripe("{{ config('cashier.key') }}");

            const elements = stripe.elements();
            const cardElement = elements.create('card', {
            style: {
                base: {
                    lineHeight: '2.5',
                    iconColor: '#000',
                    color: '#000',
                    fontWeight: '500',
                    fontFamily: 'Roboto, Open Sans, Segoe UI, sans-serif',
                    fontSize: '16px',
                    fontSmoothing: 'antialiased',
                    ':-webkit-autofill': {
                        color: '#fce883',
                    },
                    '::placeholder': {
                        color: 'rgba(0,0,0,0.5)',
                    },
                },
                invalid: {
                iconColor: 'red',
                color: 'red',
                },
            },
            });

            cardElement.mount('#card-element');

            const cardHolderName = document.getElementById('card-holder-name');
            const cardButton = document.getElementById('card-button');
            const clientSecret = cardButton.dataset.secret;

            cardButton.addEventListener('click', async (e) => {
                const { setupIntent, error } = await stripe.confirmCardSetup(
                    clientSecret, {
                        payment_method: {
                            card: cardElement,
                            billing_details: { name: cardHolderName.value }
                        }
                    }
                );

                if (error) {
                    // Display "error.message" to the user...
                    alert("Error!");
                } else {
                    window.livewire.emit('paymentMethod', setupIntent.payment_method);
                }
            });
        </script>

        @else
        <button wire:click="donate" class="mt-4 px-3 py-2 rounded shadow-md text-center hover:shadow text-sm font-semibold bg-yellow-400">
            {{__("Donate")}}
        </button>
    @endif
</div>
