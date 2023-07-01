@extends('layouts.office')
@section('content')
    <!-- BEGIN: Content-->
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
    <!-- Medal Card -->
    <div class="col-xl-4 col-md-6 col-12">
        <div class="card earnings-card">
            <div class="card-body">
            <div class="row">
                <div class="col-6">
                    <h4 class="card-title mb-1">Earnings</h4>
                    <div class="font-small-2">This Month</div>
                    <h5 class="mb-1">$4055.56</h5>
                </div>
                <div class="col-6">
                    <div id="earnings-chart"></div>
                </div>
            </div>
            </div>
            </div>
    
    </div>
    <!--/ Medal Card -->
    
    <!-- Statistics Card -->
    <div class="col-xl-8 col-md-6 col-12">
    <div class="card card-statistics">
    <div class="card-header">
    <h4 class="card-title">Statistics</h4>
    </div>
    <div class="card-body statistics-body">
    <div class="row">
    <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0">
    <div class="media">
        <div class="avatar bg-light-primary mr-2">
            <div class="avatar-content">
                <i data-feather="trending-up" class="avatar-icon"></i>
            </div>
        </div>
        <div class="media-body my-auto">
            <h4 class="font-weight-bolder mb-0">230k</h4>
            <p class="card-text font-small-3 mb-0">Sales</p>
        </div>
    </div>
    </div>
    <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0">
    <div class="media">
        <div class="avatar bg-light-info mr-2">
            <div class="avatar-content">
                <i data-feather="user" class="avatar-icon"></i>
            </div>
        </div>
        <div class="media-body my-auto">
            <h4 class="font-weight-bolder mb-0">8.549k</h4>
            <p class="card-text font-small-3 mb-0">Customers</p>
        </div>
    </div>
    </div>
    <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-sm-0">
    <div class="media">
        <div class="avatar bg-light-danger mr-2">
            <div class="avatar-content">
                <i data-feather="box" class="avatar-icon"></i>
            </div>
        </div>
        <div class="media-body my-auto">
            <h4 class="font-weight-bolder mb-0">1.423k</h4>
            <p class="card-text font-small-3 mb-0">Products</p>
        </div>
    </div>
    </div>
    <div class="col-xl-3 col-sm-6 col-12">
    <div class="media">
        <div class="avatar bg-light-success mr-2">
            <div class="avatar-content">
                <i data-feather="dollar-sign" class="avatar-icon"></i>
            </div>
        </div>
        <div class="media-body my-auto">
            <h4 class="font-weight-bolder mb-0">$9745</h4>
            <p class="card-text font-small-3 mb-0">Revenue</p>
        </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    <!--/ Statistics Card -->
    </div>
    
    <div class="row match-height">
    <div class="col-lg-4 col-12">
    <div class="row match-height">
    <!-- Bar Chart - Orders -->
    <div class="col-lg-6 col-md-3 col-6">
    <a href="dater.html">     
    <div class="card  text-center " > 
    <div class="card-body pb-50">
    <h3 style="margin-top: 20px;" >Order This Month</h3> 
    <h2 class="font-weight-bolder mb-1" style="margin-top: 30px;" > 276</h2>
    <!-- <div id="statistics-order-chart"></div> -->
    </div>
    </div>
    </a>
    </div>
    <!--/ Bar Chart - Orders -->
    
    <!-- Line Chart - Profit -->
    <div class="col-lg-6 col-md-3 col-6">
        <a href="dater.html">
        <div class="card  text-center " >
        <div class="card-body pb-50">
        <h3 style="margin-top: 20px;" >Order Last Month</h3> 
        <h2 class="font-weight-bolder mb-1" style="margin-top: 30px;" > 500 </h2>
        <!-- <div id="statistics-order-chart"></div> -->
        </div>
        </div>
        </a>
        </div>
    <!--/ Line Chart - Profit -->
    
    <!-- Earnings Card -->
    <div class="col-lg-12 col-md-6 col-12">
    <a href="dater.html">    
    <div class="card earnings-card">
    <div class="card-body" >
    <div class="row">
        <div class="col-12 ">
            <h3 style="margin-top: px;">Order Today</h3>
            <h2 class="font-weight-bolder mb-1" style="margin-top: 20px;">11</h2>
            {{-- <div id="budget-chart"></div> --}}
            <!-- <h4 class="card-title mb-1" style="color: white;">Earnings</h4>
            <div class="font-small-2" style="color: white;" >This Month</div>
            <h5 class="mb-1" style="color: white;" >$4055.56</h5>
            <p class="card-text text-muted font-small-2">
                <span class="font-weight-bolder" style="color: white;" >68.2%</span><span style="color: white;" > more earnings than last month.</span>
            </p>
        </div>
        <div class="col-6">
            <div id="earnings-chart"></div> -->
        </div>
    </div>
    </div>
    </div>
    </a>
    </div>
    <!--/ Earnings Card -->
    </div>
    </div>
    
    <!-- Revenue Report Card -->
    <div class="col-lg-8 col-12">
    <div class="card card-revenue-budget">
    <div class="row mx-0">
    <div class="col-md-7 col-12 revenue-report-wrapper">
    <div class="d-sm-flex justify-content-between align-items-center mb-3">
    <h4 class="card-title mb-50 mb-sm-0">Revenue Report</h4>
    <!-- <div class="d-flex align-items-center">
        <div class="d-flex align-items-center mr-2">
            <span class="bullet bullet-primary font-small-3 mr-50 cursor-pointer"></span>
            <span>Earning</span>
        </div>  
        <div class="d-flex align-items-center ml-75">
            <span class="bullet bullet-warning font-small-3 mr-50 cursor-pointer"></span>
            <span>Expense</span>
        </div>
    </div> -->
    </div>
    <div id="revenue-report-chart"></div>
    </div>
    <div class="col-md-5 col-12 budget-wrapper  my-auto">
    <div class="btn-group" style="zoom: 1.2;">
    <button type="button" class="btn btn-outline-primary btn-sm dropdown-toggle budget-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        2020
    </button>
    <div class="dropdown-menu">
        <a class="dropdown-item" href="javascript:void(0);">2020</a>
        <a class="dropdown-item" href="javascript:void(0);">2019</a>
        <a class="dropdown-item" href="javascript:void(0);">2018</a>
    </div>
    </div>
    <h2 class="mb-25">$25,852</h2>
    <!-- <div class="d-flex justify-content-center">
    <span class="font-weight-bolder mr-25">Budget:</span>
    <span>56,800</span>
    </div> -->
    
    <!-- <button type="button" class="btn btn-primary">Increase Budget</button> -->
    </div>
    </div>
    </div>
    </div>
    <!--/ Revenue Report Card -->
    </div>
    
    </section>
    <!-- Dashboard Ecommerce ends -->
    
    </div>
    </div>
    </div>
    <!-- END: Content-->
    @section('scripts')
        <script>
            setTimeout(function () {
                toastr['success'](
                'In Admin dashboard',
                '👋 Welcome John Doe!',
                {
                    closeButton: true,
                    tapToDismiss: false
                }
                );
            }, 2000);
        </script>
    @endsection
@endsection