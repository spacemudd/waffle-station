@extends('back.layouts.master')

@section('content')
<div class="container">
    <h2 class="mb-4">Settings</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('settings.store') }}" method="POST">
        @csrf

        <!-- Company Information Section -->
        <div class="card mb-4">
            <div class="card-header">Company Information</div>
            <div class="card-body">
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}">
                </div>
                <div class="mb-3">
                    <label for="phone" class="form-label">Phone</label>
                    <input type="text" id="phone" name="phone" class="form-control" value="{{ old('phone') }}">
                </div>
                <div class="mb-3">
                    <label for="address" class="form-label">Address</label>
                    <input type="text" id="address" name="address" class="form-control" value="{{ old('address') }}">
                </div>
                <div class="mb-3">
                    <label for="location" class="form-label">Location</label>
                    <input type="text" id="location" name="location" class="form-control" value="{{ old('location') }}">
                </div>
            </div>
        </div>

        <!-- Social Media Accounts Section -->
        <div class="card mb-4">
            <div class="card-header">Social Media Accounts</div>
            <div class="card-body">
                <div class="mb-3">
                    <label for="instagram" class="form-label">Instagram</label>
                    <input type="url" id="instagram" name="instagram" class="form-control" value="{{ old('instagram') }}">
                </div>
                <div class="mb-3">
                    <label for="whatsapp" class="form-label">Whatsapp</label>
                    <input type="text" id="whatsapp" name="whatsapp" class="form-control" value="{{ old('whatsapp') }}">
                </div>
                <div class="mb-3">
                    <label for="facebook" class="form-label">Facebook</label>
                    <input type="url" id="facebook" name="facebook" class="form-control" value="{{ old('facebook') }}">
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Save Settings</button>
    </form>
</div>
@endsection
