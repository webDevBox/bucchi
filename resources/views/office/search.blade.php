@extends('layouts.office')
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
            <input type="text" class="form-control" id="searchInput" placeholder="Search...">
            <table id="ecom-orders" class="table table-bordered table-striped table-vcenter">
                <thead>
                <tr>
                <th class="text-center">Invoice#</th>
                <th class="text-center">Client Name</th>
                <th class="text-center">Delivery Date</th>
                </tr>
                </thead>
                <tbody>
                        <tr>
                            <td class="text-center"> 123 </td>
                            <td class="text-center"> 
                                <a href="#" data-toggle="modal" data-target="#myModal8" > Mark </a>
                            </td>
                            <td class="text-center">8 Jan 2023</td>
                        </tr>
                        <tr>
                            <td class="text-center"> 456 </td>
                            <td class="text-center"> 
                                <a href="#" data-toggle="modal" data-target="#myModal8" > john </a>
                            </td>
                            <td class="text-center">13 june 2023</td>
                        </tr>
                        <tr>
                            <td class="text-center"> 789 </td>
                            <td class="text-center"> 
                                <a href="#" data-toggle="modal" data-target="#myModal8" > Daarm </a>
                            </td>
                            <td class="text-center">23 april 2023</td>
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
    
    </div>
    </div>
    </div>
    @component('components.outfitModal', ['modalId' => 'myModal', 'modalTitle' => 'Outfits'])
        
    @endcomponent
@endsection

@section('scripts')
<script src="{{ asset('app-assets/js/search.js')}}"></script>
    
@endsection