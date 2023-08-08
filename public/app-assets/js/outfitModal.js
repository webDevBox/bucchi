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
                    var newStatus
                    outfit.status_list.map((status) => {
                        if(status.current === 0)
                        {
                            newStatus = status.status
                        }
                    })
                    var row = $('<tr>');
                    row.append($('<td>').addClass('text-center').text(outfit.article));
                    row.append($('<td>').addClass('text-center').html('<a target="_blank" href="' + outfit.detailsRoute + '">' + outfit.name + '</a>'));
                    row.append($('<td>').addClass('text-center').text(outfit.hours));
                    row.append($('<td>').addClass('text-center').text(newStatus));
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