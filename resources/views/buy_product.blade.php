@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <b>Product Checkout</b>
                    <div class="btn-group pull-right" style="margin-right: 5px">
                        <a href="/products" class="btn btn-sm btn-danger" title="List"><i class="fa fa-arrow-left"></i><span class="hidden-xs">&nbsp;Back</span></a>
                    </div>
                </div>

                <div class="card-body">

                    <form id="payment-form" action="/makePayment" method="POST">
                        @csrf
                        <input type="hidden" name="product" id="product" value="{{ $product->id }}">

                        <div class="row">
                            <div class="col-6">
                                <label class="lbl" for="">Name : <b class="lbl-value">{{$product->name}}</b></label>
                            </div>
                            <div class="col-6">
                                <label class="lbl" for="">Price : <b class="lbl-value">$ {{ number_format($product->price, 2) }}</b></label>
                            </div>
                            <div class="col-12">
                                <label class="lbl" for="">Description :-</label>
                                <p class="lbl-value desc">{{ $product->description }}</p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xl-4 col-lg-4">
                                <div class="form-group">
                                    <label for="">Name</label>
                                    <input type="text" name="name" id="card-holder-name" class="form-control" value="" placeholder="Name on the card">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xl-4 col-lg-4">
                                <div class="form-group">
                                    <label for="">Card details</label>
                                    <div id="card-element"></div>
                                </div>
                            </div>
                            <div class="col-xl-12 col-lg-12" style="text-align:center">
                            <hr>
                                <button type="submit" class="btn btn-success" id="card-button" data-secret="{{ $stripe_intent->client_secret }}">Pay</button>
                            </div>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://js.stripe.com/v3/"></script>
<script>
    const stripe = Stripe('{{ env('STRIPE_KEY') }}')

    const elements = stripe.elements()
    const cardElement = elements.create('card')

    cardElement.mount('#card-element')

    const form = document.getElementById('payment-form')
    const pay_button = document.getElementById('card-button')
    const name = document.getElementById('card-holder-name')

    form.addEventListener('submit', async (e) => {
        e.preventDefault()

        pay_button.disabled = true
        const { setupIntent, error } = await stripe.confirmCardSetup(
            pay_button.dataset.secret, {
                payment_method: {
                    card: cardElement,
                    billing_details: {
                        name: name.value
                    }
                }
            }
        )

        if(error) {
            pay_button.disabled = false
            Toastify({
                text: error.code,
                class: "failure",
                style: {
                    background: "red",
                }
            }).showToast();
        } else {
            let token = document.createElement('input')
            token.setAttribute('type', 'hidden')
            token.setAttribute('name', 'token')
            token.setAttribute('value', setupIntent.payment_method)
            form.appendChild(token)
            form.submit();
        }
    })
</script>
@endsection
