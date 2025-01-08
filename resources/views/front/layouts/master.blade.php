    <!DOCTYPE html>
    <html lang="en">
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Waffles Station</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('front/style.css') }}">
    <link rel="icon" href="{{ asset('assets/Fav_icon.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:ital,wght@0,300;0,400;0,700;0,900;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">
    
    <!-- SweetAlert CDN -->

    </head>



    <body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark navbar-transparent fixed-top">
    <div class="container">
        <a class="navbar-brand" href="#">
            <img src="{{ asset('assets/logowaffle.png') }}" alt="Logo" style="height: auto; width:120px;">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('about') }}">About</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Contact Us</a></li>

                <!-- Conditional Login or Profile Link -->
                @auth
                <li class="nav-item dropdown">
                    <a 
                        class="nav-link dropdown-toggle d-flex align-items-center" 
                        href="#" 
                        id="profileDropdown" 
                        role="button" 
                        data-bs-toggle="dropdown" 
                        aria-expanded="false">
                        <i class="fas fa-user me-2"></i> Profile
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end shadow-lg rounded-3" aria-labelledby="profileDropdown">
                        <!-- My Profile -->
                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="{{route('profile')}}">
                                <i class="fas fa-user-circle me-2 text-primary"></i> My Profile
                            </a>
                        </li>
                        <!-- Orders -->
                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="#">
                                <i class="fas fa-shopping-bag me-2 text-success"></i> Orders
                            </a>
                        </li>
                        <!-- Logout -->
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="dropdown-item d-flex align-items-center" style="background-color: transparent;">
                                    <i class="fas fa-sign-out-alt me-2 text-danger"></i> Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                </li>
                @else
                <li class="nav-item">
                    <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#loginModal">Login</a>
                </li>
                @endauth

                <!-- Basket Icon with countt -->
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('cart') }}">
                        <i class="fas fa-shopping-cart"></i>
                        <span class="badge bg-warning text-dark" id="cart-count">{{ Cart::getTotalQuantity() }}</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>


<!-- <x-login-modal /> -->


<!-- Modal Login -->
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


<!-- Modal Sign Up -->
<div class="modal fade" id="signupModal" tabindex="-1" aria-labelledby="signupModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header" style="border-color: transparent;">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- Logo Section -->
        <div class="text-center mb-4">
          <img src="{{asset('assets/logowaffle.png')}}" alt="Logo" class="logo">
        </div>

        <form action="{{ url('register') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="fullName" class="form-label text-muted">Full Name</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                    <input type="text" class="form-control" id="fullName" name="full_name" required placeholder="Enter your full name">
                </div>
            </div>
            <div class="mb-4">
                <label for="email" class="form-label text-muted">Email</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                    <input type="email" class="form-control" id="email" name="email" required placeholder="Enter your email address">
                </div>
            </div>
            <div class="mb-4">
                <label for="phoneNumber" class="form-label text-muted">Phone Number</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                    <input type="text" class="form-control" id="phone_number" name="phone_number" required placeholder="Phone Number">
                </div>
            </div>

            <div class="mb-4">
                <label for="address" class="form-label text-muted">Address</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                    <input type="text" class="form-control" id="address" name="address" required placeholder="Address">
                </div>
            </div>
            <div class="mb-4">
                <label for="password" class="form-label text-muted">Password</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                    <input type="password" class="form-control" id="password" name="password" required placeholder="Choose a password">
                </div>
            </div>
            <div class="mb-4">
                <label for="password_confirmation" class="form-label text-muted">Confirm Password</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required placeholder="Confirm your password">
                </div>
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-success w-100 py-2" style="background-color: #ffaf3d;">Sign Up</button>
            </div>
            <div class="mt-3 text-center">
                <span>Already have an account? <a href="#" data-bs-toggle="modal" data-bs-target="#loginModal" class="text-primary">Login</a></span>
            </div>
        </form>

      </div>
    </div>
  </div>
