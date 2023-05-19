const http = require('http');
const fs = require('fs');
const url = require('url');

const server = http.createServer((req, res) => {
  const parsedUrl = url.parse(req.url, true);
  const pathName = parsedUrl.pathname;

  if (pathName === '/' || pathName === '../messages/messages.php') {
    // Redirect to the chat interface page
    res.writeHead(302, { 'Location': '../messages/messages.php' });
    res.end();
  } else if (pathName === '/messages') {
    // Serve the messages array as JSON
    res.writeHead(200, { 'Content-Type': 'application/json' });
    res.end(JSON.stringify(messages));
  } else {
    // Serve a 404 error for all other requests
    res.writeHead(404);
    res.end();
  }
});

server.listen(9000, () => {
  console.log('Server listening on port 9000');
});

const messages = [];

// WebSocket server
const WebSocket = require('ws');
const wss = new WebSocket.Server({ port: 9000 });

wss.on('connection', (ws) => {
  console.log('Client connected');

  ws.on('message', (message) => {
    console.log('Received message:', message);
    const parsedMessage = JSON.parse(message);
    const { author, content } = parsedMessage;
    const timestamp = new Date().getTime();
    const newMessage = { author, content, timestamp };
    messages.push(newMessage);
    wss.clients.forEach((client) => {
      if (client.readyState === WebSocket.OPEN) {
        client.send(JSON.stringify(newMessage));
      }
    });
  });

  ws.on('close', () => {
    console.log('Client disconnected');
  });
});




