@extends('layouts.app')
@section('style')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
@endsection

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
            <!-- All Orders Content -->
                <table id="ecom-orders" class="table table-bordered table-striped table-vcenter">
                <thead>
                <tr>
                <th class="text-center">Invoice#</th>
                <th class="text-center">Client Name</th>
                <th class="text-center">Delivery Date</th>
                <th class="text-center"> Status </th>
                <th class="text-center">remaining Hour</th>
                </tr>
                </thead>
                <tbody>
                        <tr>
                            <td class="text-center"> 123 </td>
                            <td class="text-center"> 
                                <a href="#" data-toggle="tooltip" title="View" > john </a>
                            </td>
                            <td class="text-center">3 june 2023</td>
                            <td class="text-center"> Active </td>
                            <td class="text-center">5</td>
                            </tr>
                    
                </tbody>
                </table>
            <!-- END All Orders Content -->

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