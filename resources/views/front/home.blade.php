@extends('front.layouts.master')

@section('content')

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


                        <!-- <form action="#" method="POST" style="display: inline-block; width: 48%;"> -->
                            <!-- @csrf -->
                            <!-- <input type="hidden" name="quantity" id="hiddenQuantity" value="1"> -->
                            <button class="btn btn-primary" style="width: 48%; background-color:#fd7e14; border-color:#fd7e14;" 
                            data-bs-toggle="modal" data-bs-target="#requestModal" data-product-name="{{ $product->product_name }}">
                            Request Now
                        </button>
                            <!-- <button type="submit" class="btn btn-success" style="width: 100%; background-color: #28a745; border-color: #28a745;">Add to Cart</button> -->
                        <!-- </form> -->
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

            <form action="{{ route('booking.store') }}" method="POST" style="display: inline-block; width: 48%;">
            @csrf
            <input type="text" name="productName" value="{{ $product->product_name }}">
                <!-- Booking Date Field -->
                <div class="mb-4">
                    <label for="bookingDate" class="form-label fw-bold">Booking Date</label>
                    <input type="date" class="form-control" id="bookingDate" name="booking_date" required>
                </div>

                <!-- Location Description -->
                <div class="mb-4">
                    <label for="locationDescription" class="form-label fw-bold">Description of the Place</label>
                    <div class="d-flex justify-content-around">
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
                <div class="row">


                    <div class="col-md-6 mb-4">
                        <label for="secondProduct" class="form-label fw-bold">Second Product</label>
                        <select class="form-control" id="second_product" name="second_product" required>
                            <option value="" disabled selected>Choose</option>
                            <option value="Waffle">Waffle</option>
                            <option value="Mini PanCake">Mini PanCake</option>
                            <option value="Japanese PanCake">Japanese PanCake</option>
                            <option value="Waffle Stick">Waffle Stick</option>
                        </select>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-md-6">
                        <label for="rawMaterials1" class="form-label fw-bold">Additional Raw Materials</label>
                        <select class="form-control" id="rawMaterials1" name=" additional" required>
                            <option value="" disabled selected>Choose</option>
                            <option value="No">No Additional</option>
                            <option value="50 Extra people (172.5 SAR)">50 Extra people (172.5 SAR)</option>
                            <option value="100 Extra people (345 SAR)">100 Extra people (345 SAR)</option>
                            <option value="200 Extra people (690 SAR)">200 Extra people (690 SAR)</option>
                            <option value="400 Extra people (1380 SAR)">400 Extra people (1380 SAR)</option>
                            <option value="800 Extra people (2760 SAR)">800 Extra people (2760 SAR)</option>
                        </select>
                    </div>

                    <!-- <div class="col-md-6">
                        <label for="rawMaterials2" class="form-label fw-bold">Do you want a maid with the cart?</label>
                        <select class="form-control" id="rawMaterials2" name="rawMaterials" required>
                            <option value="" disabled selected>Choose</option>
                            <option value="Material1">No</option>
                            <option value="Material2">4 Hours (250 SAR)</option>
                            <option value="Material3">5 Hours (300 SAR)</option>
                            <option value="Material4">6 Hours (350 SAR)</option>
                            <option value="Material5">12 Hours (550 SAR)</option>
                        </select>
                    </div> -->
                </div>

                <div class="mb-4">Fav
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


                <div class="text-end fw-bold mb-4">
                    Total Price: <span id="totalPriceText" name="total_price">{{ $product->price }}</span>
                </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" id="totalPrice" name="total_price" value="{{ $product->price }}">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Submit</button>
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
</script>


<script>
    const modal = document.getElementById('requestModal');
    modal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget; // Button that triggered the modal
        var productName = button.getAttribute('data-product-name'); // Extract info from data-* attributes
        var modalBodyInput = modal.querySelector('input[name="productName"]');
        modalBodyInput.value = productName; // Update the input value inside the modal
    });
</script>
@endsection
