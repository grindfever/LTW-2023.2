document.getElementById("close-ticket-link").addEventListener("click", function(e) {
    e.preventDefault();
    if (confirm("Are you sure you want to close this ticket?")) {
      window.location.href = "../background/close_tickets.php";
    }
  });