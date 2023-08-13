$(document).ready(function() {
    $('#myModal8').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var orderId = button.data('order-id'); // Extract the order ID from the data attribute

        var modal = $(this);
        var tableBody = modal.find('#outfit-table-body');

        // Clear the table body
        tableBody.empty();
        var url = baseUrl + "/admin/order/outfits";
        // Make an AJAX request to fetch the outfits for the selected order
        $.ajax({
            url: url, // Replace with your route for fetching the outfits
            type: 'GET',
            data: { orderId: orderId },
            success: function(response) {
                // Populate the table body with the fetched outfits
                $.each(response.outfits, function(index, outfit) {
                    var row = $('<tr>');
                    row.append($('<td>').addClass('text-center').text(outfit.article));
                    row.append($('<td>').addClass('text-center').html('<a target="_blank" href="' + outfit.detailsRoute + '">' + outfit.name + '</a>'));
                    row.append($('<td>').addClass('text-center').text(outfit.hours));
                    if(outfit.status == '1')
                    {
                        row.append($('<td>').addClass('text-center').html(`<div class="btn-group btn-group-xs">
                            <button disabled id="button_${outfit.id}" title="In Production" class="btn btn-dark"><i class="fa fa-paper-plane"></i></button>
                        </div> `));
                    }
                    else
                    {
                        row.append($('<td>').addClass('text-center').html(`<div class="btn-group btn-group-xs">
                            <button onclick="sendProduction(${outfit.id}, '${outfit.article}', '${outfit.name}')" id="button_${outfit.id}" title="Send To Production" class="btn btn-success"><i class="fa fa-paper-plane"></i></button>
                        </div> `));
                    }
                    
                    tableBody.append(row);
                });
            },
            error: function(xhr) {
                // Handle error if the AJAX request fails
                console.log(xhr.responseText);
            }
        });
    });
});