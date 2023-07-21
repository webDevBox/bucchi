document.getElementById("submit-btn").addEventListener("click", (event) => {
    event.preventDefault();
    completeOrder();
    createPDF()
  });

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

function makeOverview(step){
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
        // listItem.textContent = `Item# ${item.itemNumber} - Name: ${item.outfitName} - Price: $${item.price}
        //  - Hours: ${item.hours} - fabric: ${item.fabric}`;
        listItem.innerHTML = `
        <div class="row">
            <div class="col-12">Item# <strong>${item.itemNumber}</strong></div>
            <div class="col-md-6 col-sm-12">Name <strong>${item.outfitName}</strong></div>
            <div class="col-md-6 col-sm-12">Price <strong>$${item.price}</strong></div>
            <div class="col-md-6 col-sm-12">Hours <strong>${item.hours}</strong></div>
            <div class="col-md-6 col-sm-12">Fabric <strong>${item.fabric}</strong></div>
        </div>
        `
        outfitsList.appendChild(listItem);
    }
    navigateToFormStep(step)
}

function createClient(step)
{
    if($('#client_name').val() === '')
    {
        $('#client_select_error').removeClass('d-none')
    }
    else{
        $('#client_select_error').addClass('d-none')
    if(orderId === 0)
    {
        var url = baseUrl + "/admin/order/storeClient";
        $.ajax({
            url: url,
            type: "GET",
            data: {
                selectedOptionId: $("#client_select option:selected").attr("id"),
                client_name: $('#client_name').val(),
                select: $('#client_select').val(),
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
      })
    }
    else
    {
        navigateToFormStep(step)
    }
    }
}

function updateNotes(step)
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
                if(response.transaction)
                {
                    appendPaymentRow()   
                }
                $('#initial_deposit').val('')
                $('#date_deposit').val('')
                $('#paymentAdder').addClass('d-none')
                $('#depositButton').removeClass('d-none')
                $('#depositError').addClass('d-none')
                makeOverview(step)
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

function appendPaymentRow()
{
    var amount = $('#initial_deposit').val()
    var date = $('#date_deposit').val()
    const transactionsListDiv = document.getElementById("transactions_list");
        const newRowHTML = `
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <label for="price">Payment Amount</label>
                    <input type="text" value="${amount}" class="prev_transactions form-control" disabled>
                </div>
                <div class="col-md-6 col-sm-12">
                    <label for="price">Payment Date</label>
                    <input type="text" value="${date}" disabled class="form-control">
                </div>
            </div>
        `;

        // Append the new row div to the transactions_list div
        transactionsListDiv.insertAdjacentHTML("beforeend", newRowHTML);
}

function addOrderDetails(step)
{
    if($('#order_currency').val() === '')
    {
        $('#currency_error').removeClass('d-none')
        $('#delivery_error').addClass('d-none')
        $('#completion_date_error').addClass('d-none')
    }
    else if($('#order_delivery').val() === '')
    {
        $('#delivery_error').removeClass('d-none')
        $('#currency_error').addClass('d-none')
        $('#completion_date_error').addClass('d-none')
    }
    else if($('#order_date').val() === '')
    {
        $('#delivery_error').addClass('d-none')
        $('#currency_error').addClass('d-none')
        $('#completion_date_error').removeClass('d-none')
    }
    else
    {
        $('#delivery_error').addClass('d-none')
        $('#completion_date_error').addClass('d-none')
        $('#currency_error').addClass('d-none')
        $('#currency_div').addClass('d-none')
    var url = baseUrl + "/admin/order/storeOrder";
    $.ajax({
        url: url,
        type: "GET",
        data: {
            order: orderId,
            delivery: $('#order_delivery').val(),
            completionDate: $('#order_date').val(),
            currency: $('#order_currency').val(),
            selected: $('#currency_select').val()
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

function updateOutfits(step)
{
    $('#depositError').addClass('d-none')
    $('#total-price').text(total+'$')
    var url = baseUrl + "/admin/order/updateOutfits";
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
    if(orderId != 0)
    {
        const depositers = document.getElementsByClassName("prev_transactions");
  
        let sum = 0;
        for (let i = 0; i < depositers.length; i++) {
            const value = parseFloat(depositers[i].value)
            if (!isNaN(value)) {
            sum += value;
            }
        }
        if(checker === 0)
        {
            checker++
            remaining = total
        }
        total = remaining
        
        total -= Number(sum)
    }
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