@extends('front.layouts.master')
<link rel="stylesheet" href="{{ asset('front/wstyle.css')}}">
@section('content')
    <div class="container-fluid p-0">
        <img src="{{ asset('assets/Franchise-page-banner-scaled.jpg') }}" class="img-fluid w-100" style="height: 300px; object-fit: cover;" alt="Full-width image">
    </div>

    <div class="container my-5">
        <div class="row align-items-center">
            <!-- Video Container -->
            <div class="col-md-6">
                <div class="video-container">
                    <video controls width="100%" height="100%">
                        <source src="{{asset('assets/video/WhatsApp Video 2024-12-22 at 12.15.56.mp4')}}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                </div>
            </div>
            <!-- Text Container -->
            <div class="col-md-6">
                <h2 class="" style="color: orange;">Our Mission</h2>
                <p style="font-size: 25px;">
                    We are committed to delivering value through innovative solutions and services.
                    Our mission is to empower individuals and businesses by fostering growth, integrity,
                    and excellence in everything we do.
                </p>
            </div>
        </div>
    </div>

    <div class="container my-5 p-4">
        <h2 class="text-center fw-bold mb-4" style="color: orange;">Contact Us</h2>
        <p class="text-center text-muted mb-5">
            Feel free to reach out to us for any inquiries or support. We are here to help!
        </p>
        <form action="#" method="POST" class="shadow p-4 rounded">
            @csrf
            <div class="row">
                <div class="col-md-6 mb-4">
                    <input type="text" class="form-control form-control-lg" id="name" name="name" placeholder="Enter your full name" required>
                </div>
                <div class="col-md-6 mb-4">
                    <input type="email" class="form-control form-control-lg" id="email" name="email" placeholder="Enter your email address" required>
                </div>
            </div>
            <div class="mb-4">
                <input type="text" class="form-control form-control-lg" id="subject" name="subject" placeholder="What is your message about?" required>
            </div>
            <div class="mb-4">
                <textarea class="form-control form-control-lg" id="message" name="message" rows="5" placeholder="Write your message here..." required></textarea>
            </div>
            <div class="text-end">
                <button type="submit" class="btn btn-primary btn-lg px-4 shadow" style="background-color: orange; border-color: orange;">Send Message</button>
            </div>
        </form>
    </div>



@endsection
