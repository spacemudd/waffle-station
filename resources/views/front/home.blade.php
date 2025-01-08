@extends('front.layouts.master')

<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
<!-- SweetAlert2 CSS -->
<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.6.5/dist/sweetalert2.min.css" rel="stylesheet">
<!-- SweetAlert2 JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.6.5/dist/sweetalert2.all.min.js"></script>



@section('content')

@if(session('showLoginModal'))
    <script>
        Swal.fire({
            icon: 'warning',
            title: 'Please Log in First',
            text: 'You must log in to proceed with your booking.',
            confirmButtonText: 'OK'
        }).then(() => {
            // فتح مودال تسجيل الدخول بعد عرض التنبيه
            var loginModal = new bootstrap.Modal(document.getElementById('loginModal'), {
                keyboard: false
            });
            loginModal.show();
        });
    </script>
@endif



@if(session('unauthorized_message'))
    <script>
        alert("{{ session('unauthorized_message') }}");
    </script>
@endif


@if (session('message'))
<div>{{ session('messege') }}</div>
@endif
    
    <div class="video-container">
        <video autoplay muted loop>
            <source src="{{ asset('assets/video/Website-Video_20221.mp4') }}" type="video/mp4">
            Your browser does not support the video tag.
        </video>
        <!-- الأزرار -->
        <div id="ssb-container">
            <ul class="ssb-dark-hover">
                <li id="ssb-btn-1">
                    <a href="#" target="_blank">
                    <span class="fab fa-facebook-f"></span>
                    </a>
                </li>
                <li id="ssb-btn-0">
                    <a href="#" target="_blank">
                    <span class="fab fa-instagram"></span>
                    </a>
                </li>
                <li id="ssb-btn-0">
                    <a href="#" target="_blank">
                    <span class="fab fa-tiktok"></span>
                    </a>
                </li>
                <li id="ssb-btn-0">
                    <a href="#" target="_blank">
                    <span class="fas fa-location-pin"></span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <section style="margin-top: 50px; padding: 20px 0;">
    <div class="container">
        <!-- Title Section -->
        <div class="text-center mb-5" style="padding-top: 20px;">
            <h2 style="font-size: 2rem; font-weight: bold; color: #333; margin-bottom: 20px;">Most Popular Products</h2>
            <hr style="width: 50px; border: 2px solid #007bff; margin: 10px auto;">
        </div>

        <!-- Cards Section -->
        <div class="row gy-4">
        @foreach($products as $product)
    <div class="col-md-4">
        <a href="{{ route('product.details', ['id' => $product->id]) }}">
            <div class="card text-black" style="width: 90%; font-size: 0.8rem; margin: auto;">
                <img src="{{ asset('front/products/' . $product->image) }}" class="card-img-top" alt="{{ $product->product_name }}" style="height: 300px;" />
                <div class="card-body" style="padding: 10px;">
                    <div class="text-center">
                        <h5 class="card-title" style="font-size: 1rem; margin-bottom: 5px;">{{ $product->product_name }}</h5>
                    </div>
                    <div>
                        <div class="d-flex justify-content-between" style="margin-bottom: 5px;">
                            <span>Preparation Time</span><span>{{ $product->preparation_time }}</span>
                        </div>
                        <div class="d-flex justify-content-between" style="margin-bottom: 5px;">
                            <span>Serve</span><span>{{ $product->serve }}</span>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between total font-weight-bold mt-2" style="font-size: 20px;">
                        <span>Price</span><span>{{ $product->price }} SAR</span>
                    </div>
                    </a>


                    <div class="text-center mt-3">
                    <a href="{{ route('product.details', ['id' => $product->id]) }}">
                    </a>
                            <button 
                                class="btn btn-primary d-flex align-items-center justify-content-center" 
                                style="width: 48%; background-color: #ffaf3d; border-color: #ffaf3d; border-radius: 8px; font-size: 16px; font-weight: bold;" 
                                data-bs-toggle="modal" 
                                data-bs-target="#requestModal" 
                                data-product-name="{{ $product->product_name }}">
                                <i class="fas fa-cart-plus me-2"></i> <!-- الأيقونة -->
                                Request Now
                            </button>
                    </div>
                                    </div>
                                </div>
                        </div>
                    @endforeach
        </div>
    </div>
</section>


 <!-- قسم الصورة بعرض الصفحة -->
 <section style="margin: 50px 0;">
        <div class="container-fluid" style="padding: 0;">
            <img src="{{ asset('assets/banner.jpg') }}" alt="Full Width Image" style="width: 100%; height: auto;">
        </div>
    </section>
