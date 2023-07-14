document.getElementById("submit-btn").addEventListener("click", (event) => {
    event.preventDefault();
    completeOrder();
    createPDF()
  });

//   function createPDF() {
//     setTimeout(function() {
//         html2canvas(document.getElementById('invoice_order'), {
//           onrendered: function(canvas) {
//             var data = canvas.toDataURL();
//             var docDefinition = {
//               content: [{
//                 image: data,
//                 width: 500
//               }]
//             };
//             pdfMake.createPdf(docDefinition).download("Order.pdf");
//           }
//         });
//       }, 500);
//     }

function getInvoice(order)
{
    var url = baseUrl + "/admin/order/byId";
    $.ajax({
        url: url,
        type: "GET",
        data: {
            order: order
        },
        success: async function(response) {
            if(response.success)
            {
                await makeInvoicer(response.data)
                createPDF()
            }
        },
        error: function(xhr, status, error) {
          // Handle the error response
        }
      });
    // $('#invoice_order').removeClass('d-none')
    
    // $('#invoice_order').addClass('d-none')
}

function makeInvoicer(data){
    $('#client_name_over').html(data.client.name)
    $('#client_phone_over').html(data.client.contact)
    $('#client_email_over').html(data.client.email)

    $('#order_delivery_over').html(data.delivery)
    $('#order_date_over').html(data.completion_date)
    $('#order_currency_over').html(data.currency)
    
    $('#notes_over').html(data.notes)

    const outfitsList = document.getElementById("outfits-list")
    outfitsList.innerHTML = ""
    const blockObjects = data.outfits
    for (let i = 0; i < blockObjects.length; i++) {
        const item = blockObjects[i];
        const listItem = document.createElement("li");
        listItem.textContent = `Item# ${item.itemNumber} - Name: ${item.outfitName} - Price: $${item.price}
         - Hours: ${item.hours} - fabric: ${item.fabric}`;
        outfitsList.appendChild(listItem);
    }
}

  function createPDF()
  {
    var doc = new jsPDF();
  var elementHtml = $("#invoice_order").html();
  
  doc.fromHTML(elementHtml, 15, 15, {
    'width': 170
  });

  doc.save("order.pdf");
  }

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

function makeOverview(){
    $('#client_name_over').html($('#client_name').val())
    $('#client_phone_over').html($('#client_contact').val())
    $('#client_email_over').html($('#client_email').val())

    $('#order_delivery_over').html($('#order_delivery').val())
    $('#order_date_over').html($('#order_date').val())
    $('#order_currency_over').html($('#order_currency').val())
    
    $('#notes_over').html($('#notes').val())

    const outfitsList = document.getElementById("outfits-list")
    outfitsList.innerHTML = ""

    for (let i = 0; i < blockObjects.length; i++) {
        const item = blockObjects[i];
        const listItem = document.createElement("li");
        listItem.textContent = `Item# ${item.itemNumber} - Name: ${item.outfitName} - Price: $${item.price}
         - Hours: ${item.hours} - fabric: ${item.fabric}`;
        outfitsList.appendChild(listItem);
    }


}

function addOrderDetails(step)
{
    if(step === 5)
        makeOverview()
        
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
    $('#depositError').addClass('d-none')
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
                    '👋 Order Created',
                    {
                        closeButton: true,
                        tapToDismiss: false
                    }
                    );
                }, 10000);
                $('.final_order_button').addClass('d-none')
                $('.order_re_create').removeClass('d-none')
                
            }
            else{
                setTimeout(function () {
                    toastr['error'](
                        'Please try again',
                    'Some thing wrong!',
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

function delPayment()
{
    if(confirm("Are you sure you want to delete payment?"))
    {
        $('#initial_deposit').val('')
        $('#date_deposit').val('')
        $('#paymentAdder').addClass('d-none')
        $('#depositButton').removeClass('d-none')
        $('#depositError').addClass('d-none')
    }
}

function checkDepositAmout()
{
    var value = $('#initial_deposit').val()
    if(value > total)
    {
        $('#depositError').removeClass('d-none')
        $('#initial_deposit').val(total)
    }
    else
    {
        $('#depositError').addClass('d-none')
    }
}