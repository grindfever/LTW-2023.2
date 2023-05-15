const textarea = document.getElementById('message_text');
const sendBtn = document.getElementById('send_button');

textarea.addEventListener('input', function() {
  const scrollHeight = this.scrollHeight;
  this.style.height = 'auto';
  this.style.height = scrollHeight + 'px';
  sendBtn.style.bottom = this.clientHeight + 'px';
});

