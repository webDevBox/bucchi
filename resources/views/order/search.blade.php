@extends('layouts.app')
@section('style')
    <style>
        .table-body tr td {
            text-align: center;
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
    <!-- Dashboard Ecommerce Starts -->
    <section id="dashboard-ecommerce">
    
    <div class="row match-height">
    <!-- Company Table Card -->
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="card card-company-table">
    <div class="card-body p-0">
    <div class="table-responsive">
        <div class="block full p-2">
            {{-- <input type="text" class="form-control" id="searchInput" placeholder="Search..."> --}}
            <table id="ecom-orders" class="table table-bordered table-striped table-vcenter">
                <thead>
                <tr>
                <th class="text-center">Client Name</th>
                <th class="text-center">Delivery Date</th>
                <th class="text-center">Cost</th>
                <th class="text-center">Download PDF</th>
                <th class="text-center">Article</th>
                </tr>
                </thead>
                <tbody class="table-body">
                    {{-- @foreach ($orders as $order)
                        <tr>
                            <td class="text-center"> 
                                <a href="#" data-toggle="modal" data-target="#myModal8" data-order-id="{{ $order->id }}" > {{ $order->client->name }} </a>
                            </td>
                            <td class="text-center">{{ $order->completion_date }}</td>
                            <td class="text-center"> {{ $order->outfits->pluck('price')->sum() }} </td>
                            <td class="text-center">
                                <a href="{{ route('generatePDF',['id' => $order->id]) }}" data-toggle="tooltip" title="Download PDF" class="btn btn-success"><i class="fa fa-download"></i></a>
                            </td>
                        </tr>
                    @endforeach --}}
                </tbody>
                </table>

            </div>
    </div>
    {{-- <div id="invoice_order" class="d-none">
        <div class="row">
            <div class="col-md-5 col-sm-12 border border-success rounded my-2">
                <h2 class="text-center">Client Details</h2>
                <p>Name: <strong id="client_name_over"></strong></p>
                <p>Phone: <strong id="client_phone_over"></strong></p>
                <p>Email: <strong id="client_email_over"></strong></p>
            </div>
            <div class="col-md-5 offset-md-2 col-sm-12 border border-success rounded my-2">
                <h2 class="text-center">Order Details</h2>
                <p>Delivery: <strong id="order_delivery_over"></strong></p>
                <p>Completion Date: <strong id="order_date_over"></strong></p>
                <p>Currency: <strong id="order_currency_over"></strong></p>
            </div>
            <div class="col-md-5 col-sm-12 border border-success rounded my-2">
                <h2 class="text-center">Notes</h2>
                <p id="notes_over"></p>
            </div>
            <div class="col-md-5 offset-md-2 col-sm-12 border border-success rounded my-2">
                <h2 class="text-center">Outfits</h2>
                <div id="outfits-list"></div>
            </div>
        </div>
    </div> --}}
    </div>
    </div>
    </div>
    
    </div>
    </section>
    
    </div>
    </div>
    </div>
    @component('components.outfitModal', ['modalId' => 'myModal', 'modalTitle' => 'Outfits']) @endcomponent
    
@endsection

@section('scripts')
<script>
    var baseUrl = "{{ url('/') }}";
//     $(document).ready(function() {
//     $('#ecom-orders').DataTable({
//         // Replace "1" with the index of the column you want to make orderable (in this case, it's the second column, so index 1)
//         "order": [[1, "asc"]],
//         "columnDefs": [
//             {
//                 // Disable ordering for the last column (Action column)
//                 "targets": [3],
//                 "orderable": false
//             }
//         ],
//         "lengthMenu": [10, 25, 50, 100, 500, 1000],
//     });
// });


$(function () {
      
      var table = $('#ecom-orders').DataTable({
          processing: true,
          serverSide: true,
          columnDefs: [
                {
                    targets: -1,
                    visible: false
                }
            ],
          ajax: "{{ route('searchOrder') }}",
          columns: [
              {data: 'name', name: 'name'},
              {data: 'date', name: 'date'},
              {data: 'cost', name: 'cost'},
              {data: 'download', name: 'download', orderable: false, searchable: false},
              {data: 'article', name: 'article'},
          ]
      });
        
    });

</script>
{{-- <script src="{{ asset('app-assets/js/search.js')}}"></script> --}}
<script src="{{ asset('app-assets/js/outfitModal.js')}}"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.22/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
<script src="{{ asset('app-assets/js/custom.js')}}"></script>
    
@endsection