@extends('back.layouts.master')
@section('content')

<div class="container">
    <h2 class="mb-4">Waffle Station Items </h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>id</th>
                <th>Item Name</th>
                <th>Price</th>
            </tr>
        </thead>
        <tbody>
            @foreach($items as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->product_name }}</td>
                    <td>{{ $product->price }}</td>
                    <td>
                        <a href="#" class="btn btn-primary btn-sm">Edit</a>
                        <form action="#" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection