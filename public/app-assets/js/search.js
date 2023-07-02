// Get the search input element
var searchInput = document.getElementById("searchInput");

// Get the table element
var table = document.getElementById("ecom-orders");

// Add an event listener to the search input
searchInput.addEventListener("keyup", function(event) {
  var searchTerm = event.target.value.toLowerCase();
  var rows = table.getElementsByTagName("tbody")[0].getElementsByTagName("tr");

  // Loop through all rows in the table
  for (var i = 0; i < rows.length; i++) {
    var rowData = rows[i].innerText.toLowerCase();

    // Check if the row data contains the search term
    if (rowData.indexOf(searchTerm) > -1) {
      rows[i].style.display = "";
    } else {
      rows[i].style.display = "none";
    }
  }
});
