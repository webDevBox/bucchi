@extends('layouts.app')
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

.input-field.error {
  border-color: red;
}

.input-field.error::placeholder {
  color: red;
}

.payment_deleter{
    margin-top: 24px;
}
#outfits-list {
  list-style: none;
  padding: 0;
}

/* Style each list item */
#outfits-list li {
  background-color: #f9eaea;
  padding: 10px;
  margin: 5px;
  border-radius: 5px;
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
  font-family: Arial, sans-serif;
  color: #333;
}

/* Add a hover effect to highlight the list items */
#outfits-list li:hover {
  background-color: #fff0f0;
  cursor: pointer;
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
                            <div class="label text-muted">Notes</div>
                        </a>
                    </li>
                    <!-- step 5 -->
                    <li class="form-stepper-unfinished text-center form-stepper-list" step="5">
                        <a class="mx-2">
                            <span class="form-stepper-circle text-muted">
                                <span>5</span>
                            </span>
                            <div class="label text-muted">Overview</div>
                        </a>
                    </li>
                </ul>
                <!-- Step Wise Form Content -->
                <form action="#" id="userAccountSetupForm" name="userAccountSetupForm" enctype="multipart/form-data" method="POST">
                    <!-- Step 1 Content -->
                    <section id="step-1" class="form-step">
                        <h2 class="font-normal">Client Details</h2>
                        <!-- Step 1 input fields -->
                        <div class="mt-3 offset-3">
                            <div class="form-group">
                            
                                <label class="col-md-12  h5  control-label" for="product_description">Select Client</label>
                        
                                <div class="col-md-9">
                        
                                    <select class="form-control" id="client_select" name="client_select" required>
                        
                                        <option selected disabled >Select Any Client</option>
                                        <option value="..other..">Add New Client</option>
                                        <option value="John">John</option>
                                        <option value="Morder">Morder</option>
                                        <option value="Jack">Jack</option>
                                        <option value="Nick">Nick</option>
                                    </select>
                                @if ($errors->has('client_select')) <p style="color:red;">{{ $errors->first('client_select') }}</p> @endif 
                                </div>
                                </div>
                                <br>
                            <div class="form-group d-none" id="client_new">
            
                                <label class="col-md-12 h5 control-label" for="client_name">Client Name</label>
                            
                                <div class="col-md-9">
                            
                                <input type="text" id="client_name" name="client_name" class="form-control" placeholder="Enter Client name.." required>
                            
                                @if ($errors->has('client_name')) <p style="color:red;">{{ $errors->first('client_name') }}</p> @endif 
                            
                                </div>
                            
                                </div>
                
                                    <br>
                
                                    <div class="form-group">
                            
                                        <label class="col-md-12 h5 control-label" for="client_name">Client Contact No</label>
                                    
                                        <div class="col-md-9">
                                    
                                        <input type="number" id="client_contact" name="contact" class="form-control" placeholder="Enter Client Contact Number.." required>
                                    
                                        @if ($errors->has('contact')) <p style="color:red;">{{ $errors->first('contact') }}</p> @endif 
                                    
                                        </div>
                                    
                                        </div>
                                        <br>
                                        <div class="form-group">
                            
                                        <label class="col-md-12 h5 control-label" for="client_name">Client Email</label>
                                    
                                        <div class="col-md-9">
                                    
                                        <input type="email" id="client_email" name="email" class="form-control" placeholder="Enter Client Email Address.." required>
                                    
                                        @if ($errors->has('client_email')) <p style="color:red;">{{ $errors->first('client_email') }}</p> @endif 
                                    
                                        </div>
                                    
                                        </div>
                        </div>
                        <div class="mt-3">
                            <button class="button " type="button" onclick="createClient(2)" step_number="2">Next</button>
                        </div>
                    </section>
                    <!-- Step 2 Content, default hidden on page load. -->
                    <section id="step-2" class="form-step d-none">
                        <h2 class="font-normal">Order Details</h2>
                        <!-- Step 2 input fields -->
                        <div class="mt-3 offset-3">
                            <div class="form-group">
                            
                                <label class="col-md-12 h5 control-label" for="order_delivery">Delivery</label>

                                <div class="col-md-9">
                            
                                    <input type="text" id="order_delivery" name="delivery" class="form-control" placeholder="Enter Delivery" required>
                            
                                </div>
                            
                            </div>
                            <br>
                            <div class="form-group">
                            
                                <label class="col-md-12 h5 control-label" for="order_date">Completion Date (Internal)</label>

                                <div class="col-md-9">
                            
                                    <input type="date" id="order_date" name="delivery_date" class="form-control" placeholder="Enter Delivery Date" required>
                            
                                </div>
                            
                            </div>
                            
                            <br>

                            <div class="form-group">
                            
                                <label class="col-md-12  h5  control-label" for="product_description">Select Currency</label>
                        
                                <div class="col-md-9">
                        
                                    <select class="form-control" id="currency_select" name="" required>
                                        <option selected disabled>Select Currency</option>
                                        <option value="..other..">Add Other Currency</option>
                                        @foreach ($currencies as $curreny)
                                            <option value="{{ $curreny->name }}">{{ $curreny->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                </div>
                                <br>
                            <div class="form-group d-none" id="currency_div">
                            
                                <label class="col-md-12 h5 control-label" for="order_currency ">Enter Currency</label>

                                <div class="col-md-9">
                            
                                    <input type="text" id="order_currency" name="order_currency" class="form-control" placeholder="Enter Currency Name" required>
                                    <small id="currency_error" style="color: red" class="d-none">Please Enter Currency</small>
                                </div>
                            
                            </div>
                        </div>
                        <div class="mt-3">
                            <button class="button btn-navigate-form-step" type="button" step_number="1">Prev</button>
                            <button class="button " onclick="addOrderDetails(3)" type="button" step_number="3">Next</button>
                        </div>
                    </section>
                    <!-- Step 3 Content, default hidden on page load. -->
                    <section id="step-3" class="form-step d-none">
                        <h2 class="font-normal">Outfit Details</h2>
                        <!-- Step 3 input fields -->
                        <div class="mt-3">
                            <div id="block-container">
                                <div class="block">
                                    <div class="row">
                                        <h3 class="mt-2 ml-2">1</h3>
                                        <div class="col-md-11 col-sm-12">
                                            <label for="outName">Outfit Name</label>
                                            <input type="text" id="outName" class="input-field" placeholder="Enter Outfit name..">
                                        </div>
                                    </div>
                                    <label for="outDetail">Outfit Description</label>
                                    <textarea name="" id="outDetail" class="input-field" rows="3" id="" placeholder="Enter Outfit Description.." cols="30" rows="10"></textarea>
                                    <div class="row">
                                        <div class="col-md-3 col-sm-12">
                                            <label for="price">Price</label>
                                            <input type="number" id="price" class="input-field" placeholder="Enter Price..">
                                        </div>
                                        
                                        <div class="col-md-3 offset-md-1 col-sm-12">
                                            <label for="hours">Hours</label>
                                            <input type="number" id="hours" class="input-field" placeholder="Enter Hours..">
                                        </div>
                                        
                                        <div class="col-md-3 offset-md-1 col-sm-12">
                                            <label for="fabric">Fabric</label>
                                            <input type="number" id="fabric" class="input-field" placeholder="Enter Fabric..">
                                        </div>
                                    </div>
                                  
                                  <div class="button-block">
                                    <button class="move-up">Up</button>
                                    <button class="move-down">Down</button>
                                    <button class="delete">Delete</button>
                                  </div>
                                </div>
                              </div>
                              <button class="button" id="add-block">Add Outfit</button>
                        </div>
                        <div class="mt-3">
                            <button class="button btn-navigate-form-step" type="button" step_number="2">Prev</button>
                            <button id="submit-button" class="button " type="button" step_number="4">Next</button>
                        </div>
                    </section>
                    <!-- Step 4 Content, default hidden on page load. -->
                    <section id="step-4" class="form-step d-none">
                        <h2 class="font-normal">Notes</h2>
                        <!-- Step 3 input fields -->
                        <div class="mt-3">
                            <h3 class="text-center">Total Price: <strong id="total-price"></strong></h3>
                            <hr>
                            <button class="btn btn-primary" id="depositButton">Add Payment</button>
                            <br>
                            <div id="paymentAdder" class="row d-none">
                                <div class="col-md-5 col-sm-12">
                                    <label for="price">Add Payment</label>
                                    <input type="number" onkeyup="checkDepositAmout()" id="initial_deposit" name="" class="form-control" placeholder="Enter Amount..">
                                    <small id="depositError" class="d-none" style="color: red">Deposit amount should not more than total order amount</small>
                                </div>
                                <div class="col-md-5 col-sm-12">
                                    <label for="price">Payment Date</label>
                                    <input type="date" name="" class="form-control" id="date_deposit">
                                </div>
                                <div class="col-md-2 col-sm-12">
                                    <button onclick="delPayment()" class="btn btn-danger payment_deleter"><i class="fa fa-trash"></i></button>
                                </div>
                            </div>
                            <label for="notes">Additional Notes</label>
                            <textarea name="" id="notes" rows="5" class="form-control" placeholder="Enter Additional Notes.."></textarea>
                        </div>
                        <div class="mt-3">
                            <button class="button btn-navigate-form-step" type="button" step_number="3">Prev</button>
                            <button class="button" onclick="makeOverview(5)" type="button" step_number="5">Next</button>
                        </div>
                    </section>
                    <!-- step 5-->
                    <section id="step-5" class="form-step d-none">
                        <h2 class="font-normal">Overview</h2>
                        <div class="mt-3">
                            <div id="invoice_order">
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
                                        <p>Completion Date (Internal): <strong id="order_date_over"></strong></p>
                                        <p>Currency: <strong id="order_currency_over"></strong></p>
                                    </div>
                                    <div class="col-12 border border-success rounded my-2">
                                        <h2 class="text-center">Outfits</h2>
                                        <div id="outfits-list"></div>
                                    </div>
                                    <div class="col-md-5 col-sm-12 border border-success rounded my-2">
                                        <h2 class="text-center">Notes</h2>
                                        <p id="notes_over"></p>
                                    </div>
                                    <div class="col-md-5 offset-md-2 col-sm-12 border border-success rounded my-2">
                                        <h2 class="text-center">Payments</h2>
                                        
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                        <div class="mt-3">
                            <button class="final_order_button button btn-navigate-form-step" type="button" step_number="4">Prev</button>
                            <button class="final_order_button button submit-btn" id="submit-btn" type="#">Add Order and Create Invoice</button>
                            <button class="order_re_create d-none button submit-btn" onclick="window.location.href = '{{ route('createOrder') }}'">Create New Order</button>
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
    var baseUrl = "{{ url('/') }}"
    var orderId = 0
    var total = 0
    var checker = 0
</script>
<script src="{{ asset('app-assets/js/formObj.js')}}"></script>
<script src="{{ asset('app-assets/js/multi-form.js')}}"></script>
<script src="{{ asset('app-assets/js/form.js')}}"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.22/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
<script src="{{ asset('app-assets/js/custom.js')}}"></script>

@endsection