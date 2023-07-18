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
                <th class="text-center">Article#</th>
                <th class="text-center">Client Name</th>
                <th class="text-center">Outfit Name</th>
                <th class="text-center">Status</th>
                <th class="text-center"> Completion Date </th>
                <th class="text-center">Description</th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($outfits as $outfit)
                        <tr>
                            <td class="text-center"> {{ $outfit->article }} </td>
                            <td class="text-center"> {{ $outfit->order->client->name }} </td>
                            <td class="text-center">
                                <a href="{{ route('adminOutfitProfile',['id' => $outfit->id ]) }}"> {{ $outfit->name }} </a>
                            </td>
                            <td class="text-center"> Active </td>
                            <td class="text-center">{{ $outfit->order->completion_date }}</td>
                            <td class="text-center">
                                <a href="#" onclick="outfitModalOpener('{{ $outfit->description }}')" data-toggle="modal" data-target="#myModal8">
                                    <i class="fa fa-info-circle" aria-hidden="true"></i>
                                </a>
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
    </section>
    <!-- Dashboard Ecommerce ends -->
    
    </div>
    </div>
    </div>

    <div class="modal fade" id="myModal8" tabindex="-1" role="dialog">
        <div class="modal-lg modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Outfit Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p id="modalDetails"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    
@endsection

@section('scripts')
<script>
    function outfitModalOpener(detail)
    {
        $('#modalDetails').text(detail)
    }
</script>
    
@endsection