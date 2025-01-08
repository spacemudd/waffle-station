@extends('layouts.master')

@section('content')
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endsection
