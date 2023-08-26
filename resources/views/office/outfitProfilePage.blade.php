@extends('layouts.office')
@section('style')
<style>
    .image-container {
    width: 100%;
    height: 100%;
    background-repeat: no-repeat;
    background-size: cover;
    position: relative;
    cursor: pointer;
  }

  .image-container .btn {
    position: absolute;
    bottom: 5px;
    right: 5px;
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
        <h1 class="text-center">Outfit Details</h1>
        <div class="row p-2">
            {{-- <div class="rounded box-shadow col-md-5 col-sm-12">
                <h2 class="text-center">Client Details</h2>
                <p>Name: <strong> John </strong></p>
                <p>Contact No: <strong> +92 300 00000000 </strong></p>
                <p>Email: <strong> John@gmail.com </strong></p>
            </div>
            <div class="rounded box-shadow offset-md-1 col-md-5 col-sm-12">
                <h2 class="text-center">Order Details</h2>
                <p>Delivery: <strong> Deliveru soon </strong></p>
                <p>Delivery Date: <strong> 25 june 2023 </strong></p>
                <p>Currency: <strong> PKR </strong></p>
            </div> --}}
            <div class="rounded box-shadow offset-md-2 col-md-8 col-sm-12">
                <h2 class="text-center">Outfit Status</h2>
                <div class="row">
                    @foreach ($outfit->statuses as $status)
                        <div class="col-md-9 col-sm-12 mt-1">
                            {{ $status->status }}
                            @if($status->status == 'Photo')
                                <i class="fa fa-arrow-down" id="image-section-opener" style="color: #6610F2; cursor: pointer"></i>
                            @endif
                        </div>
                        <div class="col-md-3 col-sm-12 mt-1">
                            <span class="badge badge-primary">
                                {{ $status->date_time }}
                            </span>
                        </div>
                        @if($status->status == 'Photo')
                            <div id="image-section" class="col-12 d-none">
                                <div class="row">
                                    @foreach ($outfit->notes->where('type',0)->where('image_type',1) as $image)
                                        <div class="col-md-2 col-sm-4 col-xs-4 mt-1" onclick="showModal('{{ $image->id }}', '{{ asset("files/".$image->file) }}')">
                                            <div class="image-container" style="background-image: url('{{ asset("files/".$image->file) }}');
                                                height: 100px; width: 100px;">
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            @endif
                    @endforeach
                </div>
                
            </div>
            <div class="rounded box-shadow offset-md-2 col-md-8 col-sm-12">
                {{-- <h2 class="text-center">Outfit Details</h2> --}}
                <p>Outfit Name: <strong> {{ $outfit->name }} </strong></p>
                <p>Client Name: <strong> {{ $outfit->order->client->name }} </strong></p>
                <p>Delivery Date: <strong> {{ $outfit->order->completion_date }} </strong></p>
                <p>Outfit Description: <strong> {{ $outfit->description }} </strong></p>
                {{-- <p>Outfit Price: <strong> {{ $outfit->price }} </strong></p> --}}
                <p>Hours: <strong> {{ $outfit->hours }} </strong></p>
                
            </div>
        </div>
    </div>
    </div>
    </div>

    <div class="modal fade" id="imageModal" tabindex="-1" role="dialog">
        <div class="modal-lg modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Image Preview</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <img src="" alt="Image" class="img-fluid" id="modalImage">
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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
<script>
    function showModal(id,imageUrl) {
      $('#modalImage').attr('src', imageUrl);
      $('#imageModal').modal('show');
    }
    
    $('#image-section-opener').click(function(){
        if($('#image-section-opener').hasClass('fa-arrow-down'))
        {
            $('#image-section-opener').removeClass('fa-arrow-down')
            $('#image-section-opener').addClass('fa-arrow-up')
        }
        else{
            $('#image-section-opener').addClass('fa-arrow-down')
            $('#image-section-opener').removeClass('fa-arrow-up')
        }


        if($('#image-section').hasClass('d-none'))
        {
            $('#image-section').removeClass('d-none')
        }
        else{
            $('#image-section').addClass('d-none')
        }
    })
  </script>
    
@endsection