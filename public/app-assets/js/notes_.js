let recordedAudios = [];
let mediaRecorder;
let stream;
const recordButton = document.getElementById('recordButton');
const stopButton = document.getElementById('stopButton');
const audioPlayer = document.getElementById('audioPlayer');
const audioList = document.getElementById('audioList');

recordButton.addEventListener('click', (event) => {
  event.preventDefault();
  startRecording();
});
stopButton.addEventListener('click', (event) => {
  event.preventDefault();
  stopRecording();
});

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

  recordedAudios.forEach((audioURL, index) => {
    const audioElement = document.createElement('audio');
    audioElement.src = audioURL;
    audioElement.controls = true;

    const deleteButton = document.createElement('button');
    deleteButton.innerHTML = '<i class="fa fa-trash"></i>';
    deleteButton.classList.add('delete-button', 'btn', 'btn-danger');
    deleteButton.style.marginBottom = '50px';
    deleteButton.addEventListener('click', () => {
      deleteAudio(index);
    });

    const audioContainer = document.createElement('div');
    audioContainer.classList.add('audio-container');
    audioContainer.appendChild(audioElement);
    audioContainer.appendChild(deleteButton);

    const listItem = document.createElement('li');

    // Add a counter element to the list item
    const counterElement = document.createElement('span');
    counterElement.classList.add('counter');
    counterElement.textContent = index + 1 + '. '; // Count starts from 1
    listItem.appendChild(counterElement);

    // Add the audio container to the list item
    listItem.appendChild(audioContainer);

    audioList.appendChild(listItem);
  });
}



function deleteAudio(index) {
  recordedAudios.splice(index, 1);
  displayRecordedAudios();
}