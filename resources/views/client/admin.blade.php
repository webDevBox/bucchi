@extends('layouts.app')

@section('style')
<style>
.loader {
  width: 32px;
  height: 32px;
  position: relative;
  border-radius: 50%;
  color: #FF3D00;
  display: block;
  animation: fill 1s ease-in infinite alternate;
}
.loader::before , .loader::after {
  content: '';
  position: absolute;
  height: 100%;
  width: 100%;
  border-radius: 50%;
  left: 48px;
  top: 0;
  animation: fill 0.9s ease-in infinite alternate;
}

.loader::after {
  left: auto;
  right: 48px;
  animation-duration: 1.1s;
}

@keyframes fill {
 0% {  box-shadow: 0 0 0 2px inset }
 100%{ box-shadow: 0 0 0 10px inset }
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

            <section id="dashboard-ecommerce">

                <div class="row match-height">
                    <!-- Company Table Card -->
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="card card-company-table">
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <div class="block full p-2">
                                        <div class="row">
                                            <div class="col-md-6 col-sm-12">
                                                <button data-toggle="modal" data-target="#myModal8" class="btn btn-primary">Add New Client</button>
                                            </div>
                                            <div id="loader_wait" class="d-none col-md-6 col-sm-12">
                                                <span class="loader"></span>
                                            </div>
                                        </div>
                                        <table id="clients_directory"
                                            class="table table-bordered table-striped table-vcenter">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">Client Name</th>
                                                    <th class="text-center">Contact</th>
                                                    <th class="text-center">Email</th>
                                                    <th class="text-center">Country</th>
                                                    <th class="text-center">File#</th>
                                                    <th class="text-center">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($clients as $client)
                                                <tr>
                                                    <td class="text-center">{{ $client->name }}</td>
                                                    <td class="text-center">{{ $client->contact }}</td>
                                                    <td class="text-center">{{ $client->email }}</td>
                                                    <td class="text-center">{{ $client->country }}</td>
                                                    <td class="text-center">{{ $client->file_num }}</td>
                                                    <td class="text-center">
                                                        <div class="btn-group btn-group-xs">
                                                            <a href="{{ route('editClient', ['id' => $client->id]) }}"
                                                                target="_blank" class="btn btn-primary">
                                                                <i class="fa fa-pencil"></i>
                                                            </a>
                                                            <a href="#" onclick="deleteClient({{ $client->id }},this)"
                                                                class="btn btn-danger">
                                                                <i class="fa fa-trash"></i>
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
            </section>

            <div class="modal fade" id="myModal8" tabindex="-1" role="dialog">
                <div class="modal-lg modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Add New Client</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row p-3">
                                <button onclick="showClientForm('single')" class="col-4 btn btn-primary">Add Single
                                    Client
                                </button>
                                <button onclick="showClientForm('multiple')" class="offset-4 col-4 btn btn-success">Add
                                    Multiple Clients
                                </button>
                            </div>
                            <div id="single_form">
                                <div class="form-group">
                                    <Label for="client_name">Client Name</Label>
                                    <input type="text" id="client_name" class="form-control"
                                        placeholder="Enter Client Name...">
                                    <small id="client_name_error" class="d-none text-danger">Client Name
                                        Required</small>
                                </div>
                                <div class="form-group">
                                    <Label for="client_contact">Client Contact</Label>
                                    <input type="number" id="client_contact" class="form-control"
                                        placeholder="Enter Client Contact...">
                                </div>
                                <div class="form-group">
                                    <Label for="client_email">Client Email</Label>
                                    <input type="email" id="client_email" class="form-control"
                                        placeholder="Enter Client Email...">
                                </div>
                                <div class="form-group">
                                    <Label for="client_country">Client Country</Label>
                                    <input type="text" id="client_country" class="form-control"
                                        placeholder="Enter Client Country Name...">
                                </div>
                                <div class="form-group">
                                    <Label for="client_file">Client File#</Label>
                                    <input type="text" id="client_file" class="form-control"
                                        placeholder="Enter Client File Number...">
                                    <small id="client_file_error" class="d-none text-danger"></small>
                                </div>
                            </div>
                            <div id="multiple_form" class="d-none">
                                <div class="row">
                                    <h3>Add Excel Sheet of Clients</h3>
                                    <a href="{{ asset('app-assets/files/sample.xlsx') }}" download class="ml-auto btn btn-link" >Download Sample</a>
                                </div>
                                    <div class="form-group">
                                        <label for="filer">Upload File</label>
                                        <input type="file" name="file" id="filer" accept=".xlsx, .csv"
                                            class="btn btn-success">
                                    </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" onclick="createBulkClients()" id="multiple_form_submit" title="Send Multiple Client"
                                class="d-none btn btn-primary">Send</button>
                            <button type="button" id="singular_form_submit" title="Send Single Client"
                                onclick="createClient()" class="btn btn-primary">Send</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    var baseUrl = "{{ url('/') }}"
    $(document).ready(function() {
    $('#clients_directory').DataTable({
        // Replace "1" with the index of the column you want to make orderable (in this case, it's the second column, so index 1)
        "order": [[1, "asc"]],
        "columnDefs": [
            {
                // Disable ordering for the 2nd column (PDF column)
                "targets": [2],
                "orderable": false
            },
            {
                // Disable ordering for the last column (Action column)
                "targets": [3],
                "orderable": false
            }
        ],
        "lengthMenu": [10, 25, 50, 100, 500, 1000],
    });
});
</script>
<script src="https://cdn.jsdelivr.net/npm/xlsx@0.17.0/dist/xlsx.full.min.js"></script>
<script src="{{ asset('app-assets/js/client.js')}}"></script>

@endsection