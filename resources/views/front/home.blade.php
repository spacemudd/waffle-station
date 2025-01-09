@extends('front.layouts.master')

<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
<!-- SweetAlert2 CSS -->
<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.6.5/dist/sweetalert2.min.css" rel="stylesheet">
<!-- SweetAlert2 JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.6.5/dist/sweetalert2.all.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>



@section('content')

@if(session('successMessage'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Account Has Been Created',
            text: 'Thanks for Registration',
            showConfirmButton: false,
            timer: 3000
        });
    </script>
@endif


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
        <!-- الرأزرار -->
        <div id="ssb-container">
            <ul class="ssb-dark-hover">
                <li id="ssb-btn-1">
                    <a href="https://www.facebook.com/profile.php?id=61553741309441" target="_blank">
                    <span class="fab fa-facebook-f"></span>
                    </a>
                </li>
                <li id="ssb-btn-0">
                    <a href="https://www.instagram.com/stationwaffel/" target="_blank">
                    <span class="fab fa-instagram"></span>
                    </a>
                </li>
                <li id="ssb-btn-0">
                    <a href="https://www.tiktok.com/@stationwaffel?lang=en" target="_blank">
                    <span class="fab fa-tiktok"></span>
                    </a>
                </li>
                <li id="ssb-btn-0">
                    <a href="https://x.com/stationwaffel" target="_blank">
                    <span class="fab fa-twitter"></span>
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
                    <input type="text" name="productName" value="{{ $product->product_name }}">
                    
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
                        <button type="submit" class="btn btn-primary" style="background-color: #ffaf3d;">Submit</button>
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


<div style="text-align: center; margin-bottom: 20px;">
  <h1 style="font-size: 24px; font-weight: bold; color: #333;">Instagram Posts</h1>
</div>

<div style="display: flex; justify-content: center; gap: 20px; flex-wrap: wrap; max-width: 100%;">
  <!-- المنشور الأول -->
