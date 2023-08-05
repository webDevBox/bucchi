$(function() {
    var deleteButtonHandler = function(anchor) {
      // Create a delete button and append it to the anchor element
      var deleteButton = document.createElement('button');
      deleteButton.innerHTML = '<i class="fa fa-trash"></i>';
      deleteButton.classList.add('delete-button', 'btn', 'btn-danger');
      anchor.appendChild(deleteButton);

      // Add a click event handler to the delete button
      $(deleteButton).on('click', function(e) {
        e.stopPropagation(); // Prevent the click event from bubbling to the anchor and triggering Magnific Popup
        $(anchor).remove(); // Remove the anchor element when the delete button is clicked
      });
    };

    // Multiple images preview in browser
    var imagesPreview = function(input, placeToInsertImagePreview) {
      if (input.files) {
        var filesAmount = input.files.length;

        for (i = 0; i < filesAmount; i++) {
          var reader = new FileReader();

          reader.onload = function(event) {
            var img = new Image();
            img.src = event.target.result;

            img.onload = function() {
              // Create a new image element to resize the image
              var resizedImage = new Image();

              // Set the desired maximum width and height for the gallery image
              var galleryMaxWidth = 100; // Set your desired maximum width for the gallery image
              var galleryMaxHeight = 100; // Set your desired maximum height for the gallery image
              var width = img.width;
              var height = img.height;

              // Calculate the aspect ratio to maintain the image's original proportions
              var aspectRatio = width / height;

              // Adjust width and height if necessary to fit within the gallery maximum dimensions
              if (width > galleryMaxWidth || height > galleryMaxHeight) {
                if (width / galleryMaxWidth > height / galleryMaxHeight) {
                  width = galleryMaxWidth;
                  height = width / aspectRatio;
                } else {
                  height = galleryMaxHeight;
                  width = height * aspectRatio;
                }
              }

              // Set the width and height of the resized image for the gallery
              resizedImage.width = width;
              resizedImage.height = height;

              // Create a canvas element to draw the resized image for the gallery
              var galleryCanvas = document.createElement('canvas');
              var galleryCtx = galleryCanvas.getContext('2d');
              galleryCanvas.width = width;
              galleryCanvas.height = height;

              // Draw the image on the gallery canvas with the adjusted dimensions
              galleryCtx.drawImage(img, 0, 0, width, height);

              // Set the src of the resized image in the gallery to the data URL of the canvas
              var galleryImageURL = galleryCanvas.toDataURL('image/jpeg');
              resizedImage.src = galleryImageURL;

              // Create an anchor element to hold the original image URL for the popup
              var anchor = document.createElement('a');
              anchor.href = img.src; // Set the anchor href to the original image URL

              // Append the resized image for the gallery to the anchor element
              anchor.appendChild(resizedImage);

              // Append the anchor element to the preview container
              $(placeToInsertImagePreview).append(anchor);

              // Call the deleteButtonHandler function to add the delete button to the anchor element
              deleteButtonHandler(anchor);

              // Apply Magnific Popup to the anchor element
              $(anchor).magnificPopup({
                type: 'image',
                closeOnContentClick: true,
                showCloseBtn: true
              });
            };
          };

          reader.readAsDataURL(input.files[i]);
        }
      }
    };

    $('#add_more').click(function() {
        $('#photo-block').removeClass('d-none')
        $("#status-photo-add").click()
    })

    $('#status-photo-add').on('change', function() {
      imagesPreview(this, 'div.status-gallery');
    });
  });

  $("#photos-picker").click(function() {
    $("#status-photo-add").click()
  })