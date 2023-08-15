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
<div class="app-content content d-none d-md-block">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body">
            <div class="p-2" style="background-color: white;">
                <h1 class="text-center"> <strong> Time </strong> Sheet</h1>
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
                                    <td scope="row">{{ $order->client->name }}</td>

                                    <td @if($order->week == 1) class="bg-danger text-white" @endif> <input type="number" value="{{ $order->scheduling->where('week',1)->isNotEmpty() ? $order->scheduling->where('week',1)->first()->hours : '' }}" id="week_1_{{ $order->id }}" placeholder="Hours..." class="form-control order_week_1" onchange="checkAvailability(1,{{ $order->id }})" onkeyup="checkAvailability(1,{{ $order->id }})" style="width: 100px"> </td>
                                    <td @if($order->week == 2) class="bg-danger text-white" @endif> <input type="number"  value="{{ $order->scheduling->where('week',2)->isNotEmpty() ?  $order->scheduling->where('week',2)->first()->hours : ''  }}" id="week_2_{{ $order->id }}" placeholder="Hours..." class="form-control order_week_2" onchange="checkAvailability(2,{{ $order->id }})" onkeyup="checkAvailability(2,{{ $order->id }})" style="width: 100px"> </td>
                                    <td @if($order->week == 3) class="bg-danger text-white" @endif> <input type="number" value="{{ $order->scheduling->where('week',3)->isNotEmpty() ?  $order->scheduling->where('week',3)->first()->hours : ''  }}" id="week_3_{{ $order->id }}" placeholder="Hours..." class="form-control order_week_3" onchange="checkAvailability(3,{{ $order->id }})" onkeyup="checkAvailability(3,{{ $order->id }})" style="width: 100px"> </td>
                                    <td @if($order->week == 4) class="bg-danger text-white" @endif> <input type="number" value="{{ $order->scheduling->where('week',4)->isNotEmpty() ?  $order->scheduling->where('week',4)->first()->hours : ''  }}" id="week_4_{{ $order->id }}" placeholder="Hours..." class="form-control order_week_4" onchange="checkAvailability(4,{{ $order->id }})" onkeyup="checkAvailability(4,{{ $order->id }})" style="width: 100px"> </td>
                                    <td @if($order->week == 5) class="bg-danger text-white" @endif> <input type="number" value="{{ $order->scheduling->where('week',5)->isNotEmpty() ?  $order->scheduling->where('week',5)->first()->hours : ''  }}" id="week_5_{{ $order->id }}" placeholder="Hours..." class="form-control order_week_5" onchange="checkAvailability(5,{{ $order->id }})" onkeyup="checkAvailability(5,{{ $order->id }})" style="width: 100px"> </td>
                                    <td @if($order->week == 6) class="bg-danger text-white" @endif> <input type="number" value="{{ $order->scheduling->where('week',6)->isNotEmpty() ?  $order->scheduling->where('week',6)->first()->hours : ''  }}" id="week_6_{{ $order->id }}" placeholder="Hours..." class="form-control order_week_6" onchange="checkAvailability(6,{{ $order->id }})" onkeyup="checkAvailability(6,{{ $order->id }})" style="width: 100px"> </td>
                                    <td @if($order->week == 7) class="bg-danger text-white" @endif> <input type="number" value="{{ $order->scheduling->where('week',7)->isNotEmpty() ?  $order->scheduling->where('week',7)->first()->hours : ''  }}" id="week_7_{{ $order->id }}" placeholder="Hours..." class="form-control order_week_7" onchange="checkAvailability(7,{{ $order->id }})" onkeyup="checkAvailability(7,{{ $order->id }})" style="width: 100px"> </td>
                                    <td @if($order->week == 8) class="bg-danger text-white" @endif> <input type="number" value="{{ $order->scheduling->where('week',8)->isNotEmpty() ?  $order->scheduling->where('week',8)->first()->hours : ''  }}" id="week_8_{{ $order->id }}" placeholder="Hours..." class="form-control order_week_8" onchange="checkAvailability(8,{{ $order->id }})" onkeyup="checkAvailability(8,{{ $order->id }})" style="width: 100px"> </td>
                                    <td @if($order->week == 9) class="bg-danger text-white" @endif> <input type="number" value="{{ $order->scheduling->where('week',9)->isNotEmpty() ?  $order->scheduling->where('week',9)->first()->hours : ''  }}" id="week_9_{{ $order->id }}" placeholder="Hours..." class="form-control order_week_9" onchange="checkAvailability(9,{{ $order->id }})" onkeyup="checkAvailability(9,{{ $order->id }})" style="width: 100px"> </td>
                                    <td @if($order->week == 10) class="bg-danger text-white" @endif> <input type="number" value="{{ $order->scheduling->where('week',10)->isNotEmpty() ?  $order->scheduling->where('week',10)->first()->hours : ''  }}" id="week_10_{{ $order->id }}" placeholder="Hours..." class="form-control order_week_10" onchange="checkAvailability(10,{{ $order->id }})" onkeyup="checkAvailability(10,{{ $order->id }})" style="width: 100px"> </td>
                                    <td @if($order->week == 11) class="bg-danger text-white" @endif> <input type="number" value="{{ $order->scheduling->where('week',11)->isNotEmpty() ?  $order->scheduling->where('week',11)->first()->hours : ''  }}" id="week_11_{{ $order->id }}" placeholder="Hours..." class="form-control order_week_11" onchange="checkAvailability(11,{{ $order->id }})" onkeyup="checkAvailability(11,{{ $order->id }})" style="width: 100px"> </td>
                                    <td @if($order->week == 12) class="bg-danger text-white" @endif> <input type="number" value="{{ $order->scheduling->where('week',12)->isNotEmpty() ?  $order->scheduling->where('week',12)->first()->hours : ''  }}" id="week_12_{{ $order->id }}" placeholder="Hours..." class="form-control order_week_12" onchange="checkAvailability(12,{{ $order->id }})" onkeyup="checkAvailability(12,{{ $order->id }})" style="width: 100px"> </td>
                                    
                                    <td class="p-2">
                                        <div class="row">
                                            <span id="assign_{{ $order->id }}">{{ $order->scheduling->where('order_id',$order->id)->isNotEmpty() ? $order->scheduling->where('order_id',$order->id)->sum('hours') : 0 }}</span> / <span id="remaining_hour_{{ $order->id }}">{{ $order->remaining }}</span>
                                            <a href="#" onclick="createSchedule(event,{{ $order->id }},{{ $order->remaining }})" class="ml-auto">
                                                <i class="fa fa-plus"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                                <tr>
                                    <td scope="row">Total</td>

                                    <td><input type="number" value="{{ $availableHour->where('week',1)->isNotEmpty() ? $availableHour->where('week',1)->first()->hours : 0 }}" id="available_week_1" placeholder="Available Hours..." class="form-control" style="width: 100px"></td>
                                    <td><input type="number" value="{{ $availableHour->where('week',2)->isNotEmpty() ? $availableHour->where('week',2)->first()->hours : 0 }}" id="available_week_2" placeholder="Available Hours..." class="form-control" style="width: 100px"></td>
                                    <td><input type="number" value="{{ $availableHour->where('week',3)->isNotEmpty() ? $availableHour->where('week',3)->first()->hours : 0 }}" id="available_week_3" placeholder="Available Hours..." class="form-control" style="width: 100px"></td>
                                    <td><input type="number" value="{{ $availableHour->where('week',4)->isNotEmpty() ? $availableHour->where('week',4)->first()->hours : 0 }}" id="available_week_4" placeholder="Available Hours..." class="form-control" style="width: 100px"></td>
                                    <td><input type="number" value="{{ $availableHour->where('week',5)->isNotEmpty() ? $availableHour->where('week',5)->first()->hours : 0 }}" id="available_week_5" placeholder="Available Hours..." class="form-control" style="width: 100px"></td>
                                    <td><input type="number" value="{{ $availableHour->where('week',6)->isNotEmpty() ? $availableHour->where('week',6)->first()->hours : 0 }}" id="available_week_6" placeholder="Available Hours..." class="form-control" style="width: 100px"></td>
                                    <td><input type="number" value="{{ $availableHour->where('week',7)->isNotEmpty() ? $availableHour->where('week',7)->first()->hours : 0 }}" id="available_week_7" placeholder="Available Hours..." class="form-control" style="width: 100px"></td>
                                    <td><input type="number" value="{{ $availableHour->where('week',8)->isNotEmpty() ? $availableHour->where('week',8)->first()->hours : 0 }}" id="available_week_8" placeholder="Available Hours..." class="form-control" style="width: 100px"></td>
                                    <td><input type="number" value="{{ $availableHour->where('week',9)->isNotEmpty() ? $availableHour->where('week',9)->first()->hours : 0 }}" id="available_week_9" placeholder="Available Hours..." class="form-control" style="width: 100px"></td>
                                    <td><input type="number" value="{{ $availableHour->where('week',10)->isNotEmpty() ? $availableHour->where('week',10)->first()->hours : 0 }}" id="available_week_10" placeholder="Available Hours..." class="form-control" style="width: 100px"></td>
                                    <td><input type="number" value="{{ $availableHour->where('week',11)->isNotEmpty() ? $availableHour->where('week',11)->first()->hours : 0 }}" id="available_week_11" placeholder="Available Hours..." class="form-control" style="width: 100px"></td>
                                    <td><input type="number" value="{{ $availableHour->where('week',12)->isNotEmpty() ? $availableHour->where('week',12)->first()->hours : 0 }}" id="available_week_12" placeholder="Available Hours..." class="form-control" style="width: 100px"></td>

                                    <td class="p-2">
                                        <div class="row">
                                            <span id="availability_total">{{ $availableHour->isNotEmpty() ? $availableHour->sum('hours') : 0 }}</span>
                                            <a href="#" onclick="createAvailableHour(event)" class="ml-auto">
                                                <i class="fa fa-plus"></i>
                                            </a>
                                        </div>
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
@endsection

@section('scripts')
<script>
    const baseUrl = "{{ url('/') }}"
</script>
<script src="{{ asset('app-assets/js/scheduling.js')}}"></script>
@endsection