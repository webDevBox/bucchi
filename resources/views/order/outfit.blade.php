@extends('layouts.app')
@section('content')
<div class="app-content content ">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper">
    <div class="content-header row">
    </div>
    <div class="content-body">
    <!-- Dashboard Ecommerce Starts -->
    <section id="dashboard-ecommerce">
    
    <div class="row match-height">
    <!-- Company Table Card -->
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="card card-company-table">
    <div class="card-body p-0">
        <h1 class="text-center">Outfit Details</h1>
        <div class="row p-2">
            {{-- <div class="rounded box-shadow col-md-5 col-sm-12">
                <h2 class="text-center">Client Details</h2>
                <p>Name: <strong> John </strong></p>
                <p>Contact No: <strong> +92 300 00000000 </strong></p>
                <p>Email: <strong> John@gmail.com </strong></p>
            </div>
            <div class="rounded box-shadow offset-md-1 col-md-5 col-sm-12">
                <h2 class="text-center">Order Details</h2>
                <p>Delivery: <strong> Deliveru soon </strong></p>
                <p>Delivery Date: <strong> 25 june 2023 </strong></p>
                <p>Currency: <strong> PKR </strong></p>
            </div> --}}
            <div class="rounded box-shadow offset-md-2 col-md-8 col-sm-12">
                <h2 class="text-center">Outfit Status</h2>
                <div class="row">
                    @foreach ($outfit->statuses as $status)
                        <div class="col-md-9 col-sm-12 mt-1">
                            {{ $status->status }}
                        </div>
                        <div class="col-md-3 col-sm-12 mt-1">
                            <span class="badge badge-primary">
                                {{ $status->date_time }}
                            </span>
                        </div>
                    @endforeach
                </div>
                
            </div>
            <div class="rounded box-shadow offset-md-2 col-md-8 col-sm-12">
                {{-- <h2 class="text-center">Outfit Details</h2> --}}
                <p>Outfit Name: <strong> {{ $outfit->name }} </strong></p>
                <p>Client Name: <strong> {{ $outfit->order->client->name }} </strong></p>
                <p>Delivery Date: <strong> {{ $outfit->order->completion_date }} </strong></p>
                <p>Outfit Description: <strong> {{ $outfit->description }} </strong></p>
                <p>Outfit Price: <strong> {{ $outfit->price }} </strong></p>
                <p>Hours: <strong> {{ $outfit->hours }} </strong></p>
                
            </div>
        </div>
    </div>
    </div>
    </div>
    
    </div>
    </section>
    <!-- Dashboard Ecommerce ends -->
    
    </div>
    </div>
    </div>
    
@endsection

@section('scripts')

    
@endsection