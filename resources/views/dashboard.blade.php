@extends('layouts.app')
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
                    <div class="col-12">
                        <div class="card card-company-table">
                            <div class="card-body p-2">
                                <h4 class="text-center">Orders Completion in 30 Days</h4>
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Client Name</th>
                                                <th>Order Invoice</th>
                                                <th>Remaining Days</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($order30Days as $order)
                                                <tr>
                                                    <td>{{ $order->client->name }}</td>
                                                    <td>{{ $order->invoice }}</td>
                                                    <td>{{ remainingDays($order->completion_date) }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="offset-md-10 offset-sm-0 mt-2">
                                    {{ $order30Days->links('vendor.pagination.simple-bootstrap-4') }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <div class="row match-height">
                            
                            <!-- Earnings Card -->
                            <div class="col-12">
                                <div class="card earnings-card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-12 text-center">
                                                <h4 class="card-title mb-1">Orders</h4>
                                                <div class="font-small-2">This Month</div>
                                                <h5 class="mb-1">{{ formatNumberWithK($thisMonth) }}</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Statistics Card -->
                    <div class="col-md-8 col-sm-12">
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
                                                <h4 class="font-weight-bolder mb-0">{{ formatNumberWithK($totalOrders)
                                                    }}</h4>
                                                <p class="card-text font-small-3 mb-0">Orders</p>
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
                                                <h4 class="font-weight-bolder mb-0">{{ formatNumberWithK($clients) }}
                                                </h4>
                                                <p class="card-text font-small-3 mb-0">Clients</p>
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
                                                <h4 class="font-weight-bolder mb-0">{{ formatNumberWithK($products) }}
                                                </h4>
                                                <p class="card-text font-small-3 mb-0">Outfits</p>
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
                                                <h4 class="font-weight-bolder mb-0">{{ formatNumberWithK($revenue) }}
                                                </h4>
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
                    <!-- Revenue Report Card -->
                    <div class="col-md-6 col-sm-12">
                        <div class="card card-revenue-budget">
                            <div class="row mx-0">
                                <div class="col-md-12 col-12 revenue-report-wrapper">
                                    <div class="d-sm-flex justify-content-between align-items-center mb-3">
                                        <h4 class="card-title mb-50 mb-sm-0">Outfit Report</h4>
                                    </div>
                                    <div class="row">
                                        <div class="col-3">
                                            <strong class="text-center d-block"> Production </strong>
                                            <p class="text-center d-block">{{ $outfitProduction }}</p>
                                        </div>
                                        <div class="col-3">
                                            <strong class="text-center d-block"> Embroidery </strong>
                                            <p class="text-center d-block">{{ $outfitEmbroidery }}</p>
                                        </div>
                                        <div class="col-3">
                                            <strong class="text-center d-block"> Tailoring </strong>
                                            <p class="text-center d-block">{{ $outfitTailoring }}</p>
                                        </div>
                                        <div class="col-3">
                                            <strong class="text-center d-block"> Completed </strong>
                                            <p class="text-center d-block">{{ $outfitCompleted }}</p>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!--/ Revenue Report Card -->
                    
                    {{-- OverView Card --}}
                    <div class="col-md-6 col-sm-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h4 class="card-title">Orders Overview</h4>
                            </div>
                            <div class="card-body p-0">
                                <div id="goal-overview-radial-bar-chart" class="my-2"></div>
                                <div class="row border-top text-center mx-0">
                                    <div class="col-6 border-right py-1">
                                        <p class="card-text text-muted mb-0">Completed</p>
                                        <h3 class="font-weight-bolder mb-0">{{ $completedOutfits }}</h3>
                                    </div>
                                    <div class="col-6 py-1">
                                        <p class="card-text text-muted mb-0">In Progress</p>
                                        <h3 class="font-weight-bolder mb-0">{{ $inProgressOutfits }}</h3>
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
<!-- END: Content-->
@section('scripts')
<script>
    const outfitProduction = {{ $outfitProduction }}
    const outfitEmbroidery = {{ $outfitEmbroidery }}
    const outfitTailoring = {{ $outfitTailoring }}
    const outfitCompleted = {{ $outfitCompleted }}
    const overview = {{ $order_over }}
</script>
@endsection
@endsection