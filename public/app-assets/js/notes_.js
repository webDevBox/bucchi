let stream;
    let mediaRecorder;
    const recordButton = document.getElementById('recordButton');
    const stopButton = document.getElementById('stopButton');
    const audioPlayer = document.getElementById('audioPlayer');

    recordButton.addEventListener('click', startRecording);
    stopButton.addEventListener('click', stopRecording);

    function startRecording() {
        $('#stopButton').removeClass('d-none')
        $('#recordButton').addClass('d-none')
        
      navigator.mediaDevices.getUserMedia({ audio: true })
        .then((stream) => {
          recordButton.disabled = true;
          stopButton.disabled = false;

          mediaRecorder = new MediaRecorder(stream);
          mediaRecorder.start();

          const chunks = [];
          mediaRecorder.addEventListener('dataavailable', (event) => {
            chunks.push(event.data);
          });

          mediaRecorder.addEventListener('stop', () => {
            const blob = new Blob(chunks, { type: 'audio/ogg; codecs=opus' });
            const audioURL = URL.createObjectURL(blob);
            audioPlayer.src = audioURL;
          });
        })
        .catch((error) => {
          console.error('Error accessing the microphone:', error);
        });
    }

    function stopRecording() {
        $('#stopButton').addClass('d-none')
        $('#recordButton').removeClass('d-none')
        $('#audioPlayer').removeClass('d-none')
      recordButton.disabled = false;
      stopButton.disabled = true;

      mediaRecorder.stop();
      stream.getTracks().forEach((track) => track.stop());
    }