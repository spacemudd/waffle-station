@extends('front.layouts.master')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center" style="margin-top: 10%;">
        <div class="col-md-8">
            <div class="card shadow-lg">
                <div class="card-header text-center">
                    <h2>Credit Card Payment</h2>
                </div>
                <div class="card-body">
                    <form action="{{route('process-payment')}}" method="POST">
                        @csrf
                        <!-- Card Number -->
                        <div class="form-group">
                            <label for="card_number">Card Number</label>
                            <input type="text" id="card_number" name="card_number" class="form-control" placeholder="1234 5678 9012 3456" required>
                        </div>

                        <!-- Expiration Date -->
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="expiry_month">Expiration Month</label>
                                <input type="number" id="expiry_month" name="expiry_month" class="form-control" placeholder="MM" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="expiry_year">Expiration Year</label>
                                <input type="number" id="expiry_year" name="expiry_year" class="form-control" placeholder="YYYY" required>
                            </div>
                        </div>

                        <!-- CVV -->
                        <div class="form-group">
                            <label for="cvv">CVV</label>
                            <input type="text" id="cvv" name="cvv" class="form-control" placeholder="123" required>
                        </div>

                        <!-- Cardholder Name -->
                        <div class="form-group">
                            <label for="cardholder_name">Cardholder Name</label>
                            <input type="text" id="cardholder_name" name="cardholder_name" class="form-control" placeholder="John Doe" required>
                        </div>

                        <!-- Payment Button -->
                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-primary btn-lg">Pay Now</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<!-- You can add any additional custom CSS here -->
<style>
    .card {
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    .card-header {
        background-color: #f8f9fa;
        border-bottom: 1px solid #ddd;
        font-size: 1.5rem;
        font-weight: bold;
    }
    .form-group label {
        font-weight: 600;
    }
    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
        width: 100%;
        padding: 12px;
        font-size: 1.1rem;
    }
    .btn-primary:hover {
        background-color: #0056b3;
        border-color: #004085;
    }
</style>
@endsection