<blockquote class="instagram-media" data-instgrm-permalink="https://www.instagram.com/p/DEQb6_vqZwK/?utm_source=ig_embed&amp;utm_campaign=loading" data-instgrm-version="14" style=" background:#FFF; border:0; border-radius:3px; box-shadow:0 0 1px 0 rgba(0,0,0,0.5),0 1px 10px 0 rgba(0,0,0,0.15); margin: 1px; max-width:417px; min-width:326px; padding:0; width:99.375%; width:-webkit-calc(100% - 2px); width:calc(100% - 2px);"><div style="padding:16px;"> <a href="https://www.instagram.com/p/DEQb6_vqZwK/?utm_source=ig_embed&amp;utm_campaign=loading" style=" background:#FFFFFF; line-height:0; padding:0 0; text-align:center; text-decoration:none; width:100%;" target="_blank"> <div style=" display: flex; flex-direction: row; align-items: center;"> <div style="background-color: #F4F4F4; border-radius: 50%; flex-grow: 0; height: 40px; margin-right: 14px; width: 40px;"></div> <div style="display: flex; flex-direction: column; flex-grow: 1; justify-content: center;"> <div style=" background-color: #F4F4F4; border-radius: 4px; flex-grow: 0; height: 14px; margin-bottom: 6px; width: 100px;"></div> <div style=" background-color: #F4F4F4; border-radius: 4px; flex-grow: 0; height: 14px; width: 60px;"></div></div></div><div style="padding: 19% 0;"></div> <div style="display:block; height:50px; margin:0 auto 12px; width:50px;"><svg width="50px" height="50px" viewBox="0 0 60 60" version="1.1" xmlns="https://www.w3.org/2000/svg" xmlns:xlink="https://www.w3.org/1999/xlink"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><g transform="translate(-511.000000, -20.000000)" fill="#000000"><g><path d="M556.869,30.41 C554.814,30.41 553.148,32.076 553.148,34.131 C553.148,36.186 554.814,37.852 556.869,37.852 C558.924,37.852 560.59,36.186 560.59,34.131 C560.59,32.076 558.924,30.41 556.869,30.41 M541,60.657 C535.114,60.657 530.342,55.887 530.342,50 C530.342,44.114 535.114,39.342 541,39.342 C546.887,39.342 551.658,44.114 551.658,50 C551.658,55.887 546.887,60.657 541,60.657 M541,33.886 C532.1,33.886 524.886,41.1 524.886,50 C524.886,58.899 532.1,66.113 541,66.113 C549.9,66.113 557.115,58.899 557.115,50 C557.115,41.1 549.9,33.886 541,33.886 M565.378,62.101 C565.244,65.022 564.756,66.606 564.346,67.663 C563.803,69.06 563.154,70.057 562.106,71.106 C561.058,72.155 560.06,72.803 558.662,73.347 C557.607,73.757 556.021,74.244 553.102,74.378 C549.944,74.521 548.997,74.552 541,74.552 C533.003,74.552 532.056,74.521 528.898,74.378 C525.979,74.244 524.393,73.757 523.338,73.347 C521.94,72.803 520.942,72.155 519.894,71.106 C518.846,70.057 518.197,69.06 517.654,67.663 C517.244,66.606 516.755,65.022 516.623,62.101 C516.479,58.943 516.448,57.996 516.448,50 C516.448,42.003 516.479,41.056 516.623,37.899 C516.755,34.978 517.244,33.391 517.654,32.338 C518.197,30.938 518.846,29.942 519.894,28.894 C520.942,27.846 521.94,27.196 523.338,26.654 C524.393,26.244 525.979,25.756 528.898,25.623 C532.057,25.479 533.004,25.448 541,25.448 C548.997,25.448 549.943,25.479 553.102,25.623 C556.021,25.756 557.607,26.244 558.662,26.654 C560.06,27.196 561.058,27.846 562.106,28.894 C563.154,29.942 563.803,30.938 564.346,32.338 C564.756,33.391 565.244,34.978 565.378,37.899 C565.522,41.056 565.552,42.003 565.552,50 C565.552,57.996 565.522,58.943 565.378,62.101 M570.82,37.631 C570.674,34.438 570.167,32.258 569.425,30.349 C568.659,28.377 567.633,26.702 565.965,25.035 C564.297,23.368 562.623,22.342 560.652,21.575 C558.743,20.834 556.562,20.326 553.369,20.18 C550.169,20.033 549.148,20 541,20 C532.853,20 531.831,20.033 528.631,20.18 C525.438,20.326 523.257,20.834 521.349,21.575 C519.376,22.342 517.703,23.368 516.035,25.035 C514.368,26.702 513.342,28.377 512.574,30.349 C511.834,32.258 511.326,34.438 511.181,37.631 C511.035,40.831 511,41.851 511,50 C511,58.147 511.035,59.17 511.181,62.369 C511.326,65.562 511.834,67.743 512.574,69.651 C513.342,71.625 514.368,73.296 516.035,74.965 C517.703,76.634 519.376,77.658 521.349,78.425 C523.257,79.167 525.438,79.673 528.631,79.82 C531.831,79.965 532.853,80.001 541,80.001 C549.148,80.001 550.169,79.965 553.369,79.82 C556.562,79.673 558.743,79.167 560.652,78.425 C562.623,77.658 564.297,76.634 565.965,74.965 C567.633,73.296 568.659,71.625 569.425,69.651 C570.167,67.743 570.674,65.562 570.82,62.369 C570.966,59.17 571,58.147 571,50 C571,41.851 570.966,40.831 570.82,37.631"></path></g></g></g></svg></div><div style="padding-top: 8px;"> <div style=" color:#3897f0; font-family:Arial,sans-serif; font-size:14px; font-style:normal; font-weight:550; line-height:18px;">View this post on Instagram</div></div><div style="padding: 12.5% 0;"></div> <div style="display: flex; flex-direction: row; margin-bottom: 14px; align-items: center;"><div> <div style="background-color: #F4F4F4; border-radius: 50%; height: 12.5px; width: 12.5px; transform: translateX(0px) translateY(7px);"></div> <div style="background-color: #F4F4F4; height: 12.5px; transform: rotate(-45deg) translateX(3px) translateY(1px); width: 12.5px; flex-grow: 0; margin-right: 14px; margin-left: 2px;"></div> <div style="background-color: #F4F4F4; border-radius: 50%; height: 12.5px; width: 12.5px; transform: translateX(9px) translateY(-18px);"></div></div><div style="margin-left: 8px;"> <div style=" background-color: #F4F4F4; border-radius: 50%; flex-grow: 0; height: 20px; width: 20px;"></div> <div style=" width: 0; height: 0; border-top: 2px solid transparent; border-left: 6px solid #f4f4f4; border-bottom: 2px solid transparent; transform: translateX(16px) translateY(-4px) rotate(30deg)"></div></div><div style="margin-left: auto;"> <div style=" width: 0px; border-top: 8px solid #F4F4F4; border-right: 8px solid transparent; transform: translateY(16px);"></div> <div style=" background-color: #F4F4F4; flex-grow: 0; height: 12px; width: 16px; transform: translateY(-4px);"></div> <div style=" width: 0; height: 0; border-top: 8px solid #F4F4F4; border-left: 8px solid transparent; transform: translateY(-4px) translateX(8px);"></div></div></div> <div style="display: flex; flex-direction: column; flex-grow: 1; justify-content: center; margin-bottom: 24px;"> <div style=" background-color: #F4F4F4; border-radius: 4px; flex-grow: 0; height: 14px; margin-bottom: 6px; width: 224px;"></div> <div style=" background-color: #F4F4F4; border-radius: 4px; flex-grow: 0; height: 14px; width: 144px;"></div></div></a><p style=" color:#c9c8cd; font-family:Arial,sans-serif; font-size:14px; line-height:17px; margin-bottom:0; margin-top:8px; overflow:hidden; padding:8px 0 7px; text-align:center; text-overflow:ellipsis; white-space:nowrap;"><a href="https://www.instagram.com/p/DEQb6_vqZwK/?utm_source=ig_embed&amp;utm_campaign=loading" style=" color:#c9c8cd; font-family:Arial,sans-serif; font-size:14px; font-style:normal; font-weight:normal; line-height:17px; text-decoration:none;" target="_blank">A post shared by Waffel Station (@stationwaffel)</a></p></div></blockquote>
<script async src="//www.instagram.com/embed.js"></script>
  <!-- المنشور الثاني -->
