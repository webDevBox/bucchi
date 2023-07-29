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

    .loader::before,
    .loader::after {
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
        0% {
            box-shadow: 0 0 0 2px inset
        }

        100% {
            box-shadow: 0 0 0 10px inset
        }
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
                                                <button data-toggle="modal" data-target="#myModal8"
                                                    class="btn btn-primary">Add New Office</button>
                                            </div>
                                            <div id="loader_wait" class="d-none col-md-6 col-sm-12">
                                            </div>
                                        </div>
                                        <table id="clients_directory"
                                            class="table table-bordered table-striped table-vcenter">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">Name</th>
                                                    <th class="text-center">Email</th>
                                                    <th class="text-center">Status</th>
                                                    <th class="text-center">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($offices as $office)
                                                <tr>
                                                    <td class="text-center">{{ $office->name }}</td>
                                                    <td class="text-center">{{ $office->email }}</td>
                                                    <td class="text-center"> @if($office->status == 0)
                                                        <span class="badge badge-success">Active</span>
                                                        @else <span class="badge badge-danger">InActive</span> @endif
                                                    </td>
                                                    <td class="text-center">
                                                        <div class="btn-group btn-group-xs">
                                                            <a href="{{ route('editOffice', ['id' => $office->id]) }}"
                                                                target="_blank" class="btn btn-primary">
                                                                <i class="fa fa-pencil"></i>
                                                            </a>
                                                            <a href="{{ route('officeDelete',['id' => $office->id]) }}"
                                                                onclick="return confirm('Are you sure you want to Delete Office')"
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
                            <h5 class="modal-title">Add New Officer</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="{{ route('createOffice') }}">
                                @csrf
                                <div class="form-group">
                                    <Label for="client_name">Name</Label>
                                    <input type="text" name="name" id="client_name" class="form-control"
                                        placeholder="Enter Officer Name..." required>
                                </div>
                                <div class="form-group">
                                    <Label for="client_email">Email</Label>
                                    <input type="email" name="email" id="client_email" class="form-control"
                                        placeholder="Enter Officer Email..." required>
                                </div>
                                <div class="form-group">
                                    <Label for="client_file">Passowrd</Label>
                                    <input type="password" name="password" id="client_file" class="form-control"
                                        placeholder="Enter Officer Password..." required>
                                </div>
                                <hr>
                                <div class="form-group">
                                    <h3 class="text-center">Permissions</h3>

                                    <input type="checkbox" id="client_permission" name="client_permission" value="1" checked>
                                    <label for="client_permission">Client</label><br>

                                    <input type="checkbox" id="production_permission" name="production_permission" value="1" checked>
                                    <label for="production_permission">Production</label><br>

                                    <input type="checkbox" id="search_permission" name="search_permission" value="1" checked>
                                    <label for="search_permission">Search</label><br>

                                    <input type="checkbox" id="petty_permission" name="cash_permission" value="1" checked>
                                    <label for="petty_permission">Petty Cash</label>

                                </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" title="Add Officer" class="btn btn-primary">Send</button>
                            </form>
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