</div>




    <!-- Main Content -->
    @yield('content')

    <!-- Footer -->
    <footer class="text-center text-lg-start text-white" style="background-color: #1c2331; position: relative; width: 100%; margin-top: auto;">

    <!-- Section: Social media -->
    <section class="d-flex justify-content-between p-4" style="background-color: #6351ce;">
        <!-- Left -->
        <div class="me-5">
            <span>Get connected with us on social networks:</span>
        </div>
        <!-- Right -->
        <div>
            <a href="" class="text-white me-4">
                <i class="fab fa-facebook-f"></i>
            </a>
            <a href="" class="text-white me-4">
                <i class="fab fa-twitter"></i>
            </a>
            <a href="" class="text-white me-4">
                <i class="fab fa-google"></i>
            </a>
            <a href="" class="text-white me-4">
                <i class="fab fa-instagram"></i>
            </a>
            <a href="" class="text-white me-4">
                <i class="fab fa-linkedin"></i>
            </a>
            <a href="" class="text-white me-4">
                <i class="fab fa-github"></i>
            </a>
        </div>
    </section>
    <!-- Section: Social media -->

    <!-- Section: Links -->
    <section>
        <div class="container text-center text-md-start mt-5">
            <div class="row mt-3">
                <!-- Grid column -->
                <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
                <img src="{{ asset('assets/logowaffle.png') }}" alt="Company Logo" style="max-width: 100%; height: auto;" />
                    <hr class="mb-4 mt-0 d-inline-block mx-auto" style="width: 60px; background-color: #7c4dff; height: 2px" />
                    <p>Here you can use rows and columns to organize your footer content. Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                </div>

                <!-- Grid column -->
                <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
                    <h6 class="text-uppercase fw-bold">Products</h6>
                    <hr class="mb-4 mt-0 d-inline-block mx-auto" style="width: 60px; background-color: #7c4dff; height: 2px" />
                    <p><a href="#!" class="text-white">Signature Package</a></p>
                    <p><a href="#!" class="text-white">Cookie and Waffle Package</a></p>
                    <p><a href="#!" class="text-white">Waffle Stick</a></p>
                    <p><a href="#!" class="text-white">Classic Package</a></p>
                </div>

                <!-- Grid column -->
                <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
                    <h6 class="text-uppercase fw-bold">Useful links</h6>
                    <hr class="mb-4 mt-0 d-inline-block mx-auto" style="width: 60px; background-color: #7c4dff; height: 2px" />
                    <p><a href="#!" class="text-white">Home</a></p>
                    <p><a href="{{route('about')}}" class="text-white">About</a></p>
                    <p><a href="#!" class="text-white">Contact Us</a></p>
                </div>

                <!-- Grid column -->
                <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
                    <h6 class="text-uppercase fw-bold">Contact</h6>
                    <hr class="mb-4 mt-0 d-inline-block mx-auto" style="width: 60px; background-color: #7c4dff; height: 2px" />
                    <p><i class="fas fa-home mr-3"></i> New York, NY 10012, US</p>
                    <p><i class="fas fa-envelope mr-3"></i> info@wstation-sa.com</p>
                    <p><i class="fas fa-phone mr-3"></i>  + 966 55 645 6091</p>
                    <p><i class="fas fa-phone mr-3"></i>  + 966 56 581 9252</p>
                </div>




            </div>
        </div>
    </section>
    <!-- Section: Links -->

    <!-- Copyright -->
    <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
        © 2020 Copyright: <a class="text-white" href="{{ route('home') }}">Waffle Station</a>
    </div>
    <!-- Copyright -->
    </footer>


    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    @if(session('success'))
    <div id="success-message" data-message="{{ session('success') }}"></div>
@endif

@if(session('error'))
    <div id="error-message" data-message="{{ session('error') }}"></div>
@endif

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    // قراءة الرسائل من العناصر المخفية
    const successMessage = document.getElementById('success-message');
    const errorMessage = document.getElementById('error-message');

    // عرض رسالة النجاح إذا كانت موجودة
    if (successMessage) {
        Swal.fire({
            icon: 'success',
            title: 'Payment Has Been Succesfully Accepted',
            text: successMessage.getAttribute('data-message'),
            confirmButtonText: 'Close'
        });
    }

    // عرض رسالة الخطأ إذا كانت موجودة
    if (errorMessage) {
        Swal.fire({
            icon: 'error',
            title: 'Payment Declined',
            text: errorMessage.getAttribute('data-message'),
            confirmButtonText: 'Close'
        });
    }
</script>


    </body>
    </html>
