@extends('layouts.app')
@section('style')
<style>
        .scrollable-table-wrapper {
        overflow-x: auto;
    }

    .table {
        width: max-content;
        min-width: 100%;
        border-collapse: collapse;
    }

    .table th,
    .table td {
        padding: 8px;
        border: 1px solid #ddd;
    }

    .fixed-columns {
        position: sticky;
        left: 0;
        z-index: 2;
        background-color: #f9f9f9;
    }

    .fixed-columns th,
    .fixed-columns td {
        background-color: inherit;
        border-right: none;
    }

    .fixed-columns th:last-child,
    .fixed-columns td:last-child {
        position: sticky;
        right: 0;
        z-index: 3;
    }

    .scrollable-body {
        position: relative;
    }

    .scrollable-body th:first-child,
    .scrollable-body td:first-child {
        position: sticky;
        left: 0;
        z-index: 3;
        background-color: #f9f9f9;
    }

    .scrollable-body th:last-child,
    .scrollable-body td:last-child {
        position: sticky;
        right: 0;
        z-index: 3;
        background-color: #f9f9f9;
    }
</style>
@endsection
@section('content')
<div class="app-content content ">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body">
            <div style="background-color: white;">
                <h1> <strong> Time </strong> Sheet</h1>
                <div class="col-12">
                    <div class="scrollable-table-wrapper">
                        <table class="table">
                            <thead class="scrollable-body">
                                <tr>
                                    <th>Orders</th>
                                    @for($i = 0; $i < 12; $i++) 
                                        <th>
                                            {{ $weeks[$i]['start'] }} - {{ $weeks[$i]['end'] }}
                                        </th>
                                    @endfor
                                    <th>Total & Action</th>
                                </tr>
                            </thead>
                            <tbody class="scrollable-body">
                                @foreach ($orders as $order)
                                <tr @if($order->passed) class="bg-danger" @endif>
                                    <td scope="row">{{ $order->client_name }}</td>

                                    <td @if($order->week == 1) class="bg-danger text-white" @endif>Mark</td>
                                    <td @if($order->week == 2) class="bg-danger text-white" @endif>Mark</td>
                                    <td @if($order->week == 3) class="bg-danger text-white" @endif>Mark</td>
                                    <td @if($order->week == 4) class="bg-danger text-white" @endif>Mark</td>
                                    <td @if($order->week == 5) class="bg-danger text-white" @endif>Mark</td>
                                    <td @if($order->week == 6) class="bg-danger text-white" @endif>Mark</td>
                                    <td @if($order->week == 7) class="bg-danger text-white" @endif>Mark</td>
                                    <td @if($order->week == 8) class="bg-danger text-white" @endif>Mark</td>
                                    <td @if($order->week == 9) class="bg-danger text-white" @endif>Mark</td>
                                    <td @if($order->week == 10) class="bg-danger text-white" @endif>Mark</td>
                                    <td @if($order->week == 11) class="bg-danger text-white" @endif>Mark</td>
                                    <td @if($order->week == 12) class="bg-danger text-white" @endif>Mark</td>
                                    

                                    <td class="p-2">
                                        <div class="row">
                                            <span>8/10</span>
                                            <a href="#" class="ml-auto">
                                                <i class="fa fa-plus"></i>
                                            </a>
                                        </div>
                                    </td>
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
@endsection

@section('scripts')

@endsection