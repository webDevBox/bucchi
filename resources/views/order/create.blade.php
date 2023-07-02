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
                            
                                <label class="col-md-12  h5  control-label" for="product_description">Select Client</label>
                        
                                <div class="col-md-9">
                        
                                    <select class="form-control" id="client_select" name="client_select" required>
                        
                                        <option selected disabled >Select Any Client</option>
                                        <option value="John">John</option>
                                        <option value="Morder">Morder</option>
                                        <option value="Jack">Jack</option>
                                        <option value="Nick">Nick</option>
                                        <option value="..other..">Add New Client</option>
                                    </select>
                                @if ($errors->has('client_select')) <p style="color:red;">{{ $errors->first('client_select') }}</p> @endif 
                                </div>
                                </div>
                                <br>
                            <div class="form-group d-none" id="client_new">
            
                                <label class="col-md-12 h5 control-label" for="client_name">Client Name</label>
                            
                                <div class="col-md-9">
                            
                                <input type="text" id="client_name"  value="{{ old('client_name') }}" name="client_name" class="form-control" placeholder="Enter Client name.." required>
                            
                                @if ($errors->has('client_name')) <p style="color:red;">{{ $errors->first('client_name') }}</p> @endif 
                            
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
                        <div class="mt-3 offset-3">
                            <div class="form-group">
                            
                                <label class="col-md-12 h5 control-label" for="order_delivery">Delivery</label>

                                <div class="col-md-9">
                            
                                    <input type="text" id="order_delivery"  value="{{ old('delivery') }}" name="delivery" class="form-control" placeholder="Enter Delivery" required>
                                
                                    @if ($errors->has('delivery')) <p style="color:red;">{{ $errors->first('delivery') }}</p> @endif 
                            
                                </div>
                            
                            </div>
                            <br>
                            <div class="form-group">
                            
                                <label class="col-md-12 h5 control-label" for="order_date">Delivery Date</label>

                                <div class="col-md-9">
                            
                                    <input type="date" id="order_date"  value="{{ old('order_date') }}" name="delivery_date" class="form-control" placeholder="Enter Delivery Date" required>
                                
                                    @if ($errors->has('delivery_date')) <p style="color:red;">{{ $errors->first('delivery_date') }}</p> @endif 
                            
                                </div>
                            
                            </div>
                            
                            <br>

                            <div class="form-group">
                            
                                <label class="col-md-12  h5  control-label" for="product_description">Select Currency</label>
                        
                                <div class="col-md-9">
                        
                                    <select class="form-control" id="currency_select" name="" required>
                        
                                        <option selected disabled >Select Currency</option>
                                        <option value="PKR">PKR</option>
                                        <option value="USD">USD</option>
                                        <option value="GBP">GBP</option>
                                        <option value="EUR">EUR</option>
                                        <option value="CAD">CAD</option>
                                        <option value="AUD">AUD</option>
                                        <option value="..other..">Add Other Currency</option>
                                    </select>
                                {{-- @if ($errors->has('client_select')) <p style="color:red;">{{ $errors->first('client_select') }}</p> @endif  --}}
                                </div>
                                </div>
                                <br>
                            <div class="form-group d-none" id="currency_div">
                            
                                <label class="col-md-12 h5 control-label" for="order_currency ">Enter Currency</label>

                                <div class="col-md-9">
                            
                                    <input type="text" id="order_currency"  value="{{ old('order_currency') }}" name="order_currency" class="form-control" placeholder="Enter Currency Name" required>
                                
                                    @if ($errors->has('order_currency')) <p style="color:red;">{{ $errors->first('order_currency') }}</p> @endif 
                            
                                </div>
                            
                            </div>
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
                            {{-- <div id="itemizedPart">
                                <div class="item">
                                  <label>Item #: </label>
                                  <input type="number" name="itemNumber" class="form-control item-number">
                                  <br>
                                  <label>Outfit Name: </label>
                                  <input type="text" name="outfitName" class="form-control outfit-name">
                                  <br>
                                  <label>Outfit Description: </label>
                                  <input type="text" name="outfitDescription" class="form-control outfit-description">
                                  <br>
                                  <label>Price: </label>
                                  <input type="number" name="price" class="form-control price">
                                  <br>
                                  <label>Hours: </label>
                                  <input type="number" name="hours" class="form-control hours">
                                  <br>
                                  <div class="item-actions">
                                    <button class="delete-item">Delete</button>
                                    <button class="move-up item-move-btn">Move Up</button>
                                    <button class="move-down item-move-btn">Move Down</button>
                                  </div>
                                </div>
                            </div> --}}
                            <div id="block-container">
                                <div class="block">
                                  <input type="number" class="input-field" placeholder="Enter Item #">
                                  <input type="text" class="input-field" placeholder="Enter Outfit name..">
                                  <textarea name="" class="input-field" rows="3" id="" placeholder="Enter Outfit Description.." cols="30" rows="10"></textarea>
                                  {{-- <input type="text" class="input-field" placeholder="Enter Outfit Description.."> --}}
                                  {{-- <div class="d-flex">
                                    
                                        <label for="">Price</label>
                                        <input type="number" class="input-field" placeholder="Enter Price..">
                                    
                                        <label for="">Hours</label>
                                        <input type="number" class="input-field" placeholder="Enter Hours..">
                                    
                                  </div> --}}

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
                            <label for="price">Add Deposit</label>
                            <input type="number" name="" class="form-control" value="70" placeholder="Enter Deposit Amount..">
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
        $('#client_select').change(function(){
            var client = $('#client_select').val()
            if(client === '..other..')
            {
                $('#client_name').val('');
                $('#client_new').removeClass('d-none');
                
            }
            else
            {
                $('#client_name').val(client)
            }
        })
        
        $('#currency_select').change(function(){
            var currency = $('#currency_select').val();
            if(currency === '..other..')
            {
                $('#order_currency').val('');
                $('#currency_div').removeClass('d-none');
                
            }
            else
            {
                $('#order_currency').val(currency);
            }
        })

    </script>

<script src="{{ asset('app-assets/js/multi-form.js')}}"></script>
{{-- <script src="{{ asset('app-assets/js/formItemAnimation.js')}}"></script> --}}
<script src="{{ asset('app-assets/js/form.js')}}"></script>

@endsection