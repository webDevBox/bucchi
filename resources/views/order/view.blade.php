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
                <th class="text-center">remaining Hour</th>
                </tr>
                </thead>
                <tbody>
                        <tr>
                            <td class="text-center"> 
                                <a href="#" data-toggle="modal" data-target="#myModal8" > john </a>
                            </td>
                            <td class="text-center">3 june 2023</td>
                            <td class="text-center"> 15% </td>
                            <td class="text-center">5</td>
                        </tr>
                        <tr>
                            <td class="text-center"> 
                                <a href="#" data-toggle="modal" data-target="#myModal8" > Dekro </a>
                            </td>
                            <td class="text-center">4 may 2023</td>
                            <td class="text-center"> 24% </td>
                            <td class="text-center">10</td>
                        </tr>
                        <tr>
                            <td class="text-center"> 
                                <a href="#" data-toggle="modal" data-target="#myModal8" > john </a>
                            </td>
                            <td class="text-center">13 july 2023</td>
                            <td class="text-center"> 60% </td>
                            <td class="text-center">8</td>
                        </tr>
                    
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

    
@endsection