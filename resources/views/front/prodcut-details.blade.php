@extends('front.layouts.master')

@section('content')

<link rel="stylesheet" href="{{ asset('front/dstyle.css') }}">

<!-- إضافة ملفات Slick Slider -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/slick-carousel@slick/slick.css"/>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/slick-carousel@slick/slick-theme.css"/>

<main class="container mt-5" style="margin-top: 12rem !important;">
  <div class="row">
    
    <!-- Left Column / Product Image -->
    <div class="col-md-7">
      <img src="{{ asset('front/products/' . $product->image) }}" alt="{{ $product->product_name }}" class="img-fluid">
    </div>

    <!-- Right Column -->
    <div class="col-md-5">
      
      <!-- Product Description -->
      <div class="product-description">
        <span>{{ $product->product_name }}</span>
        <h1>{{ $product->product_name }}</h1>
        <p>{{ $product->description }}</p>
        <h2>{{ $product->price }} SAR</h2>

      </div>

      <!-- Multiple Choices Section -->
      <div class="product-options">
        <h3>Your Choice</h3>
        <div class="form-check">
          <input type="radio" class="form-check-input" id="option1" name="options" value="option1">
          <label class="form-check-label" for="option1">Signature Waffle + 25 Waffle</label>
        </div>
        <div class="form-check">
          <input type="radio" class="form-check-input" id="option2" name="options" value="option2">
          <label class="form-check-label" for="option2">25 Signature Waffle + 25 Mini Pancake</label>
        </div>
        <div class="form-check">
          <input type="radio" class="form-check-input" id="option3" name="options" value="option3">
          <label class="form-check-label" for="option3">50 Signature Waffle</label>
        </div>

        <!-- Multiple Choices (Checkboxes) -->
        <h3>Your Favorite Sauces</h3>
        <div class="form-check">
          <input type="checkbox" class="form-check-input" id="chocolate" name="extras[]" value="chocolate">
          <label class="form-check-label" for="chocolate">Belgian Chocolate <span>Free</span></label>
        </div>
        <div class="form-check">
          <input type="checkbox" class="form-check-input" id="caramel" name="extras[]" value="caramel">
          <label class="form-check-label" for="caramel">Caramel Sauce <span>Free</span></label>
        </div>
        <div class="form-check">
          <input type="checkbox" class="form-check-input" id="pistachio" name="extras[]" value="pistachio">
          <label class="form-check-label" for="pistachio">Pistachio Sauce <span>Free</span></label>
        </div>
      </div>

      <!-- Product Pricing -->
      <div class="product-price text-center">
        <span class="d-block">{{ $product->price }} SAR</span>
      </div>
      <a href="#" class="btn btn-warning mt-2 d-block mx-auto">Add to cart</a>
    </div>
  </div>


</main>

<!-- إضافة سكربت Slick Slider -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/slick-carousel@slick/slick.min.js"></script>

@endsection
