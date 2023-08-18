<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Bucchi's</title>
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
                        <table style="width: 100%; border-collapse: collapse;">
                            <tr>
                                <td style="width: 20%; padding: 10px; border: 1px solid #000;">
                                    <strong style="display: block; text-align: center;">Invoice#</strong>
                                    <p style="display: block; text-align: center; margin: 0;">{{ $order->invoice }}</p>
                                </td>
                                <td style="width: 20%; padding: 10px; border: 1px solid #000;">
                                    <strong style="display: block; text-align: center;">Client</strong>
                                    <p style="display: block; text-align: center; margin: 0;">{{ $order->client_name }}</p>
                                </td>
                                <td style="width: 20%; padding: 10px; border: 1px solid #000;">
                                    <strong style="display: block; text-align: center;">Delivery</strong>
                                    <p style="display: block; text-align: center; margin: 0;">{{ $order->delivery }}</p>
                                </td>
                                <td style="width: 20%; padding: 10px; border: 1px solid #000;">
                                    <strong style="display: block; text-align: center;">Currency</strong>
                                    <p style="display: block; text-align: center; margin: 0;">{{ $order->currency }}</p>
                                </td>
                                <td style="width: 20%; padding: 10px; border: 1px solid #000;">
                                    <strong style="display: block; text-align: center;">Notes</strong>
                                    <p style="display: block; text-align: center; margin: 0;">{{ $order->notes }}</p>
                                </td>
                            </tr>
                        </table>                        
                        
                        <h4 class="text-center">Outfits</h4>
                        <table class="table" id="invoice_outfits">
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
                        <div class="row">
                            <div class="offset-9 col-3 mt-2">
                                <strong> Outfits Total: <span class="ml-1" id="invoice_outfit_total">{{ $order->outfits->sum('price') }}</span> </strong>
                            </div>
                            <div class="offset-9 col-3">
                                <h6> Shipping Cost: <span class="ml-1" id="invoice_shipping">{{ $order->shipping_cost }}</span> </h6>
                            </div>
                            <div class="offset-9 col-3 mt-2">
                                <strong> Order Total: <span class="ml-1" id="invoice_order_total">{{ $order->outfits->sum('price') + $order->shipping_cost }}</span> </strong>
                            </div>
                        </div>
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
                                <strong>Remaining Balance: <span id="invoice_balance_total">{{ ($order->outfits->sum('price') + $order->shipping_cost) - $order->transactions->sum('payment') }}</span></strong>
                            </div>
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
