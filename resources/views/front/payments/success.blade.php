@extends('layouts.master')

@section('content')
    <div class="alert alert-success">
        {{ session('message') }}
    </div>
@endsection
