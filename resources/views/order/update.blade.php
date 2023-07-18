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
                                <input type="number" class="d-none" value="{{ $order->id }}" id="order_id_update">
                                <label class="col-md-12 h5 control-label" for="client_name">Client Name</label>
                            
                                <div class="col-md-9">
                            
                                <input type="text" id="client_name" class="form-control" value="{{ $order->client->name }}" disabled>
                                </div>
                            
                                </div>
                
                                    <br>
                
                                    <div class="form-group">
                            
                                        <label class="col-md-12 h5 control-label" for="client_name">Client Contact No</label>
                                    
                                        <div class="col-md-9">
                                    
                                        <input type="number" id="client_contact" value="{{ $order->client->contact }}" class="form-control" disabled>
                                    
                                        </div>
                                    
                                        </div>
                                        <br>
                                        <div class="form-group">
                            
                                        <label class="col-md-12 h5 control-label" for="client_name">Client Email</label>
                                    
                                        <div class="col-md-9">
                                    
                                        <input type="email" id="client_email" value="{{ $order->client->email }}" class="form-control" disabled>
                                        </div>
                                    
                                        </div>
                        </div>
                        <div class="mt-3">
                            <button class="button " type="button" onclick="navigateToFormStep(2)" step_number="2">Next</button>
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
                            
                                    <input type="text" id="order_delivery" value="{{ $order->delivery }}" name="delivery" class="form-control" placeholder="Enter Delivery" required>
                            
                                </div>
                            
                            </div>
                            <br>
                            <div class="form-group">
                            
                                <label class="col-md-12 h5 control-label" for="order_date">Completion Date (Internal)</label>

                                <div class="col-md-9">
                            
                                    <input type="date" id="order_date" name="delivery_date" value="{{ $order->completion_date }}" class="form-control" placeholder="Enter Delivery Date" required>
                            
                                </div>
                            
                            </div>
                            
                            <br>

                            <div class="form-group">
                            
                                <label class="col-md-12  h5  control-label" for="product_description">Select Currency</label>
                        
                                <div class="col-md-9">
                        
                                    <select class="form-control" id="currency_select" name="" required>
                                        <option value="..other..">Add Other Currency</option>
                                        @foreach ($currencies as $curreny)
                                            <option @if($order->currency == $curreny->name) selected @endif value="{{ $curreny->name }}">{{ $curreny->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                </div>
                                <br>
                            <div class="form-group d-none" id="currency_div">
                            
                                <label class="col-md-12 h5 control-label" for="order_currency ">Enter Currency</label>

                                <div class="col-md-9">
                            
                                    <input type="text" id="order_currency" name="order_currency" class="form-control" value="{{ $order->currency }}" placeholder="Enter Currency Name" required>
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
                                @foreach ($order->outfits as $outfit)
                                    <div class="block">
                                        <div class="row">
                                            <h3 class="mt-2 ml-2">{{ $counter++ }}</h3>
                                            <div class="col-md-11 col-sm-12">
                                                <label for="outName">Outfit Name</label>
                                                <input type="text" id="outName" value={{ $outfit->name }} class="input-field" placeholder="Enter Outfit name..">
                                            </div>
                                        </div>
                                        <label for="outDetail">Outfit Description</label>
                                        <textarea name="" id="outDetail" class="input-field" rows="3" id="" placeholder="Enter Outfit Description.." cols="30" rows="10">{{ $outfit->description }}</textarea>
                                        <div class="row">
                                            <div class="col-md-3 col-sm-12">
                                                <label for="price">Price</label>
                                                <input type="number" id="price" class="input-field" value="{{ $outfit->price }}" placeholder="Enter Price..">
                                            </div>
                                            
                                            <div class="col-md-3 offset-md-1 col-sm-12">
                                                <label for="hours">Hours</label>
                                                <input type="number" id="hours" value="{{ $outfit->hours }}" class="input-field" placeholder="Enter Hours..">
                                            </div>
                                            
                                            <div class="col-md-3 offset-md-1 col-sm-12">
                                                <label for="fabric">Fabric</label>
                                                <input type="number" id="fabric" class="input-field" value="{{ $outfit->fabric }}" placeholder="Enter Fabric..">
                                            </div>
                                        </div>
                                        <div class="button-block">
                                            <button class="move-up">Up</button>
                                            <button class="move-down">Down</button>
                                            <button class="delete">Delete</button>
                                        </div>
                                    </div>
                                @endforeach
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
                            <div id="transactions_list">
                                @foreach ($order->transactions as $transaction)
                                    <div class="row">
                                        <div class="col-md-6 col-sm-12">
                                            <label for="price">Payment Amount</label>
                                            <input type="text" value="{{ $transaction->payment }}" class="prev_transactions form-control" disabled>
                                        </div>
                                        <div class="col-md-6 col-sm-12">
                                            <label for="price">Payment Date</label>
                                            <input type="text" value="{{ $transaction->date }}" disabled class="form-control">
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <button class="btn btn-primary mt-2" id="depositButton">Add Payment</button>
                            <br>
                            <div id="paymentAdder" class="row d-none">
                                <div class="col-md-5 col-sm-12">
                                    <label for="price">Add Payment</label>
                                    <input type="number" onkeyup="checkDepositAmout()" id="initial_deposit" name="" class="form-control" placeholder="Enter Amount..">
                                    <small id="depositError" class="d-none" style="color: red">Deposit amount should not more than total order total amount</small>
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
                            <textarea name="" id="notes" rows="5" class="form-control" placeholder="Enter Additional Notes..">{{ $order->notes }}</textarea>
                        </div>
                        <div class="mt-3">
                            <button class="button btn-navigate-form-step" type="button" step_number="3">Prev</button>
                            <button class="button" onclick="updateNotes(5)" type="button" step_number="5">Next</button>
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
                            <button class="button btn-navigate-form-step" type="button" step_number="4">Prev</button>
                            <button class="button submit-btn" id="submit-btn" type="#">Download Invoice</button>
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
    var baseUrl = "{{ url('/') }}";
    var orderId = $('#order_id_update').val();
    var total = 0
    var remaining = 0
    var checker = 0
</script>
<script src="{{ asset('app-assets/js/formObj.js')}}"></script>
<script src="{{ asset('app-assets/js/multi-form.js')}}"></script>
<script src="{{ asset('app-assets/js/form.js')}}"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.22/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
<script src="{{ asset('app-assets/js/custom.js')}}"></script>

@endsection