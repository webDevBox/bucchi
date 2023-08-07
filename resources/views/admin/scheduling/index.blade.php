@extends('layouts.app')
@section('style')
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/multi-form.css')}}">
<style>
    .block {
        border: 1px solid #ccc;
        border-radius: 5px;
        padding: 10px;
        margin-bottom: 10px;
    }

    .button-block {
        margin-top: 10px;
        text-align: right;
    }

    .move-up,
    .move-down,
    .delete {
        margin-left: 5px;
    }

    .input-field {
        display: block;
        margin-bottom: 5px;
        padding: 5px;
        width: 100%;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    #add-block {
        margin-top: 10px;
    }

    .input-field.error {
        border-color: red;
    }

    .input-field.error::placeholder {
        color: red;
    }

    .payment_deleter {
        margin-top: 24px;
    }

    #outfits-list {
        list-style: none;
        padding: 0;
    }

    /* Style each list item */
    #outfits-list li {
        background-color: #f9eaea;
        padding: 10px;
        margin: 5px;
        border-radius: 5px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        font-family: Arial, sans-serif;
        color: #333;
    }

    /* Add a hover effect to highlight the list items */
    #outfits-list li:hover {
        background-color: #fff0f0;
        cursor: pointer;
    }

    .extra-anchor:hover {
        color: #ffffff
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
                    <div class="table-responsive">
                    <table class="table table-bordered table-striped table-vcenter">
                        <thead>
                            <tr>
                                <th class="text-center">Entry Type</th>
                                <th class="text-center">Expense Type</th>
                                <th class="text-center">Particular</th>
                                <th class="text-center">Weight</th>
                                <th class="text-center">Amount</th>
                                <th class="text-center">Date</th>
                                <th class="text-center">Created By</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                            {{-- <tr>
                                <td class="text-center">{{ $cash->entry_type }}</td>
                                <td class="text-center">{{ $cash->expense_type }}</td>
                                <td class="text-center">{{ $cash->particular }}</td>
                                <td class="text-center">{{ $cash->weight }}</td>
                                <td class="text-center">
                                    @if($cash->entry_type == 'Received')
                                    <span class="text-success"> +{{ $cash->amount }} </span>
                                    @else
                                    <span class="text-danger"> -{{ $cash->amount }} </span>
                                    @endif
                                </td>
                                <td class="text-center">{{ formateDateTime($cash->created_at) }}</td>
                                <td class="text-center">{{ $cash->user->name }}</td>
                                <td class="text-center">
                                    <div class="btn-group btn-group-xs">

                                        <a href="{{ route('pettyDelete',['id' => $cash->id]) }}"
                                            onclick="return confirm('Are you sure you want to Delete Transaction')"
                                            class="btn btn-danger">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr> --}}
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