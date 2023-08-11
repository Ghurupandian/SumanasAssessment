@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="success-box">
                <img class="img-fluid success" src="{{ asset('images/failure.png') }}">
                <div class="sucess-label">
                    <h2 class="label-red">Product Purchase Failed.<br><span class="msg">{{ $message }}</span></h2>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    setTimeout(function(){
        window.location.href = '/products';
    }, 8000);
</script>
@endsection
