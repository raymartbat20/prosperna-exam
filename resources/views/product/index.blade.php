@extends('layouts.main')
@section('content')
    <div class="main-container">
        <div>
            @foreach ($products->chunk(3) as $chunk_items)
                @foreach($chunk_items as $product)
                    <div class="card product-card">
                        <img src="{{ asset("images/products/{$product->image}") }}" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">₱{{ $product->price }}</h5>
                            <p class="card-text">{{ $product->name }}</p>
                            <div class="d-flex justify-content-center">
                                <a href="{{ route('checkout.index',['product' => $product->slug]) }}" class="btn btn-primary">Checkout me!</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endforeach
        </div>
    </div>
@endsection
@section('scripts')
        <script>
            @if(session()->has('error'))
                Swal.fire({
                    title: 'Error!',
                    text: "{{ session()->get('error') }}",
                    icon: 'error',
                    confirmButtonText: 'Ok'
                })
            @endif
            @if(session()->has('success'))
                Swal.fire({
                    title: 'Success!',
                    text: "{{ session()->get('success') }}",
                    icon: 'success',
                    confirmButtonText: 'Ok'
                })
            @endif
        </script>
@endsection