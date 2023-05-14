const urlParams = new URLSearchParams(window.location.search);
const ticketId = urlParams.get('ticket_id');
const socket = new WebSocket(`ws://localhost:9000/messages/messages.php?ticket_id=${ticketId}`);

const chatForm = document.getElementById('chat-form');
const chatMessages = document.getElementById('chat_messages');

socket.addEventListener('open', () => {
  console.log('Connected to server');
});

socket.addEventListener('message', (message) => {
  console.log('Received message:', message);
  const parsedMessage = JSON.parse(message.data);
  displayMessage(parsedMessage);
});

chatForm.addEventListener('submit', (event) => {
    event.preventDefault();
    const contentInput = document.getElementById('message_text');
    const content = contentInput.value;
    const message = { content };
    socket.send(JSON.stringify(message));
    contentInput.value = '';
  });  
  
function displayMessage(message) {
    const div = document.createElement('div');
    div.classList.add('message');
    div.innerHTML = `
      <p class="meta">${new Date(message.timestamp).toLocaleTimeString()}</p>
      <p class="text">${message.content}</p>
    `;
    chatMessages.appendChild(div);
    chatMessages.scrollTop = chatMessages.scrollHeight;
  }
  