<blockquote class="instagram-media" data-instgrm-permalink="https://www.instagram.com/p/DEQbzwxi-u2/?utm_source=ig_embed&amp;utm_campaign=loading" data-instgrm-version="14" style=" background:#FFF; border:0; border-radius:3px; box-shadow:0 0 1px 0 rgba(0,0,0,0.5),0 1px 10px 0 rgba(0,0,0,0.15); margin: 1px; max-width:417px; min-width:326px; padding:0; width:99.375%; width:-webkit-calc(100% - 2px); width:calc(100% - 2px);"><div style="padding:16px;"> <a href="https://www.instagram.com/p/DEQbzwxi-u2/?utm_source=ig_embed&amp;utm_campaign=loading" style=" background:#FFFFFF; line-height:0; padding:0 0; text-align:center; text-decoration:none; width:100%;" target="_blank"> <div style=" display: flex; flex-direction: row; align-items: center;"> <div style="background-color: #F4F4F4; border-radius: 50%; flex-grow: 0; height: 40px; margin-right: 14px; width: 40px;"></div> <div style="display: flex; flex-direction: column; flex-grow: 1; justify-content: center;"> <div style=" background-color: #F4F4F4; border-radius: 4px; flex-grow: 0; height: 14px; margin-bottom: 6px; width: 100px;"></div> <div style=" background-color: #F4F4F4; border-radius: 4px; flex-grow: 0; height: 14px; width: 60px;"></div></div></div><div style="padding: 19% 0;"></div> <div style="display:block; height:50px; margin:0 auto 12px; width:50px;"><svg width="50px" height="50px" viewBox="0 0 60 60" version="1.1" xmlns="https://www.w3.org/2000/svg" xmlns:xlink="https://www.w3.org/1999/xlink"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><g transform="translate(-511.000000, -20.000000)" fill="#000000"><g><path d="M556.869,30.41 C554.814,30.41 553.148,32.076 553.148,34.131 C553.148,36.186 554.814,37.852 556.869,37.852 C558.924,37.852 560.59,36.186 560.59,34.131 C560.59,32.076 558.924,30.41 556.869,30.41 M541,60.657 C535.114,60.657 530.342,55.887 530.342,50 C530.342,44.114 535.114,39.342 541,39.342 C546.887,39.342 551.658,44.114 551.658,50 C551.658,55.887 546.887,60.657 541,60.657 M541,33.886 C532.1,33.886 524.886,41.1 524.886,50 C524.886,58.899 532.1,66.113 541,66.113 C549.9,66.113 557.115,58.899 557.115,50 C557.115,41.1 549.9,33.886 541,33.886 M565.378,62.101 C565.244,65.022 564.756,66.606 564.346,67.663 C563.803,69.06 563.154,70.057 562.106,71.106 C561.058,72.155 560.06,72.803 558.662,73.347 C557.607,73.757 556.021,74.244 553.102,74.378 C549.944,74.521 548.997,74.552 541,74.552 C533.003,74.552 532.056,74.521 528.898,74.378 C525.979,74.244 524.393,73.757 523.338,73.347 C521.94,72.803 520.942,72.155 519.894,71.106 C518.846,70.057 518.197,69.06 517.654,67.663 C517.244,66.606 516.755,65.022 516.623,62.101 C516.479,58.943 516.448,57.996 516.448,50 C516.448,42.003 516.479,41.056 516.623,37.899 C516.755,34.978 517.244,33.391 517.654,32.338 C518.197,30.938 518.846,29.942 519.894,28.894 C520.942,27.846 521.94,27.196 523.338,26.654 C524.393,26.244 525.979,25.756 528.898,25.623 C532.057,25.479 533.004,25.448 541,25.448 C548.997,25.448 549.943,25.479 553.102,25.623 C556.021,25.756 557.607,26.244 558.662,26.654 C560.06,27.196 561.058,27.846 562.106,28.894 C563.154,29.942 563.803,30.938 564.346,32.338 C564.756,33.391 565.244,34.978 565.378,37.899 C565.522,41.056 565.552,42.003 565.552,50 C565.552,57.996 565.522,58.943 565.378,62.101 M570.82,37.631 C570.674,34.438 570.167,32.258 569.425,30.349 C568.659,28.377 567.633,26.702 565.965,25.035 C564.297,23.368 562.623,22.342 560.652,21.575 C558.743,20.834 556.562,20.326 553.369,20.18 C550.169,20.033 549.148,20 541,20 C532.853,20 531.831,20.033 528.631,20.18 C525.438,20.326 523.257,20.834 521.349,21.575 C519.376,22.342 517.703,23.368 516.035,25.035 C514.368,26.702 513.342,28.377 512.574,30.349 C511.834,32.258 511.326,34.438 511.181,37.631 C511.035,40.831 511,41.851 511,50 C511,58.147 511.035,59.17 511.181,62.369 C511.326,65.562 511.834,67.743 512.574,69.651 C513.342,71.625 514.368,73.296 516.035,74.965 C517.703,76.634 519.376,77.658 521.349,78.425 C523.257,79.167 525.438,79.673 528.631,79.82 C531.831,79.965 532.853,80.001 541,80.001 C549.148,80.001 550.169,79.965 553.369,79.82 C556.562,79.673 558.743,79.167 560.652,78.425 C562.623,77.658 564.297,76.634 565.965,74.965 C567.633,73.296 568.659,71.625 569.425,69.651 C570.167,67.743 570.674,65.562 570.82,62.369 C570.966,59.17 571,58.147 571,50 C571,41.851 570.966,40.831 570.82,37.631"></path></g></g></g></svg></div><div style="padding-top: 8px;"> <div style=" color:#3897f0; font-family:Arial,sans-serif; font-size:14px; font-style:normal; font-weight:550; line-height:18px;">View this post on Instagram</div></div><div style="padding: 12.5% 0;"></div> <div style="display: flex; flex-direction: row; margin-bottom: 14px; align-items: center;"><div> <div style="background-color: #F4F4F4; border-radius: 50%; height: 12.5px; width: 12.5px; transform: translateX(0px) translateY(7px);"></div> <div style="background-color: #F4F4F4; height: 12.5px; transform: rotate(-45deg) translateX(3px) translateY(1px); width: 12.5px; flex-grow: 0; margin-right: 14px; margin-left: 2px;"></div> <div style="background-color: #F4F4F4; border-radius: 50%; height: 12.5px; width: 12.5px; transform: translateX(9px) translateY(-18px);"></div></div><div style="margin-left: 8px;"> <div style=" background-color: #F4F4F4; border-radius: 50%; flex-grow: 0; height: 20px; width: 20px;"></div> <div style=" width: 0; height: 0; border-top: 2px solid transparent; border-left: 6px solid #f4f4f4; border-bottom: 2px solid transparent; transform: translateX(16px) translateY(-4px) rotate(30deg)"></div></div><div style="margin-left: auto;"> <div style=" width: 0px; border-top: 8px solid #F4F4F4; border-right: 8px solid transparent; transform: translateY(16px);"></div> <div style=" background-color: #F4F4F4; flex-grow: 0; height: 12px; width: 16px; transform: translateY(-4px);"></div> <div style=" width: 0; height: 0; border-top: 8px solid #F4F4F4; border-left: 8px solid transparent; transform: translateY(-4px) translateX(8px);"></div></div></div> <div style="display: flex; flex-direction: column; flex-grow: 1; justify-content: center; margin-bottom: 24px;"> <div style=" background-color: #F4F4F4; border-radius: 4px; flex-grow: 0; height: 14px; margin-bottom: 6px; width: 224px;"></div> <div style=" background-color: #F4F4F4; border-radius: 4px; flex-grow: 0; height: 14px; width: 144px;"></div></div></a><p style=" color:#c9c8cd; font-family:Arial,sans-serif; font-size:14px; line-height:17px; margin-bottom:0; margin-top:8px; overflow:hidden; padding:8px 0 7px; text-align:center; text-overflow:ellipsis; white-space:nowrap;"><a href="https://www.instagram.com/p/DEQbzwxi-u2/?utm_source=ig_embed&amp;utm_campaign=loading" style=" color:#c9c8cd; font-family:Arial,sans-serif; font-size:14px; font-style:normal; font-weight:normal; line-height:17px; text-decoration:none;" target="_blank">A post shared by Waffel Station (@stationwaffel)</a></p></div></blockquote>
<script async src="//www.instagram.com/embed.js"></script>
  <!-- المنشور الثالث -->
