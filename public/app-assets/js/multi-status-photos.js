$(function() {
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
                        // Create a canvas element
                        var canvas = document.createElement('canvas');
                        var ctx = canvas.getContext('2d');

                        // Set the desired width and height for the preview image
                        var maxWidth = 100; // Set your desired maximum width
                        var maxHeight = 100; // Set your desired maximum height
                        var width = img.width;
                        var height = img.height;

                        // Calculate the aspect ratio to maintain the image's original proportions
                        var aspectRatio = width / height;

                        // Adjust width and height if necessary to fit within the maximum dimensions
                        if (width > maxWidth) {
                            width = maxWidth;
                            height = width / aspectRatio;
                        }

                        if (height > maxHeight) {
                            height = maxHeight;
                            width = height * aspectRatio;
                        }

                        // Set the canvas size to the adjusted width and height
                        canvas.width = width;
                        canvas.height = height;

                        // Draw the image on the canvas
                        ctx.drawImage(img, 0, 0, width, height);

                        // Create a new image element with the resized image data
                        var resizedImage = new Image();
                        resizedImage.src = canvas.toDataURL('image/jpeg');

                        // Apply CSS styling to the resized image
                        resizedImage.style.marginRight = '10px'; // Set the desired spacing between images 

                        // Append the resized image to the preview container
                        $(placeToInsertImagePreview).append(resizedImage);
                    };
                };

                reader.readAsDataURL(input.files[i]);
            }
        }
    };

    $('#status-photo-add').on('change', function() {
        imagesPreview(this, 'div.status-gallery');
    });
});


    $("#photos-picker").click(function(){
        $("#status-photo-add").click();
    })