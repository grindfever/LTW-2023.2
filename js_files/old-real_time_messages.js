// Get the form element and chat message container
const form = document.getElementById('chat-form');
const chatMessages = document.getElementById('chat_messages');

// Get the ticket ID from the URL
const urlParams = new URLSearchParams(window.location.search);
const ticketId = urlParams.get('ticket_id');

// Set up a function to handle new messages
function handleNewMessage(message) {
  // Create a new div element with the class "message"
  const newMessage = document.createElement('div');
  newMessage.classList.add('message');
  newMessage.innerHTML = message;

  // Append the new div element to the chatMessages container
  chatMessages.appendChild(newMessage);
}

// Set up a function to get new messages from the server
function getNewMessages() {
  // Create a new XMLHttpRequest object
  const xhr = new XMLHttpRequest();

  // Set up the xhr object to send a GET request to the server
  xhr.open('GET', '../messages/messages.php?ticket_id=' + encodeURIComponent(ticketId), true);

  // Set up the xhr object to handle the response from the server
  xhr.onreadystatechange = () => {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        // If the server returns a "success" response, parse the response as JSON
        const response = JSON.parse(xhr.responseText);

        // Iterate over each new message in the response and handle it
        response.forEach((message) => {
          handleNewMessage(message);
        });
      } else {
        // If the server returns an error response, log the error
        console.error('Error getting new messages:', xhr.responseText);
      }
    }
  };

  // Send the GET request
  xhr.send();
}

// Call getNewMessages() to start the process
getNewMessages();

// Add an event listener to the form that listens for the "submit" event
form.addEventListener('submit', (event) => {
  // Prevent the form from submitting normally
  event.preventDefault();

  // Get the message input element and its value
  const messageInput = document.getElementById('message_text');
  const message = messageInput.value;

  // Create a new XMLHttpRequest object
  const xhr = new XMLHttpRequest();

  // Set up the xhr object to send a POST request to the server
  xhr.open('POST', '../messages/messages.php?ticket_id=' + encodeURIComponent(ticketId), true);
  xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

  // Set up the xhr object to handle the response from the server
  xhr.onreadystatechange = () => {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        // If the server returns a "success" response, reset the message input and handle the new message
        messageInput.value = '';
        handleNewMessage(message);
      } else {
        // If the server returns an error response, log the error
        console.error('Error submitting message:', xhr.responseText);
      }
    }
  }

  // Send the POST request with the message as the data
  xhr.send('new_message=' + encodeURIComponent(message));
});







