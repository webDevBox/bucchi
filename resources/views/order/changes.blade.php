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
                <th class="text-center">Invoice#</th>
                <th class="text-center">Client Name</th>
                <th class="text-center">Delivery Date</th>
                <th class="text-center"> PDF </th>
                <th class="text-center">Edit</th>
                </tr>
                </thead>
                <tbody>
                        <tr>
                            <td class="text-center"> 123 </td>
                            <td class="text-center"> 
                                <a href="#" data-toggle="modal" data-target="#myModal8" > john </a>
                            </td>
                            <td class="text-center">3 june 2023</td>
                            <td class="text-center"> 
                                <div class="btn-group btn-group-xs">
                                    <a href="#" data-toggle="tooltip" title="Download PDF" class="btn btn-success"><i class="fa fa-download"></i></a>
                                </div>    
                            </td>
                            <td class="text-center">
                                <div class="btn-group btn-group-xs">
                                    <a href="#" onclick="editConfirmation(2)" title="Edit" class="btn btn-primary"><i class="fa fa-pencil"></i></a>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center"> 456 </td>
                            <td class="text-center"> 
                                <a href="#" data-toggle="modal" data-target="#myModal8" > Mark </a>
                            </td>
                            <td class="text-center">23 june 2023</td>
                            <td class="text-center"> 
                                <div class="btn-group btn-group-xs">
                                    <a href="#" data-toggle="tooltip" title="Download PDF" class="btn btn-success"><i class="fa fa-download"></i></a>
                                </div>    
                            </td>
                            <td class="text-center">
                                <div class="btn-group btn-group-xs">
                                    <a href="#" onclick="editConfirmation(4)" title="Edit" class="btn btn-primary"><i class="fa fa-pencil"></i></a>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center"> 789 </td>
                            <td class="text-center"> 
                                <a href="#" data-toggle="modal" data-target="#myModal8" > De-Gro </a>
                            </td>
                            <td class="text-center">15 may 2023</td>
                            <td class="text-center"> 
                                <div class="btn-group btn-group-xs">
                                    <a href="#" data-toggle="tooltip" title="Download PDF" class="btn btn-success"><i class="fa fa-download"></i></a>
                                </div>    
                            </td>
                            <td class="text-center">
                                <div class="btn-group btn-group-xs">
                                    <a href="#" onclick="editConfirmation(8)" title="Edit" class="btn btn-primary"><i class="fa fa-pencil"></i></a>
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
    </section>
    <!-- Dashboard Ecommerce ends -->
    
    </div>
    </div>
    </div>
    @component('components.updateModal', ['modalId' => 'myModal', 'modalTitle' => 'Outfit Details'])
        
    @endcomponent
    
@endsection

@section('scripts')
<script>
    function editConfirmation(id) {
        let text = "Are you sure you want to edit the invoice?";
        if (confirm(text) == true) {
            let url = "{{ route('orderUpdate', ['id' => ':id']) }}";
            url = url.replace(':id', id);
            window.location.href = url;
        } else {
            text = "You canceled!";
        }
    }
    
    function sendProduction() {
        let text = "Send Article#123, Outfit Name XYZ for production?”";
        if (confirm(text) == true) {
            text = "You pressed OK!";
        } else {
            text = "You canceled!";
        }
    }
</script>
    
@endsection