<x-mail::message>
    # Order Placed Suuccessfully!

    Your order has been placed successfully. Here are the details:
    - Order ID: {{ $order->id }}

    <x-mail::button :url="$url">
        View Order
    </x-mail::button>

    Thanks,<br>
    {{ config('app.name') }}
</x-mail::message>
