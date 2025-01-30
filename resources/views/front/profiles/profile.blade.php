@extends('front.layouts.master') <!-- تأكد من وجود قالب "layout" الأساسي لديك -->

<link href="{{ asset('front/profilestyle.css') }}" rel="stylesheet">

@section('content')
<div class="container" style="margin-top: 7%;">
    <div class="main-body">
    

    
          <div class="row gutters-sm">
            <div class="col-md-4 mb-3">
              <div class="card">
                <div class="card-body">
                  <div class="d-flex flex-column align-items-center text-center">
                    <img src="{{ asset('assets/profile.png') }}" alt="Admin" class="rounded-circle" width="150" height="130px;">
                    <div class="mt-3">
                      <h4>{{ auth()->user()->full_name }}</h4>
                      <p class="text-muted font-size-sm">{{ auth()->user()->email}}</p>

                    </div>
                  </div>
                </div>
              </div>

            </div>
            <div class="col-md-8">
              <div class="card mb-3">
                <div class="card-body">
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Full Name</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    {{ auth()->user()->full_name }}
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Email</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    {{ auth()->user()->email }}
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">phone</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    {{ auth()->user()->phone_number }}

                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Address</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    {{ auth()->user()->address }}
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-12">
                      <a class="btn btn-info " target="__blank" href="">Edit</a>
                    </div>
                  </div>
                </div>
              </div>

              <div class="row gutters-sm">
    <div class="col-sm-12 mb-3">
        <div class="card h-100">
            <div class="card-body">
                <h6 class="d-flex align-items-center mb-3">
                    <i class="material-icons text-info mr-2">Orders </i> History
                </h6>

                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead class="thead-dark">
                            <tr>
                                <th>Order #</th>
                                <th>Products</th>
                                <th>Order Date</th>
                                <th>Total Amount</th>
                                <th>Payment Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>
                                    <span class="badge badge-primary" style="color: black;">Mini PanCake</span>
                                </td>
                                <td>2025-01-30</td>
                                <td><span class="badge badge-success" style="color: black;">1500</span></td>
                                <td>
                                    <span class="badge badge-success" style="color: green;">Paid</span>
                                </td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>
                                    <span class="badge badge-primary" style="color: black;">Mini PanCake</span>
                                </td>
                                <td>2025-01-30</td>
                                <td><span class="badge badge-success" style="color: black;">1500</span></td>
                                <td>
                                    <span class="badge badge-danger" style="color: red;">Unpaid</span>
                                    <a href="#" class="btn btn-primary btn-sm ml-4">Checkout</a> <!-- Increased margin-left -->
                                </td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>
                                    <span class="badge badge-primary" style="color: black;">Mini PanCake</span>
                                </td>
                                <td>2025-01-30</td>
                                <td><span class="badge badge-success" style="color: black;">1500</span></td>
                                <td>
                                    <span class="badge badge-success" style="color: green;">Paid</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>






            </div>
          </div>

        </div>
    </div>
@endsection
