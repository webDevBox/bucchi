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
                        <table class="table">
                            <thead>
                              <tr>
                                <th scope="col">Orders</th>
                                <th scope="col">First</th>
                                <th scope="col">Last</th>
                                <th scope="col">Handle</th>
                                <th scope="col">Handle</th>
                                <th scope="col">Handle</th>
                                <th scope="col">Handle</th>
                                <th scope="col">Handle</th>
                                <th scope="col">Handle</th>
                                <th scope="col">Handle</th>
                                <th scope="col">Handle</th>
                                <th scope="col">Handle</th>
                                <th scope="col">Handle</th>
                                <th scope="col">Handle</th>
                                <th scope="col">Handle</th>
                              </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $order)
                                    <tr>
                                        <th scope="row">{{ $order->client->name }}</th>
                                        <td>Mark</td>
                                        <td>Otto</td>
                                        <td>@mdo</td>
                                        <td>@mdo</td>
                                        <td>@mdo</td>
                                        <td>@mdo</td>
                                        <td>@mdo</td>
                                        <td>@mdo</td>
                                        <td>@mdo</td>
                                        <td>@mdo</td>
                                        <td>@mdo</td>
                                        <td>@mdo</td>
                                        <td>@mdo</td>
                                        <td>@mdo</td>
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