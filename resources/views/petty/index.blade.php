@extends('layouts.office')

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
                                            <div class="col-md-10 col-sm-12">
                                                <button data-toggle="modal" data-target="#myModal8"
                                                    class="btn btn-primary">Add New Petty Cash</button>
                                            </div>
                                            <div class="col-md-2 col-sm-12">
                                                <span class="badge badge-primary" >Your Balance: {{ auth()->user()->balance }}</span>
                                            </div>
                                        </div>
                                        <table id="clients_directory"
                                            class="table table-bordered table-striped table-vcenter">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">Entry Type</th>
                                                    <th class="text-center">Expense Type</th>
                                                    <th class="text-center">Particular</th>
                                                    <th class="text-center">Weight</th>
                                                    <th class="text-center">Amount</th>
                                                    <th class="text-center">Date</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($petty as $cash)
                                                <tr>
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
                            <h5 class="modal-title">Add New Transaction</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="{{ route('createPetty') }}">
                                @csrf
                                <div class="form-group">
                                    <Label for="client_name">Entry Type</Label>
                                    <select onchange="checkEntry()" id="entry_block" name="entry_type" class="form-control">
                                        <option selected disabled>Select Entry Type</option>
                                        <option value="Payment">Payment</option>
                                        <option value="Received">Received</option>
                                    </select>
                                </div>
                                <div id="expense_block" class="form-group d-none">
                                    <Label>Expense Type</Label>
                                    <select name="expense_type" class="form-control">
                                        <option selected disabled>Select Expense Type</option>
                                        <option value="Dabka - BD">Dabka - BD</option>
                                        <option value="Dabka - Collar">Dabka - Collar</option>
                                        <option value="Dabka - Sherwani">Dabka - Sherwani</option>
                                        <option value="Dabka - White">Dabka - White</option>
                                        <option value="Resham - Anchor">Resham - Anchor</option>
                                        <option value="Betki">Betki</option>
                                        <option value="Gota">Gota</option>
                                        <option value="Other">Other</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <Label for="client_file">Particular</Label>
                                    <input type="text" name="particular" id="client_file" class="form-control"
                                        placeholder="Enter Particular...">
                                </div>
                                <div class="form-group">
                                    <Label>Weight(Kg)</Label>
                                    <input type="number" name="weight" class="form-control"
                                        placeholder="Enter Weight...">
                                </div>
                                <div class="form-group">
                                    <Label>Amount</Label>
                                    <input type="number" name="amount" class="form-control"
                                        placeholder="Enter Amount..." required>
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
    function checkEntry()
    {
        var entry = $('#entry_block').val()
        if(entry === 'Payment')
        {
            $('#expense_block').removeClass('d-none')
        }
        else
        {
            $('#expense_block').addClass('d-none')
        }
    }
</script>
<script>
    var baseUrl = "{{ url('/') }}"
    $(document).ready(function() {
    $('#clients_directory').DataTable({
        // Replace "1" with the index of the column you want to make orderable (in this case, it's the second column, so index 1)
        "order": [],
        "columnDefs": [
            {
                "targets": "_all",
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