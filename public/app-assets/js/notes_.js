let recordedAudios = [];
let mediaRecorder;
let stream;
const recordButton = document.getElementById('recordButton');
const stopButton = document.getElementById('stopButton');
const audioPlayer = document.getElementById('audioPlayer');
const audioList = document.getElementById('audioList');

recordButton.addEventListener('click', startRecording);
stopButton.addEventListener('click', stopRecording);

function startRecording() {
  $('#stopButton').removeClass('d-none');
  $('#recordButton').addClass('d-none');

  navigator.mediaDevices.getUserMedia({ audio: true })
    .then((newStream) => {
      recordButton.disabled = true;
      stopButton.disabled = false;

      stream = newStream;
      mediaRecorder = new MediaRecorder(stream);
      const chunks = [];
      mediaRecorder.addEventListener('dataavailable', (event) => {
        chunks.push(event.data);
      });

      mediaRecorder.addEventListener('stop', () => {
        const blob = new Blob(chunks, { type: 'audio/ogg; codecs=opus' });
        const audioURL = URL.createObjectURL(blob);
        recordedAudios.push(audioURL);
        displayRecordedAudios();
      });

      mediaRecorder.start();
    })
    .catch((error) => {
      console.error('Error accessing the microphone:', error);
    });
}

function stopRecording() {
  $('#stopButton').addClass('d-none');
  $('#recordButton').removeClass('d-none');
  $('#audioPlayer').removeClass('d-none');

  recordButton.disabled = false;
  stopButton.disabled = true;

  mediaRecorder.stop();
  stream.getTracks().forEach((track) => track.stop());
}

function displayRecordedAudios() {
  audioList.innerHTML = '';

  recordedAudios.forEach((audioURL) => {
    const audioElement = document.createElement('audio');
    audioElement.src = audioURL;
    audioElement.controls = true;

    const listItem = document.createElement('li');
    listItem.appendChild(audioElement);

    audioList.appendChild(listItem);
  });
}