@extends('layouts.main')
@section('content')
    <div class="d-flex justify-content-center" style="width: 50vw; height: 80vh">
        <div class="card product-card mr-3" style="width: 70%">
            <div class="card-body">
                <h2 class="card-text text-center">{{ $product->name }}</h2>
                <h5 class="card-title text-center">Price: ₱{{ Helper::money_formatter($product->price) }}</h5>
            </div>
            <img src="{{ asset("images/products/{$product->image}") }}" class="card-img-top" alt="{{ $product->image }}">
        </div>
        <div>
            <form action="{{ route('checkout.make.payment',['product' => $product->slug]) }}" method="POST">
                <div class="d-flex justify-content-center text-center" style="height: 80vh">
                    @csrf
                    <div class="checkout-card px-1 py-4">
                        <div class="card-body">
                            <h6 class="information mt-4">Please provide following information</h6>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <input class="form-control {{ $errors->has("first_name") ? 'is-invalid' : '' }}" type="text" placeholder="First Name" name="first_name" id="first_name" value="{{ old('first_name') }}">
                                    </div>
                                </div>
                                @if($errors->has('first_name'))
                                    <small class="text-danger" style="text-align: left !important; margin-left: 2px;">{{ $errors->first('first_name') }}</small>
                                @endif
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <input class="form-control {{ $errors->has("middle_name") ? 'is-invalid' : '' }}" type="text" placeholder="Middle Name" name="middle_name" id="middle_name" value="{{ old('middle_name') }}">
                                    </div>
                                </div>
                                @if($errors->has('middle_name'))
                                    <small class="text-danger" style="text-align: left !important; margin-left: 2px;">{{ $errors->first('middle_name') }}</small>
                                @endif
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <input class="form-control {{ $errors->has("last_name") ? 'is-invalid' : '' }}" type="text" placeholder="Last Name" name="last_name" id="last_name" value="{{ old('last_name') }}">
                                    </div>
                                </div>
                                @if($errors->has('last_name'))
                                    <small class="text-danger" style="text-align: left !important; margin-left: 2px;">{{ $errors->first('last_name') }}</small>
                                @endif
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <input class="form-control {{ $errors->has("email") ? 'is-invalid' : '' }}" type="text" placeholder="Email" name="email" id="email" value="{{ old('email') }}">
                                        </div>
                                    </div>
                                </div>
                                @if($errors->has('email'))
                                    <small class="text-danger" style="text-align: left !important; margin-left: 2px;">{{ $errors->first('email') }}</small>
                                @endif
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <input class="form-control {{ $errors->has("mobile") ? 'is-invalid' : '' }}" type="text" placeholder="Mobile" name="mobile" id="mobile" value="{{ old('mobile') }}">
                                        </div>
                                    </div>
                                </div>
                                @if($errors->has('mobile'))
                                    <small class="text-danger" style="text-align: left !important; margin-left: 2px;">{{ $errors->first('mobile') }}</small>
                                @endif 
                            </div>
                            <div class=" d-flex flex-column text-center px-5 mt-3 mb-3">
                                <small class="agree-text">By Booking this appointment you agree to the</small>
                                <a href="#" class="terms">Terms & Conditions</a>
                            </div>
                            <button class="btn btn-primary btn-block confirm-button">Submit</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection