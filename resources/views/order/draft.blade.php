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
                                    <div class="block full p-2">
                                        <table id="ecom-orders"
                                            class="table table-bordered table-striped table-vcenter">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">Client Name</th>
                                                    <th class="text-center">Delivery Date</th>
                                                    <th class="text-center">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($orders as $order)
                                                <tr>
                                                    <td class="text-center">{{ $order->client->name }}</td>
                                                    <td class="text-center">{{ $order->completion_date }}</td>

                                                    <td class="text-center">
                                                        <div class="btn-group btn-group-xs">
                                                            <a href="#" id="editor_{{ $order->id }}" onclick="editConfirmation({{ $order->id }})"
                                                                title="Edit" class="btn btn-primary"><i
                                                                    class="fa fa-pencil"></i></a>
                                                            <a href="#" id="deleter_{{ $order->id }}"
                                                                onclick="deleteOrder({{ $order->id }})"
                                                                title="Delete Order" class="btn btn-danger"><i
                                                                    class="fa fa-trash"></i></a>
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
            <!-- Dashboard Ecommerce ends -->

        </div>
    </div>
</div>

@endsection

@section('scripts')
<script src="{{ asset('app-assets/js/updateOutfit.js')}}"></script>
<script>
    var baseUrl = "{{ url('/') }}"
    $(document).ready(function() {
    $('#ecom-orders').DataTable({
        // Replace "1" with the index of the column you want to make orderable (in this case, it's the second column, so index 1)
        "order": [[1, "asc"]],
        "columnDefs": [
            {
                // Disable ordering for the last column (Action column)
                "targets": [2],
                "orderable": false
            }
        ],
        "lengthMenu": [10, 25, 50, 100, 500, 1000],
    });
});
</script>
<script>
    function deleteOrder(id)
    {
        let text = "Are you sure you want to Delete the Order?";
        if (confirm(text) == true) {
            var url = baseUrl + "/admin/order/delete/"+id;
            $.ajax({
            url: url,
            type: "GET",
            data: {
                id: id
            },
            success: async function(response) {
                if(response.success)
                {
                    $(`#deleter_${id}`).attr('disabled',true)
                    $(`#deleter_${id}`).attr('onclick',false)
                    
                    $(`#editor_${id}`).attr('disabled',true)
                    $(`#editor_${id}`).attr('onclick',false)

                    $(`#deleter_${id}`).attr('class','btn btn-dark')
                    $(`#editor_${id}`).attr('class','btn btn-dark')
                }
            },
            error: function(xhr, status, error) {
            // Handle the error response
            }
            })
        }
    }

    
    function editConfirmation(id) {
        // let text = "Are you sure you want to edit the invoice?";
        // if (confirm(text) == true) {
            let url = "{{ route('orderUpdate', ['id' => ':id']) }}";
            url = url.replace(':id', id);
            window.location.href = url;
        // } else {
        //     text = "You canceled!";
        // }
    }
    
    function sendProduction(id,article,name) {
        let text = `Send Article # ${article}, Outfit Name ${name} for production?`;
        if (confirm(text) == true) {
            updateOutfitProduction(id)
        } else {
            text = "You canceled!";
        }
    }

    function updateOutfitProduction(id)
    {
        var url = baseUrl + "/admin/order/production/outfit";
        $.ajax({
        url: url,
        type: "GET",
        data: {
            id: id
        },
        success: async function(response) {
            if(response.ok)
            {
                $(`#button_${id}`).attr('disabled',true)
                $(`#button_${id}`).attr('class','btn btn-dark')
                $(`#button_${id}`).attr('onclick',false)
                $(`#button_${id}`).attr('title','In Production')
            }
        },
        error: function(xhr, status, error) {
          // Handle the error response
        }
        })
    }
</script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.22/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js">
</script>
@endsection