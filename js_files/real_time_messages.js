$(document).ready(function() {
  const maxHeight = 5000000000;
  $('#chat-box').scrollTop(maxHeight);
  $(this).scrollTop(maxHeight);

  $.ajax({
    type: 'GET',
    url: '../messages/messages.php',
    success: function(response) {
      if (response == 1) {
        document.location.reload(true);
      }
    }
  });
});