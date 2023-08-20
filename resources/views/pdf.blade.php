<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Bucchi's</title>
    <style>
        h4{
            font-family: Arial, Helvetica, sans-serif;
            font-size: 13
        }
        strong{
            font-size: 8
        }
        p{
            font-size: 6
        }
        th{
            font-size: 8
        }
        td{
            font-size: 8;
            max-width: 200px
        }
        b{
            font-size: 9
        }
        .ship-span{
            font-weight: lighter;
            font-size: 7
        }
        .right-span{
            position: absolute;
            right: 50
        }
    </style>
</head>
<body>
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
    
                <div style="background-color: white;">
                    <div id="invoice_data" class="mt-3">
                        <center><img src="app-assets/images/logo/logo.png" width="200" height="150"></center>
                        <h4 class="text-center">Order Details</h4>
                        <table style="width: 100%;">
                            <tr>
                                <td style="width: 20%; padding: 10px; border: 1px solid #9e9e9e;">
                                    <strong style="display: block; text-align: center;">Invoice#</strong>
                                    <p style="display: block; text-align: center; margin: 0;">{{ $order->invoice }}</p>
                                </td>
                                <td style="width: 20%; padding: 10px; border: 1px solid #9e9e9e;">
                                    <strong style="display: block; text-align: center;">Client</strong>
                                    <p style="display: block; text-align: center; margin: 0;">{{ $order->client_name }}</p>
                                </td>
                                <td style="width: 20%; padding: 10px; border: 1px solid #9e9e9e;">
                                    <strong style="display: block; text-align: center;">Delivery</strong>
                                    <p style="display: block; text-align: center; margin: 0;">{{ $order->delivery }}</p>
                                </td>
                                <td style="width: 20%; padding: 10px; border: 1px solid #9e9e9e;">
                                    <strong style="display: block; text-align: center;">Currency</strong>
                                    <p style="display: block; text-align: center; margin: 0;">{{ $order->currency }}</p>
                                </td>
                            </tr>
                        </table>                        
                        
                        <h4 class="text-center mt-2">Outfits</h4>
                        <table class="table table-strip" id="invoice_outfits">
                            <thead>
                                <tr style="height: 20px">
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($order->outfits as $outfit)
                                    <tr>
                                        <td>{{ $outfit->name }}</td>
                                        <td>{{ $outfit->description }}</td>
                                        <td>{{ $outfit->price }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <hr>
                        <div class="row">
                            <div class="offset-9 col-3 mt-2">
                                <b class="" > Outfits Total: </b><span class="right-span">{{ $order->outfits->sum('price') }}</span>
                            </div>
                            <div class="offset-9 col-3">
                                <b class="ship-span"> Shipping Cost: </b><span class="right-span">{{ $order->shipping_cost }}</span>
                            </div>
                            <div class="offset-9 col-3 mt-2">
                                <b class=""> Order Total: </b><span class="right-span">{{ $order->outfits->sum('price') + $order->shipping_cost }}</span>
                            </div>
                        </div>
                        <hr>
                        <h4 class="text-center">Payments</h4>
                        <table class="table" id="invoice_outfits">
                            <thead>
                                <tr style="height: 20px">
                                    <th>Amount</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($order->transactions->count() > 0)
                                    @foreach ($order->transactions as $transaction)
                                        <tr>
                                            <td>{{ $transaction->payment }}</td>
                                            <td>{{ $transaction->date }}</td>
                                        </tr>
                                    @endforeach
                                @else
                                        <tr>
                                            <td colspan="2">No Initial Payment</td>
                                        </tr>
                                @endif
                            </tbody>
                        </table>
                        <div class="row mt-2">
                            <div class="offset-8 col-4 mt-2">
                                <b style="margin-left: 30px">Remaining Balance: </b><span class="right-span">{{ ($order->outfits->sum('price') + $order->shipping_cost) - $order->transactions->sum('payment') }}</span>
                            </div>
                        </div>
                        <h4 class="text-center">Additional Notes</h4>
                        <div class="border p-2">
                           <p>{{ $order->notes }}</p> 
                        </div>
                    </div>
                </div>
    
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>
