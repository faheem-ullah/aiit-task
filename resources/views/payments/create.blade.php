@extends('layouts.app')
@section('content')
<form action="{{ route('checkout',$vehicle->id) }}" method="POST">
    @csrf
    <script
        src="https://checkout.stripe.com/checkout.js"
        class="stripe-button"
        data-key="{{ config('services.stripe.key') }}"
        data-amount="{{$vehicle->price ?? 0}}"
        data-name="AIIT"
        data-description="One-time Payment"
        data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
        data-locale="auto"
        data-currency="usd"
        data-label="Pay Now"
    ></script>
</form>


@endsection