<!-- Modal Form -->
<div class="modal fade" id="requestModal" tabindex="-1" aria-labelledby="requestModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="requestModalLabel">Request Form</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('booking.store') }}" method="POST" style="display: inline-block; width: 100%; padding: 20px;">
                    @csrf
                    <input type="hidden" name="productName" value="{{ $product->product_name }}">
                    
                    <!-- Booking Date Field -->
                    <div class="mb-4">
                        <label for="bookingDate" class="form-label fw-bold">Booking Date</label>
                        <input type="date" class="form-control" id="bookingDate" name="booking_date" required>
                    </div>

                    <!-- Location Description -->
                    <div class="mb-4">
                        <label for="locationDescription" class="form-label fw-bold">Description of the Place</label>
                        <div class="d-flex justify-content-between">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="privateLocation" name="agency[]" value="Private">
                                <label class="form-check-label" for="privateLocation">Private</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="schoolRented" name="agency[]" value="School Rented">
                                <label class="form-check-label" for="schoolRented">School</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="rentLocation" name="agency[]" value="Rent">
                                <label class="form-check-label" for="rentLocation">Rented</label>
                            </div>
                        </div>
                    </div>

                    <!-- Product Selections -->
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label for="secondProduct" class="form-label fw-bold">Second Product</label>
                            <select class="form-control" id="second_product" name="second_product" required>
                                <option value="" disabled selected>Choose</option>
                                <option value="Waffle">Waffle</option>
                                <option value="Mini PanCake">Mini PanCake</option>
                                <option value="Japanese PanCake">Japanese PanCake</option>
                                <option value="Waffle Stick">Waffle Stick</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label for="rawMaterials1" class="form-label fw-bold">Additional Raw Materials</label>
                            <select class="form-control" id="rawMaterials1" name="additional" required>
                                <option value="" disabled selected>Choose</option>
                                <option value="No">No Additional</option>
                                <option value="50 Extra people (172.5 SAR)">50 Extra people (172.5 SAR)</option>
                                <option value="100 Extra people (345 SAR)">100 Extra people (345 SAR)</option>
                                <option value="200 Extra people (690 SAR)">200 Extra people (690 SAR)</option>
                                <option value="400 Extra people (1380 SAR)">400 Extra people (1380 SAR)</option>
                                <option value="800 Extra people (2760 SAR)">800 Extra people (2760 SAR)</option>
                            </select>
                        </div>
                    </div>

                    <!-- Favorite Sauces -->
                    <div class="mb-4">
                        <label for="rawMaterials" class="form-label fw-bold">Your Favorite Sauces</label>
                        <div id="rawMaterials" class="form-control" style="border: none; padding: 0;">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="fav_sauce[]" id="material1" value="Belgian Chocolate Free">
                                <label class="form-check-label" for="material1">Belgian Chocolate Free</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="fav_sauce[]" id="material2" value="Caramel Sauce Free">
                                <label class="form-check-label" for="material2">Caramel Sauce Free</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="fav_sauce[]" id="material3" value="Pistachio Sauce Free">
                                <label class="form-check-label" for="material3">Pistachio Sauce Free</label>
                            </div>
                        </div>
                    </div>

                    <!-- Total Price Display -->
                    <div class="text-end fw-bold mb-4">
                        Total Price: <span id="totalPriceText" name="total_price">{{ $product->price }}</span>
                    </div>

                    <!-- Submit Button -->
                    <div class="modal-footer">
                        <input type="hidden" id="totalPrice" name="total_price" value="{{ $product->price }}">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title" id="loginModalLabel">Login</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- Logo Section -->
        <div class="text-center mb-4">
          <img src="{{asset('assets/logowaffle.png')}}" alt="Logo" class="logo">
        </div>

        <form action="{{ url('login') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="email" class="form-label text-muted">Email</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                    <input type="email" class="form-control" id="email" name="email" required placeholder="Enter your email">
                </div>
            </div>
            <div class="mb-4">
                <label for="password" class="form-label text-muted">Password</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                    <input type="password" class="form-control" id="password" name="password" required placeholder="Enter your password">
                </div>
            </div>
            <div class="mb-4 d-flex justify-content-between">
                <div>
                    <input type="checkbox" id="rememberMe" name="remember">
                    <label for="rememberMe" class="form-check-label text-muted">Remember me</label>
                </div>
                <a href="#" class="text-primary" style="text-decoration: none;">Forgot password?</a>
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-primary w-100 py-2">Login</button>
            </div>
            <div class="mt-3 text-center">
                <span>Don't have an account? <a href="#" data-bs-toggle="modal" data-bs-target="#signupModal" class="text-primary">Sign up</a></span>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>

<script>

    function calculateTotalPrice() {
        const carType = document.getElementById('carType').value;
        const carQuantity = document.getElementById('carQuantity').value;

        if (carType && carQuantity) {
            const [price] = carType.split('|').map(value => parseInt(value));
            const totalPrice = price * carQuantity;
            document.getElementById('totalPrice').value = totalPrice;
            document.getElementById('totalPriceText').textContent = totalPrice + " SAR";
        } else {
            document.getElementById('totalPrice').value = 0;
            document.getElementById('totalPriceText').textContent = "0.0 SAR";
        }
    }


    function updateTotalPrice() {
        var totalPrice = 0;

        // إضافة السعر بناءً على الاختيارات، مثلاً
        var productPrice = 100; // مثال على سعر منتج
        totalPrice += productPrice;

        // تحديث الـ span والـ hidden input
        document.getElementById('totalPriceText').textContent = totalPrice + " SAR";
        document.getElementById('totalPrice').value = totalPrice;
    }

    // مثال: استدعاء الدالة عند تغيير شيء (مثل اختيار منتج).
    document.getElementById('secondProduct').addEventListener('change', function() {
        updateTotalPrice();
    });

    const modal = document.getElementById('requestModal');
    modal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget; // Button that triggered the modal
        var productName = button.getAttribute('data-product-name'); // Extract info from data-* attributes
        var modalBodyInput = modal.querySelector('input[name="productName"]');
        modalBodyInput.value = productName; // Update the input value inside the modal
    });
    
</script>


@endsection
