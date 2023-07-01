@extends('layouts.app')
@section('style')
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/multi-form.css')}}">
{{-- <style>
     .item {
      margin-bottom: 20px;
      border: 1px solid #ccc;
      padding: 10px;
      position: relative;
      overflow: hidden;
      transition: all 0.3s ease;
    }

    .item:hover {
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
    }

    .item label {
      display: inline-block;
      width: 100px;
      font-weight: bold;
    }

    .item input {
      margin-bottom: 5px;
      width: 200px;
    }

    .item .item-actions {
      position: absolute;
      top: 10px;
      right: 10px;
      display: flex;
      align-items: center;
      gap: 5px;
      opacity: 0;
      transition: opacity 0.3s ease;
    }

    .item:hover .item-actions {
      opacity: 1;
    }

    .item .item-actions button {
      padding: 5px 10px;
      background-color: #ff4444;
      color: #fff;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }

    #itemizedPart {
      margin-bottom: 20px;
    }

    #itemizedPart::after {
      content: "";
      display: table;
      clear: both;
    }

    .item-move-btn {
      display: inline-block;
      margin-right: 5px;
      padding: 3px 8px;
      background-color: #333;
      color: #fff;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }

    .item-move-btn:hover {
      background-color: #555;
    }
</style> --}}
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
                    <!-- Step 2 -->
                    <li class="form-stepper-unfinished text-center form-stepper-list" step="2">
                        <a class="mx-2">
                            <span class="form-stepper-circle text-muted">
                                <span>2</span>
                            </span>
                            <div class="label text-muted">Notes</div>
                        </a>
                    </li>
                    <!-- Step 3 -->
                    <li class="form-stepper-unfinished text-center form-stepper-list" step="3">
                        <a class="mx-2">
                            <span class="form-stepper-circle text-muted">
                                <span>3</span>
                            </span>
                            <div class="label text-muted">Status</div>
                        </a>
                    </li>
                </ul>
                <!-- Step Wise Form Content -->
                <form id="userAccountSetupForm" name="userAccountSetupForm" enctype="multipart/form-data" method="POST">
                    <!-- Step 1 Content -->
                    <section id="step-1" class="form-step">
                        <h2 class="font-normal">Material Details</h2>
                        <!-- Step 1 input fields -->
                        
                            <div id="imager" class="bg-light d-flex mx-auto" style="cursor: pointer; min-height: 100px; width: 800px;">
                                <h1 class="mx-auto" style="padding-top:30px;">Select Multiple Images</h1>
                                
                                <div class="gallery"></div>
                            </div>
                            <input type="file" class="d-none" multiple id="gallery-photo-add">
                        
                        <div class="mt-3">
                            <button class="button btn-navigate-form-step" type="button" step_number="2">Next</button>
                        </div>
                    </section>
                    <!-- Step 2 Content, default hidden on page load. -->
                    <section id="step-2" class="form-step d-none">
                        <h2 class="font-normal">Notes</h2>
                        <!-- Step 2 input fields -->
                        <div class="mt-3">
                            <label for="notes">Additional Notes</label>
                            <textarea name="" id="notes" rows="5" class="form-control" placeholder="Enter Additional Notes.."></textarea>
                            <br>
                            <label for="">Voice Note</label><br>
                            <a href="#" class="btn btn-primary" id="recordButton">Record</a>
                            <a href="#" class="d-none btn btn-primary" id="stopButton" disabled>Stop</a>
                            <br /><br>
                            <audio id="audioPlayer" class="d-none" controls></audio>

                        </div>
                        <div class="mt-3">
                            <button class="button btn-navigate-form-step" type="button" step_number="1">Prev</button>
                            <button class="button btn-navigate-form-step" type="button" step_number="3">Next</button>
                        </div>
                    </section>
                    <!-- Step 3 Content, default hidden on page load. -->
                    <section id="step-3" class="form-step d-none">
                        <h2 class="font-normal">Outfit Details</h2>
                        <!-- Step 3 input fields -->
                        <div class="mt-3">
                            
                            <div id="block-container">
                                <div class="block">
                                  <input type="number" class="input-field" placeholder="Enter Item #">
                                  <input type="text" class="input-field" placeholder="Enter Outfit name..">
                                  <textarea name="" class="input-field" rows="3" id="" placeholder="Enter Outfit Description.." cols="30" rows="10"></textarea>
                                 

                                  <div class="row offset-2">
                                    <div class="col-5">
                                        <label for="price">Price</label>
                                        <input type="number" id="price" class="input-field" placeholder="Enter Price..">
                                    </div>
                                    
                                    <div class="col-5">
                                        <label for="hours">Hours</label>
                                        <input type="number" id="hours" class="input-field" placeholder="Enter Hours..">
                                    </div>
                                    </div>
                                  
                                  <div class="button-block">
                                    <button class="move-up">Move Up</button>
                                    <button class="move-down">Move Down</button>
                                    <button class="delete">Delete Outfit</button>
                                  </div>
                                </div>
                              </div>
                              <button class="button" id="add-block">Add Outfit</button>
                        </div>
                        <div class="mt-3">
                            <button class="button btn-navigate-form-step" type="button" step_number="2">Prev</button>
                            <button class="button btn-navigate-form-step" type="button" step_number="4">Next</button>
                        </div>
                    </section>
                    <!-- Step 4 Content, default hidden on page load. -->
                    <section id="step-4" class="form-step d-none">
                        <h2 class="font-normal">Overview</h2>
                        <!-- Step 3 input fields -->
                        <div class="mt-3">
                            <h3 class="text-center">Total Price: <strong>150$</strong></h3>
                            <hr>
                            <label for="notes">Additional Notes</label>
                            <textarea name="" id="notes" rows="5" class="form-control" placeholder="Enter Additional Notes.."></textarea>
                        </div>
                        <div class="mt-3">
                            <button class="button btn-navigate-form-step" type="button" step_number="3">Prev</button>
                            <button class="button submit-btn" type="#">Save</button>
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
    let stream;
    let mediaRecorder;
    const recordButton = document.getElementById('recordButton');
    const stopButton = document.getElementById('stopButton');
    const audioPlayer = document.getElementById('audioPlayer');

    recordButton.addEventListener('click', startRecording);
    stopButton.addEventListener('click', stopRecording);

    function startRecording() {
        $('#stopButton').removeClass('d-none')
        $('#recordButton').addClass('d-none')
        
      navigator.mediaDevices.getUserMedia({ audio: true })
        .then((stream) => {
          recordButton.disabled = true;
          stopButton.disabled = false;

          mediaRecorder = new MediaRecorder(stream);
          mediaRecorder.start();

          const chunks = [];
          mediaRecorder.addEventListener('dataavailable', (event) => {
            chunks.push(event.data);
          });

          mediaRecorder.addEventListener('stop', () => {
            const blob = new Blob(chunks, { type: 'audio/ogg; codecs=opus' });
            const audioURL = URL.createObjectURL(blob);
            audioPlayer.src = audioURL;
          });
        })
        .catch((error) => {
          console.error('Error accessing the microphone:', error);
        });
    }

    function stopRecording() {
        $('#stopButton').addClass('d-none')
        $('#recordButton').removeClass('d-none')
        $('#audioPlayer').removeClass('d-none')
      recordButton.disabled = false;
      stopButton.disabled = true;

      mediaRecorder.stop();
      stream.getTracks().forEach((track) => track.stop());
    }
  </script>


    <script>
       $(function() {
    // Multiple images preview in browser
    var imagesPreview = function(input, placeToInsertImagePreview) {
        if (input.files) {
            var filesAmount = input.files.length;

            for (i = 0; i < filesAmount; i++) {
                var reader = new FileReader();

                reader.onload = function(event) {
                    var img = new Image();
                    img.src = event.target.result;

                    img.onload = function() {
                        // Create a canvas element
                        var canvas = document.createElement('canvas');
                        var ctx = canvas.getContext('2d');

                        // Set the desired width and height for the preview image
                        var maxWidth = 100; // Set your desired maximum width
                        var maxHeight = 100; // Set your desired maximum height
                        var width = img.width;
                        var height = img.height;

                        // Calculate the aspect ratio to maintain the image's original proportions
                        var aspectRatio = width / height;

                        // Adjust width and height if necessary to fit within the maximum dimensions
                        if (width > maxWidth) {
                            width = maxWidth;
                            height = width / aspectRatio;
                        }

                        if (height > maxHeight) {
                            height = maxHeight;
                            width = height * aspectRatio;
                        }

                        // Set the canvas size to the adjusted width and height
                        canvas.width = width;
                        canvas.height = height;

                        // Draw the image on the canvas
                        ctx.drawImage(img, 0, 0, width, height);

                        // Create a new image element with the resized image data
                        var resizedImage = new Image();
                        resizedImage.src = canvas.toDataURL('image/jpeg');

                        // Apply CSS styling to the resized image
                        resizedImage.style.marginRight = '10px'; // Set the desired spacing between images 

                        // Append the resized image to the preview container
                        $(placeToInsertImagePreview).append(resizedImage);
                    };
                };

                reader.readAsDataURL(input.files[i]);
            }
        }
    };

    $('#gallery-photo-add').on('change', function() {
        imagesPreview(this, 'div.gallery');
    });
});


    $("#imager").click(function(){
        $("#gallery-photo-add").click();
    })

    </script>

<script src="{{ asset('app-assets/js/multi-form.js')}}"></script>
{{-- <script src="{{ asset('app-assets/js/formItemAnimation.js')}}"></script> --}}
{{-- <script src="{{ asset('app-assets/js/form.js')}}"></script> --}}

@endsection