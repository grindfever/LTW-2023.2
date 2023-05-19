$(document).ready(function() {
  var previousHeight = localStorage.getItem("pageHeight");
  if (previousHeight) {
    $(this).scrollTop(localStorage.getItem("pageHeight"), 1000);
    localStorage.setItem("pageHeight", null);
  }

  localStorage.setItem("pageHeight", $(window).scrollTop());
  const maxHeight = 5000000000;
  $('#chat-box').scrollTop(maxHeight);
  
  setInterval(() => {  
    $.ajax({
    type: 'POST',
    url: '../messages/chat-box.php',
    success: function(response) {
      $('#chat-box').html(response);
      $('#chat-box').scrollTop(maxHeight);
    }
  });}, 1000);
});

$('#chat-form').submit(function(event) {
  event.preventDefault();
  var new_message = document.getElementById('message_text').value;
  document.getElementById('message_text').value = '';
  $.ajax({
    type: 'POST',
    url: '../messages/chat-box.php',
    data: {new_message: new_message},
    success: function(response) {
      $('#chat-box').html(response);
      const maxHeight = 5000000000;
      $('#chat-box').scrollTop(maxHeight);
    }
  });
});