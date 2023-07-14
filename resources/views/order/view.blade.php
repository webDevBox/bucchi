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
    <div class="table-responsive">
        <div class="block full">
            <table id="ecom-orders" class="table table-bordered table-striped table-vcenter">
                <thead>
                <tr>
                <th class="text-center">Client Name</th>
                <th class="text-center">Delivery Date</th>
                <th class="text-center"> Payment </th>
                <th class="text-center">Remaining Days</th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        <tr>
                            <td class="text-center"> 
                                <a href="#" data-toggle="modal" data-target="#myModal8" data-order-id="{{ $order->id }}" > {{ $order->client->name }} </a>
                            </td>
                            <td class="text-center">{{ $order->completion_date }}</td>
                            <td class="text-center"> {{  percentage($order->outfits->pluck('price')->sum(),$order->transactions->pluck('payment')->sum()) }}</td>
                            <td class="text-center">{{ remainingDays($order->completion_date) }}</td>
                        </tr>
                    @endforeach
                </tbody>
                </table>

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
    @component('components.outfitModal', ['modalId' => 'myModal', 'modalTitle' => 'Outfits'])
        
    @endcomponent
    
@endsection

@section('scripts')
    <script>
        var baseUrl = "{{ url('/') }}";
    </script>
    <script src="{{ asset('app-assets/js/outfitModal.js')}}"></script>
@endsection