const chatForm = document.getElementById('chat-form');
const chatMessages = document.getElementById('chat_messages');

chatForm.addEventListener('submit', function(event) {
  event.preventDefault();

  const formData = new FormData(this);

  fetch('../messages/messages.php', {
    method: 'POST',
    body: formData
  })
  .then(response => response.json())
  .then(data => {
    if (data.success) {
      const messageContainer = document.createElement('div');
      messageContainer.className = 'loaded-message';

      const messageText = document.createElement('p');
      messageText.innerText = data.message;
      messageContainer.appendChild(messageText);

      chatMessages.appendChild(messageContainer);

      // Clear the textarea
      const textarea = document.getElementById('message_text');
      textarea.value = '';

      // Scroll to the bottom of the chat messages
      chatMessages.scrollTop = chatMessages.scrollHeight;
    }
    else {
      alert('Error sending message');
    }
  })
  .catch(error => {
    console.error(error);
    alert('Error sending message');
  });
});
