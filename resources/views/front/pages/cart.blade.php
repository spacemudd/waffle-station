@extends('front.layouts.master')

<link rel="stylesheet" href="{{ asset('front/cartstyle.css') }}">

@section('content')
<div class="container-fluid my-5">
    <div class="row justify-content-center">
        <div class="col-xl-10" style="margin-top: 10%;">
            <div class="card shadow-lg">
                <div class="row p-2 mt-3 justify-content-between mx-sm-2">
                    <!-- Add any necessary content here -->
                </div>
                <div class="row mx-auto justify-content-center text-center">
                    <!-- Add any necessary content here -->
                </div>

                <div class="row justify-content-around">
                    <div class="col-md-5">
                        <div class="card border-0">
                            <div class="card-header pb-0">
                                <h2 class="card-title space">Checkout</h2>
                                <p class="card-text text-muted mt-4 space">SHIPPING DETAILS</p>
                                <hr class="my-0">
                            </div>
                            <div class="card-body">
                                <div class="row mt-4">
                                    <div class="col"><p class="text-muted mb-2">PAYMENT DETAILS</p><hr class="mt-0"></div>
                                </div>
                                <div class="form-group">
                                    <label for="NAME" class="small text-muted mb-1">NAME ON CARD</label>
                                    <input type="text" class="form-control form-control-sm" name="NAME" id="NAME" placeholder="BBBootstrap Team">
                                </div>
                                <div class="form-group">
                                    <label for="CARD_NUMBER" class="small text-muted mb-1">CARD NUMBER</label>
                                    <input type="text" class="form-control form-control-sm" name="CARD_NUMBER" id="CARD_NUMBER" placeholder="4534 5555 5555 5555">
                                </div>
                                <div class="row no-gutters">
                                    <div class="col-sm-6 pr-sm-2">
                                        <div class="form-group">
                                            <label for="EXPIRY_DATE" class="small text-muted mb-1">VALID THROUGH</label>
                                            <input type="text" class="form-control form-control-sm" name="EXPIRY_DATE" id="EXPIRY_DATE" placeholder="06/21">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="CVC" class="small text-muted mb-1">CVC CODE</label>
                                            <input type="text" class="form-control form-control-sm" name="CVC" id="CVC" placeholder="183">
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-md-5">
                                    <div class="col">
                                        <button type="button" class="btn btn-lg btn-block">PAY</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-5">
                        <div class="card border-0">
                            <div class="card-header card-2">
                                <p class="card-text text-muted mt-md-4 mb-2 space">YOUR ORDER</p>
                                <hr class="my-2">
                            </div>
                            <div class="card-body pt-0">
                                @foreach($cartItems as $item)
                                    <div class="row justify-content-between">
                                            <div class="d-flex gx-2 justify-content-space-between">
                                            <div class="media flex-column flex-sm-row col-md-3">
                                                @if($item->attributes->image)
                                                    <img src="{{ asset('front/products/' . $item->attributes->image) }}" alt="{{ $item->name }}" width="50" height="50">
                                                @endif
                                            </div>
                                            <div class="col-md-5 pt-2">
                                                    <div class="row">
                                                        <div class="col-auto"><p class="mb-0"><b>{{ $item->name }}</b></p></div>
                                                    </div>
                                                </div>

                                                <div class="pt-2">
                                            <p class="boxed-1">{{ $item->quantity }}</p>
                                        </div>

                                        <div class="pt-2 col-md-3">
                                            <p class="text-center"><b>{{ $item->price * $item->quantity }} SAR</b></p>
                                        </div>
                                        </div>
                                        
                                       
                                    </div>
                                    <hr class="my-2">
                                @endforeach

                                <div class="row">
                                    <div class="col">
                                        <div class="row justify-content-between">
                                            <div class="col-4"><p class="mb-1"><b>Subtotal</b></p></div>
                                            <div class="flex-sm-col col-auto"><p class="mb-1"><b>{{ Cart::getTotal() }} SAR</b></p></div>
                                        </div>
                                        <div class="row justify-content-between">
                                            <div class="col"><p class="mb-1"><b>Shipping</b></p></div>
                                            <div class="flex-sm-col col-auto"><p class="mb-1"><b>0 SAR</b></p></div>
                                        </div>
                                        <div class="row justify-content-between">
                                            <div class="col-4"><p><b>Total</b></p></div>
                                            <div class="flex-sm-col col-auto"><p class="mb-1"><b>{{ Cart::getTotal() }} SAR</b></p></div>
                                        </div>
                                        <hr class="my-0">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
