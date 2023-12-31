@extends('layouts.app')

@section('style')

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
                                        <button onclick="reporter()" class="d-block ml-auto btn btn-primary">Download Petty Cash Report</button>
                                        <table id="pettyCashTable" class="table table-bordered table-striped table-vcenter">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">Entry Type</th>
                                                    <th class="text-center">Expense Type</th>
                                                    <th class="text-center">Particular</th>
                                                    <th class="text-center">Weight</th>
                                                    <th class="text-center">Amount</th>
                                                    <th class="text-center">Date</th>
                                                    <th class="text-center">Created By</th>
                                                    <th class="text-center">Balance</th>
                                                    <th class="text-center">Action</th>
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
                                                    <td class="text-center">{{ $cash->user->name }}</td>
                                                    <td class="text-center">{{ $cash->remaining }}</td>
                                                    <td class="text-center">
                                                        <div class="btn-group btn-group-xs">
                                                            
                                                            <a href="{{ route('pettyDelete',['id' => $cash->id]) }}"
                                                                onclick="return confirm('Are you sure you want to Delete Transaction')"
                                                                class="btn btn-danger">
                                                                <i class="fa fa-trash"></i>
                                                            </a>
                                                        </div>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        <table id="hidden_table" class="d-none table table-bordered table-striped table-vcenter">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">Entry Type</th>
                                                    <th class="text-center">Expense Type</th>
                                                    <th class="text-center">Particular</th>
                                                    <th class="text-center">Weight</th>
                                                    <th class="text-center">Amount</th>
                                                    <th class="text-center">Date</th>
                                                    <th class="text-center">Created By</th>
                                                    <th class="text-center">Balance</th>
                                                    <th class="text-center">Action</th>
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
                                                    <td class="text-center">{{ $cash->user->name }}</td>
                                                    <td class="text-center">{{ $cash->remaining }}</td>
                                                    <td class="text-center">
                                                        <div class="btn-group btn-group-xs">
                                                            
                                                            <a href="{{ route('pettyDelete',['id' => $cash->id]) }}"
                                                                onclick="return confirm('Are you sure you want to Delete Transaction')"
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.3.1/jspdf.umd.min.js"></script>
  
<script>
    var baseUrl = "{{ url('/') }}"
    $(document).ready(function() {
    $('#pettyCashTable').DataTable({
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
<script src="{{ asset('app-assets/js/excelTable.js')}}"></script>

@endsection