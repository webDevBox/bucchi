async function makeMaterial(step) {
    var audioFiles = $("#audioList audio");

    // Step 2: Convert audio files to FormData
    var formData = new FormData();
    audioFiles.each(function(index, audioElement) {
      var audioFile = audioElement.querySelector("source").getAttribute("src");
      fetch(audioFile)
        .then(response => response.blob())
        .then(blob => {
          // Append each audio file to FormData
          formData.append("audioFile" + index, blob, audioFile);
          
          // Check if this is the last audio file, then make the AJAX call
          if (index === audioFiles.length - 1) {
            console.log(formData);
          }
        });
    });
  
    // var url = baseUrl + "/admin/order/sendMaterial";
    // $.ajax({
    //   url: url,
    //   type: "POST",
    //   data: audioFileObject,
    //   processData: false,
    //   contentType: false,
    //   success: async function (response) {
    //     if (response.success) {
    //       console.log(response.note);
    //     }
    //   },
    //   error: function (xhr, status, error) {
    //     // Handle the error response
    //   }
    // });
  }
  