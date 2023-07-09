document.getElementById("submit-btn").addEventListener("click", (event) => {
    event.preventDefault();
    completeOrder();
  });

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

document.getElementById("depositButton").addEventListener("click", (event) => {
    event.preventDefault();
    $('#paymentAdder').removeClass('d-none')
    $('#depositButton').addClass('d-none')
  });




function createClient(step)
{
    var url = baseUrl + "/admin/order/storeClient";
    $.ajax({
        url: url,
        type: "GET",
        data: {
            client_name: $('#client_name').val(),
            contact: $('#client_contact').val(),
            email: $('#client_email').val()
        },
        success: function(response) {
            if(response.success)
            {
                orderId = response.data.id
                navigateToFormStep(step)
            }
        },
        error: function(xhr, status, error) {
          // Handle the error response
        }
      });
}

function addOrderDetails(step)
{
    var url = baseUrl + "/admin/order/storeOrder";
    $.ajax({
        url: url,
        type: "GET",
        data: {
            order: orderId,
            delivery: $('#order_delivery').val(),
            completionDate: $('#order_date').val(),
            currency: $('#order_currency').val()
        },
        success: function(response) {
            if(response.success)
            {
                orderId = response.data.id
                navigateToFormStep(step)
            }
        },
        error: function(xhr, status, error) {
          // Handle the error response
        }
      });
}

function createOutfits(step)
{
    $('#total-price').text(total+'$')
    var url = baseUrl + "/admin/order/storeOutfits";
    $.ajax({
        url: url,
        type: "GET",
        data: {
            order:orderId,
            outfitsObj: blockObjects
        },
        success: function(response) {
            if(response.success)
            {
                navigateToFormStep(step)
            }
        },
        error: function(xhr, status, error) {
          // Handle the error response
        }
      });
}

function completeOrder()
{
    var url = baseUrl + "/admin/order/completeOrder";
    $.ajax({
        url: url,
        type: "GET",
        data: {
            order:orderId,
            payment: $('#initial_deposit').val(),
            date: $('#date_deposit').val(),
            notes: $('#notes').val()
        },
        success: function(response) {
            if(response.success)
            {
                setTimeout(function () {
                    toastr['success'](
                        '',
                    '👋 Order Completed',
                    {
                        closeButton: true,
                        tapToDismiss: false
                    }
                    );
                }, 2000);
            }
        },
        error: function(xhr, status, error) {
          // Handle the error response
        }
      });
}