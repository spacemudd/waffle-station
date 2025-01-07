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
                           <!-- إضافة مكتبة Font Awesome -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

<div class="card-body">
    <div class="row mt-4">
        <div class="col">
            <p class="text-muted mb-2">PLEASE SELECT YOUR PAYMENT METHOD</p>
            <hr class="mt-0">
        </div>
    </div>

    <!-- خيارات الدفع مع الأيقونات -->
    <div class="row">
        <div class="col">
            <!-- الخيار الأول -->
            <div class="payment-option">
                <input class="form-check-input" type="radio" name="payment_method" id="credit_debit_card" value="credit_debit_card">
                <label class="form-check-label" for="credit_debit_card">
                    <i class="fas fa-credit-card icon"></i> <!-- أيقونة البطاقة -->
                    Pay with your Credit/Debit Card
                </label>
            </div>

            <!-- الخيار الثاني -->
            <div class="payment-option">
                <input class="form-check-input" type="radio" name="payment_method" id="tabby" value="tabby">
                <label class="form-check-label" for="tabby">
                    <i class="fas fa-wallet icon"></i> <!-- أيقونة المحفظة -->
                    Pay with Tabby
                </label>
            </div>

            <!-- الخيار الثالث -->
            <div class="payment-option">
                <input class="form-check-input" type="radio" name="payment_method" id="tamara" value="tamara">
                <label class="form-check-label" for="tamara">
                    <i class="fas fa-money-check icon"></i> <!-- أيقونة الشيك -->
                    Pay with Tamara
                </label>
            </div>
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
