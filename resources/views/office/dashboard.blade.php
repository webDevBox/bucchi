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
                </div>

            </section>
            <!-- Dashboard Ecommerce ends -->

        </div>
    </div>
</div>
<!-- END: Content-->
@section('scripts')

@endsection
@endsection