<blockquote class="instagram-media" data-instgrm-permalink="https://www.instagram.com/p/DEQbsVkip-s/?utm_source=ig_embed&amp;utm_campaign=loading" data-instgrm-version="14" style=" background:#FFF; border:0; border-radius:3px; box-shadow:0 0 1px 0 rgba(0,0,0,0.5),0 1px 10px 0 rgba(0,0,0,0.15); margin: 1px; max-width:417px; min-width:326px; padding:0; width:99.375%; width:-webkit-calc(100% - 2px); width:calc(100% - 2px);"><div style="padding:16px;"> <a href="https://www.instagram.com/p/DEQbsVkip-s/?utm_source=ig_embed&amp;utm_campaign=loading" style=" background:#FFFFFF; line-height:0; padding:0 0; text-align:center; text-decoration:none; width:100%;" target="_blank"> <div style=" display: flex; flex-direction: row; align-items: center;"> <div style="background-color: #F4F4F4; border-radius: 50%; flex-grow: 0; height: 40px; margin-right: 14px; width: 40px;"></div> <div style="display: flex; flex-direction: column; flex-grow: 1; justify-content: center;"> <div style=" background-color: #F4F4F4; border-radius: 4px; flex-grow: 0; height: 14px; margin-bottom: 6px; width: 100px;"></div> <div style=" background-color: #F4F4F4; border-radius: 4px; flex-grow: 0; height: 14px; width: 60px;"></div></div></div><div style="padding: 19% 0;"></div> <div style="display:block; height:50px; margin:0 auto 12px; width:50px;"><svg width="50px" height="50px" viewBox="0 0 60 60" version="1.1" xmlns="https://www.w3.org/2000/svg" xmlns:xlink="https://www.w3.org/1999/xlink"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><g transform="translate(-511.000000, -20.000000)" fill="#000000"><g><path d="M556.869,30.41 C554.814,30.41 553.148,32.076 553.148,34.131 C553.148,36.186 554.814,37.852 556.869,37.852 C558.924,37.852 560.59,36.186 560.59,34.131 C560.59,32.076 558.924,30.41 556.869,30.41 M541,60.657 C535.114,60.657 530.342,55.887 530.342,50 C530.342,44.114 535.114,39.342 541,39.342 C546.887,39.342 551.658,44.114 551.658,50 C551.658,55.887 546.887,60.657 541,60.657 M541,33.886 C532.1,33.886 524.886,41.1 524.886,50 C524.886,58.899 532.1,66.113 541,66.113 C549.9,66.113 557.115,58.899 557.115,50 C557.115,41.1 549.9,33.886 541,33.886 M565.378,62.101 C565.244,65.022 564.756,66.606 564.346,67.663 C563.803,69.06 563.154,70.057 562.106,71.106 C561.058,72.155 560.06,72.803 558.662,73.347 C557.607,73.757 556.021,74.244 553.102,74.378 C549.944,74.521 548.997,74.552 541,74.552 C533.003,74.552 532.056,74.521 528.898,74.378 C525.979,74.244 524.393,73.757 523.338,73.347 C521.94,72.803 520.942,72.155 519.894,71.106 C518.846,70.057 518.197,69.06 517.654,67.663 C517.244,66.606 516.755,65.022 516.623,62.101 C516.479,58.943 516.448,57.996 516.448,50 C516.448,42.003 516.479,41.056 516.623,37.899 C516.755,34.978 517.244,33.391 517.654,32.338 C518.197,30.938 518.846,29.942 519.894,28.894 C520.942,27.846 521.94,27.196 523.338,26.654 C524.393,26.244 525.979,25.756 528.898,25.623 C532.057,25.479 533.004,25.448 541,25.448 C548.997,25.448 549.943,25.479 553.102,25.623 C556.021,25.756 557.607,26.244 558.662,26.654 C560.06,27.196 561.058,27.846 562.106,28.894 C563.154,29.942 563.803,30.938 564.346,32.338 C564.756,33.391 565.244,34.978 565.378,37.899 C565.522,41.056 565.552,42.003 565.552,50 C565.552,57.996 565.522,58.943 565.378,62.101 M570.82,37.631 C570.674,34.438 570.167,32.258 569.425,30.349 C568.659,28.377 567.633,26.702 565.965,25.035 C564.297,23.368 562.623,22.342 560.652,21.575 C558.743,20.834 556.562,20.326 553.369,20.18 C550.169,20.033 549.148,20 541,20 C532.853,20 531.831,20.033 528.631,20.18 C525.438,20.326 523.257,20.834 521.349,21.575 C519.376,22.342 517.703,23.368 516.035,25.035 C514.368,26.702 513.342,28.377 512.574,30.349 C511.834,32.258 511.326,34.438 511.181,37.631 C511.035,40.831 511,41.851 511,50 C511,58.147 511.035,59.17 511.181,62.369 C511.326,65.562 511.834,67.743 512.574,69.651 C513.342,71.625 514.368,73.296 516.035,74.965 C517.703,76.634 519.376,77.658 521.349,78.425 C523.257,79.167 525.438,79.673 528.631,79.82 C531.831,79.965 532.853,80.001 541,80.001 C549.148,80.001 550.169,79.965 553.369,79.82 C556.562,79.673 558.743,79.167 560.652,78.425 C562.623,77.658 564.297,76.634 565.965,74.965 C567.633,73.296 568.659,71.625 569.425,69.651 C570.167,67.743 570.674,65.562 570.82,62.369 C570.966,59.17 571,58.147 571,50 C571,41.851 570.966,40.831 570.82,37.631"></path></g></g></g></svg></div><div style="padding-top: 8px;"> <div style=" color:#3897f0; font-family:Arial,sans-serif; font-size:14px; font-style:normal; font-weight:550; line-height:18px;">View this post on Instagram</div></div><div style="padding: 12.5% 0;"></div> <div style="display: flex; flex-direction: row; margin-bottom: 14px; align-items: center;"><div> <div style="background-color: #F4F4F4; border-radius: 50%; height: 12.5px; width: 12.5px; transform: translateX(0px) translateY(7px);"></div> <div style="background-color: #F4F4F4; height: 12.5px; transform: rotate(-45deg) translateX(3px) translateY(1px); width: 12.5px; flex-grow: 0; margin-right: 14px; margin-left: 2px;"></div> <div style="background-color: #F4F4F4; border-radius: 50%; height: 12.5px; width: 12.5px; transform: translateX(9px) translateY(-18px);"></div></div><div style="margin-left: 8px;"> <div style=" background-color: #F4F4F4; border-radius: 50%; flex-grow: 0; height: 20px; width: 20px;"></div> <div style=" width: 0; height: 0; border-top: 2px solid transparent; border-left: 6px solid #f4f4f4; border-bottom: 2px solid transparent; transform: translateX(16px) translateY(-4px) rotate(30deg)"></div></div><div style="margin-left: auto;"> <div style=" width: 0px; border-top: 8px solid #F4F4F4; border-right: 8px solid transparent; transform: translateY(16px);"></div> <div style=" background-color: #F4F4F4; flex-grow: 0; height: 12px; width: 16px; transform: translateY(-4px);"></div> <div style=" width: 0; height: 0; border-top: 8px solid #F4F4F4; border-left: 8px solid transparent; transform: translateY(-4px) translateX(8px);"></div></div></div> <div style="display: flex; flex-direction: column; flex-grow: 1; justify-content: center; margin-bottom: 24px;"> <div style=" background-color: #F4F4F4; border-radius: 4px; flex-grow: 0; height: 14px; margin-bottom: 6px; width: 224px;"></div> <div style=" background-color: #F4F4F4; border-radius: 4px; flex-grow: 0; height: 14px; width: 144px;"></div></div></a><p style=" color:#c9c8cd; font-family:Arial,sans-serif; font-size:14px; line-height:17px; margin-bottom:0; margin-top:8px; overflow:hidden; padding:8px 0 7px; text-align:center; text-overflow:ellipsis; white-space:nowrap;"><a href="https://www.instagram.com/p/DEQbsVkip-s/?utm_source=ig_embed&amp;utm_campaign=loading" style=" color:#c9c8cd; font-family:Arial,sans-serif; font-size:14px; font-style:normal; font-weight:normal; line-height:17px; text-decoration:none;" target="_blank">A post shared by Waffel Station (@stationwaffel)</a></p></div></blockquote>
<script async src="//www.instagram.com/embed.js"></script>
</div>

<script async src="https://www.instagram.com/embed.js"></script>

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
        var button = event.relatedTarget; // الزر الذي فتح الـ modal
        var productName = button.getAttribute('data-product-name'); // جلب اسم المنتج
        console.log('Product Name:', productName); // التحقق من القيم
        var modalBodyInput = modal.querySelector('input[name="productName"]');
        modalBodyInput.value = productName; // تعيين القيمة داخل الإدخال
    });




    
</script>


@endsection
