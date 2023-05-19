const textarea = document.getElementById('message_text');

textarea.addEventListener('input', function() {
  const scrollHeight = this.scrollHeight;
  this.style.height = 'auto';
  this.style.height = scrollHeight + 'px';
  this.scrollTop = 0;
});

