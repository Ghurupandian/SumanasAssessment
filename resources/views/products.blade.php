@extends('layouts.app')

@section('content')
<div class="container">
<section>
  <div class="container py-5">

  <header class="text-center mb-5 text-white">
      <div class="row">
        <div class="col-lg-12 mx-auto">
          <h1 class="product-tit">Product List</h1>
        </div>
      </div>
    </header>

    <div class="row text-center align-items-end">
        @foreach($products as $product)
        <div class="col-lg-4 mb-5 mb-lg-0 grid-products">
            <div class="bg-white p-5 rounded-lg shadow">
            <h1 class="h6 text-uppercase font-weight-bold mb-4">{{ $product->name }}</h1>
            <h2 class="h1 font-weight-bold">$ {{ number_format($product->price, 2) }}<span class="text-small font-weight-normal ml-2">/ month</span></h2>

            <div class="custom-separator my-4 mx-auto bg-success"></div>

            <ul class="list-unstyled my-5 text-small text-left font-weight-normal">
                <li class="mb-3">
                    <i class="fa fa-check mr-2 text-primary"></i> {{ $product->description }}
                </li>
            </ul>
            <a href="/buy_product/{{ $product->id }}" class="btn btn-success btn-block shadow rounded-pill">Buy Now</a>
            </div>
        </div>
        @endforeach
    </div>
  </div>
</section>

</div>
@endsection
