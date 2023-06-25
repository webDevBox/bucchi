@extends('layouts.app')
@section('style')
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/multi-form.css')}}">
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
            <h1> <strong> Create New </strong> Order</h1>
            <div id="multi-step-form-container">
                <!-- Form Steps / Progress Bar -->
                <ul class="form-stepper form-stepper-horizontal text-center mx-auto pl-0">
                    <!-- Step 1 -->
                    <li class="form-stepper-active text-center form-stepper-list" step="1">
                        <a class="mx-2">
                            <span class="form-stepper-circle">
                                <span>1</span>
                            </span>
                            <div class="label">Client Details</div>
                        </a>
                    </li>
                    <!-- Step 2 -->
                    <li class="form-stepper-unfinished text-center form-stepper-list" step="2">
                        <a class="mx-2">
                            <span class="form-stepper-circle text-muted">
                                <span>2</span>
                            </span>
                            <div class="label text-muted">Order Details</div>
                        </a>
                    </li>
                    <!-- Step 3 -->
                    <li class="form-stepper-unfinished text-center form-stepper-list" step="3">
                        <a class="mx-2">
                            <span class="form-stepper-circle text-muted">
                                <span>3</span>
                            </span>
                            <div class="label text-muted">Outfit Details</div>
                        </a>
                    </li>
                    <!-- Step 4 -->
                    <li class="form-stepper-unfinished text-center form-stepper-list" step="4">
                        <a class="mx-2">
                            <span class="form-stepper-circle text-muted">
                                <span>4</span>
                            </span>
                            <div class="label text-muted">Overview</div>
                        </a>
                    </li>
                </ul>
                <!-- Step Wise Form Content -->
                <form id="userAccountSetupForm" name="userAccountSetupForm" enctype="multipart/form-data" method="POST">
                    <!-- Step 1 Content -->
                    <section id="step-1" class="form-step">
                        <h2 class="font-normal">Client Details</h2>
                        <!-- Step 1 input fields -->
                        <div class="mt-3 offset-3">
                            <div class="form-group">
            
                                <label class="col-md-12 h5 control-label" for="client_name">Client Name</label>
                            
                                <div class="col-md-9">
                            
                                <input type="text" id="client_name"  value="{{ old('client_name') }}" name="client_name" class="form-control" placeholder="Enter Client name.." required>
                            
                                @if ($errors->has('client_name')) <p style="color:red;">{{ $errors->first('client_name') }}</p> @endif 
                            
                                </div>
                            
                                </div>
                            
                                <br>
                    
                                <div class="form-group">
                            
                                    <label class="col-md-12  h5  control-label" for="product_description">Select Previous Client</label>
                            
                                    <div class="col-md-9">
                            
                                        <select class="form-control" id="client_select" name="client_select" required>
                            
                                            <option selected disabled >Select Any Client</option>
                                            <option value="John">John</option>
                                            <option value="Morder">Morder</option>
                                            <option value="Jack">Jack</option>
                                            <option value="Nick">Nick</option>
                                        </select>
                            
                                    @if ($errors->has('client_select')) <p style="color:red;">{{ $errors->first('client_select') }}</p> @endif 
                            
                                    
                            
                                    </div>
                            
                                    </div>
                
                                    <br>
                
                                    <div class="form-group">
                            
                                        <label class="col-md-12 h5 control-label" for="client_name">Client Contact No</label>
                                    
                                        <div class="col-md-9">
                                    
                                        <input type="number" id="client_contact"  value="{{ old('client_contact') }}" name="client_contact" class="form-control" placeholder="Enter Client Contact Number.." required>
                                    
                                        @if ($errors->has('client_contact')) <p style="color:red;">{{ $errors->first('client_contact') }}</p> @endif 
                                    
                                        </div>
                                    
                                        </div>
                                        <br>
                                        <div class="form-group">
                            
                                        <label class="col-md-12 h5 control-label" for="client_name">Client Email</label>
                                    
                                        <div class="col-md-9">
                                    
                                        <input type="email" id="client_email"  value="{{ old('client_email') }}" name="client_contact" class="form-control" placeholder="Enter Client Email Address.." required>
                                    
                                        @if ($errors->has('client_email')) <p style="color:red;">{{ $errors->first('client_email') }}</p> @endif 
                                    
                                        </div>
                                    
                                        </div>
                        </div>
                        <div class="mt-3">
                            <button class="button btn-navigate-form-step" type="button" step_number="2">Next</button>
                        </div>
                    </section>
                    <!-- Step 2 Content, default hidden on page load. -->
                    <section id="step-2" class="form-step d-none">
                        <h2 class="font-normal">Order Details</h2>
                        <!-- Step 2 input fields -->
                        <div class="mt-3">
                            Step 2 input fields goes here..
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
                            Step 3 input fields goes here..
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
                            Step 3 input fields goes here..
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
        $('#client_select').change(function(){
            var client = $('#client_select').val()
            $('#client_name').val(client)
        })
    </script>

<script src="{{ asset('app-assets/js/multi-form.js')}}"></script>

@endsection