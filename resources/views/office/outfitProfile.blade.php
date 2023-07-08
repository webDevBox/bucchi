@extends('layouts.office')
@section('style')
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
            <h1> <strong> Outfit </strong> Profile</h1>
            <div id="multi-step-form-container">
                <!-- Form Steps / Progress Bar -->
                <ul class="form-stepper form-stepper-horizontal text-center mx-auto pl-0">
                    <!-- Step 1 -->
                    <li class="form-stepper-active text-center form-stepper-list" step="1">
                        <a class="mx-2">
                            <span class="form-stepper-circle">
                                <span>1</span>
                            </span>
                            <div class="label">Material</div>
                        </a>
                    </li>
                    <li class="form-stepper-unfinished text-center form-stepper-list" step="2">
                        <a class="mx-2">
                            <span class="form-stepper-circle text-muted">
                                <span>2</span>
                            </span>
                            <div class="label text-muted">Status</div>
                        </a>
                    </li>
                </ul>
                <!-- Step Wise Form Content -->
                <form id="userAccountSetupForm" name="userAccountSetupForm" enctype="multipart/form-data" method="POST">
                    <!-- Step 1 Content -->
                    <section id="step-1" class="form-step">
                      <h2 class="font-normal">Order Details</h2>
                      <div class="row border rounded my-2">
                        <div class="col-4">
                          <p class="text-center">
                            Client Name
                          </p>
                          <h3 class="text-center">John</h3>
                        </div>
                        <div class="col-4">
                          <p class="text-center">
                            Outfit Name
                          </p>
                          <h3 class="text-center">Fit Me</h3>
                        </div>
                        <div class="col-4">
                          <p class="text-center">
                            Completion Date 
                          </p>
                          <h3 class="text-center">2 July 2023</h3>
                        </div>
                        <div class="col-12 mt-3">
                          <h3>Description</h3>
                          <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Atque natus rem, accusantium laborum quibusdam minus iure velit veritatis praesentium. Maiores ipsa minus fuga porro? Dignissimos, veritatis! Unde ut mollitia asperiores?</p>
                        </div>
                      </div>
                        <h2 class="font-normal">Material Details</h2>
                        <!-- Step 1 input fields -->
                        <div class="container border mt-2">
                          <h3 for="">Voice Notes</h3>
                          <div class="d-flex">
                            <button href="javascript:void(0)" class="btn btn-primary mx-auto" id="recordButton">Record</button>
                            <button href="javascript:void(0)" class="d-none btn btn-primary mx-auto" id="stopButton" disabled>Stop</button>
                          </div>
                          
                          <ul id="audioList" style="list-style: none;"></ul>
                          <h3>Images</h3>
                          <div id="imager" class="bg-light d-flex mx-auto mt-2" style="cursor: pointer; min-height: 100px; width: 100%;">
                                <h1 class="mx-auto" style="padding-top:30px;">Select Multiple Images</h1>
                                
                                <div class="gallery"></div>
                            </div>
                            <input type="file" class="d-none" multiple id="gallery-photo-add">

                          </div>
                            <div class="mt-3">
                              <label for="notes">Additional Notes</label>
                              <textarea name="" id="notes" rows="5" class="form-control" placeholder="Enter Additional Notes.."></textarea>
                          </div>
                        
                        <div class="mt-3">
                            <button class="button btn-navigate-form-step" type="button" step_number="2">Next</button>
                        </div>
                    </section>
                    <section id="step-2" class="form-step d-none">
                      <h2 class="font-normal text-center">Status Details</h2>
                      <label class="h3" for="article">Article#</label>
                      <input type="number" placeholder="Enter Article Number.." name="" class="col-4 form-control" id="article">
                        <!-- Step 3 input fields -->

                        
                          <h3 class="mt-3">Select Status</h3>
                          <div class="row">
                            <input type="radio" onchange="confirmation('Fabric')" id="fabric" name="outfitStatus" class="">
                            <label class="h5" style="margin-top: 5px; margin-left:5px;" for="fabric">Fabric</label>
                          </div>
                          <div class="row">
                            <input type="radio" onchange="confirmation('Dying')" id="Dying" name="outfitStatus" class="">
                            <label class="h5" style="margin-top: 5px; margin-left:5px;" for="Dying">Dying</label>
                          </div>
                          <div class="row">
                            <input type="radio" onchange="confirmation('Embr In')" id="EmbrIn" name="outfitStatus" class="">
                            <label class="h5" style="margin-top: 5px; margin-left:5px;" for="EmbrIn">Embr In</label>
                          </div>
                          <div class="row">
                            <input type="radio" onchange="confirmation('Embr Out')" id="EmbrOut" name="outfitStatus" class="">
                            <label class="h5" style="margin-top: 5px; margin-left:5px;" for="EmbrOut">Embr Out</label>
                          </div>
                          <div class="row">
                            <input type="radio" onchange="confirmation('Tailor In')" id="TailorIn" name="outfitStatus" class="">
                            <label class="h5" style="margin-top: 5px; margin-left:5px;" for="TailorIn">Tailor In</label>
                          </div>
                          <div class="row">
                            <input type="radio" onchange="confirmation('Tailor Out')" id="TailorOut" name="outfitStatus" class="">
                            <label class="h5" style="margin-top: 5px; margin-left:5px;" for="TailorOut">Tailor Out</label>
                          </div>
                          <div class="row">
                            <input type="radio" onchange="confirmation('Checking')" id="Checking" name="outfitStatus" class="">
                            <label class="h5" style="margin-top: 5px; margin-left:5px;" for="Checking">Checking</label>
                          </div>
                          <div class="row">
                            <input type="radio" onchange="confirmation('Photo')" id="Photo" name="outfitStatus" class="">
                            <label class="h5" style="margin-top: 5px; margin-left:5px;" for="Photo">Photo</label>
                          </div>
                          <div id="photo-block" class="d-none">
                            <h3>Select Photos</h3>
                          <div id="photos-picker" class="bg-light d-flex mx-auto mt-2" style="cursor: pointer; min-height: 100px; width: 800px;">
                                <h1 class="mx-auto" style="padding-top:30px;">Select Multiple Images</h1>
                                
                                <div class="status-gallery"></div>
                            </div>
                            <input type="file" class="d-none" multiple id="status-photo-add">

                          </div>
                          <div class="row">
                            <input type="radio" onchange="confirmation('Packing')" id="Packing" name="outfitStatus" class="">
                            <label class="h5" style="margin-top: 5px; margin-left:5px;" for="Packing">Packing</label>
                          </div>
                          <div class="row">
                            <input type="radio" onchange="confirmation('Completed')" id="Completed" name="outfitStatus" class="">
                            <label class="h5" style="margin-top: 5px; margin-left:5px;" for="Completed">Completed</label>
                          </div>
                        
                        <div class="mt-3">
                            <button class="button btn-navigate-form-step" type="button" step_number="1">Prev</button>
                            <button class="button submit-btn" type="#">Update</button>
                        </div>
                    </section>
                </form>
            </div>
        </div>


    </div>
</div>
</div>
@endsection

@section('scripts')

<script>
  function confirmation(status)
  {
    let text = `Are you sure you want change outfit status to ${status}`;
        if (confirm(text) == true) {
          if(status === 'Photo')
          {
            $('#photo-block').removeClass('d-none')
          }
        } else {
            text = "You canceled!";
        }
  }
</script>
    
<script src="{{ asset('app-assets/js/multi-form.js')}}"></script>
<script src="{{ asset('app-assets/js/notes.js')}}"></script>
<script src="{{ asset('app-assets/js/multi-image.js')}}"></script>
<script src="{{ asset('app-assets/js/multi-status-photos.js')}}"></script>

@endsection