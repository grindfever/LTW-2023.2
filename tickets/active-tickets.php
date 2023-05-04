<?php
session_start();
$conn = new PDO('sqlite:../database.db');
if(isset($_SESSION['username'])){
 if(isset($_SESSION['message'])) {
  echo '<script>alert("' . $_SESSION['message'] . '");</script>';
  unset($_SESSION['message']);
}
?>
<!DOCTYPE html>
<html>
 <head>
  <title>My Tickets</title>
  <link rel="stylesheet" href="../style.css">
 </head>
 <body>
  <header class = "header1">
    <h1>Trouble Tickets<h1>
    <h2>Here to help you solve all your tech problems!</h2>
    <a href="http://localhost:9000/main.php" class="home-button"><img src="../images/home_icon.png" alt="Home"></a>
  </header>
  <nav id="main_menu">
    <ul>
      <li>
        <span>My Profile</span>
        <ul>
          <li><a href="http://localhost:9000/profiles/my-profile.php">View Profile</a></li>
          <li>
            <span>Edit Profile</span>
            <ul>
              <li><a href="http://localhost:9000/profiles/change-username.php">Change Username</a></li>
              <li><a href="http://localhost:9000/profiles/change-password.php">Change Password</a></li>
              <li><a href="http://localhost:9000/background/logout.php">Logout</a></li>
            </ul>
          </li>
        </ul>
      </li>
      <li>
        <span>Tickets</span>
        <ul>
          <li><a href="http://localhost:9000/tickets/ticket-form.php">New Ticket</a></li>
          <li><a href="http://localhost:9000/tickets/active-tickets.php">Active Tickets</a></li>
          <li><a href="http://localhost:9000/tickets/closed-tickets.php">Previous Tickets</a></li>
        </ul>
      </li>
      <li>
        <span>Departments</span>
        <ul>
          <li><a href="http://localhost:9000/departments/software-ts.php">Software Technical Support</a></li>
          <li><a href="http://localhost:9000/departments/hardware-ts.php">Hardware Technical Support</a></li>
          <li><a href="http://localhost:9000/departments/web-development.php">Web Development</a></li>
          <li><a href="http://localhost:9000/departments/app-development.php">App Development</a></li>
          <li><a href="http://localhost:9000/departments/network-support.php">Network Support</a></li>
          <li><a href="http://localhost:9000/departments/costomer-service.php">Costomer Service</a></li>
          <li><a href="http://localhost:9000/departments/security-issues.php">Security Issues</a></li>
        </ul>
      </li>
      <li>
        <span>Projects and Products</span>
        <ul>
          <li><a href="http://localhost:9000/projects&products/project-a.php">Project A</a></li>
          <li><a href="http://localhost:9000/projects&products/project-b.php">Project B</a></li>
          <li><a href="http://localhost:9000/projects&products/product-a.php">Product A</a></li>
          <li><a href="http://localhost:9000/projects&products/product-b.php">Product B</a></li>
          <li><a href="http://localhost:9000/projects&products/product-c.php">Product C</a></li>
        </ul>
      </li>
      <li>
       <span>FAQ</span>
       <ul>
        <li><a href="http://localhost:9000/faq.php">FAQ</a></li>
       </ul>
      </li>
    </ul>
  </nav>
  <h1 id = "active_tickets">Active Tickets</h1>
<?php
$stmt = $conn->prepare('SELECT * FROM Tickets WHERE client_id = ? AND (ticket_status = ? OR ticket_status = ?)');
$client_id = $_SESSION['user_id'];
$ticket_status_1 = 'open';
$ticket_status_2 = 'assigned';
$stmt->bindParam(1,$client_id);
$stmt->bindParam(2,$ticket_status_1);
$stmt->bindParam(3,$ticket_status_2);
$stmt->execute();
$result = $stmt->fetchall();
foreach($result as $row){
 $url1 = 'view_tickets.php?ticket_id=' . $row['ticket_id'];
 $url2 = '../messages/messages.php?ticket_id=' . $row['ticket_id'];
 $url3 = '../background/close_tickets.php?ticket_id=' . $row['ticket_id'];
 echo '<div class = active-ticket>';
 echo '<hr>';
 echo '<h1> ID </h1>';
 echo '<p>' . $row['ticket_id'] . '</p>';
 echo '<h1> Title </h1>';
 echo '<p>' . $row['ticket_title'] . '</p>';
 echo '<h1> Status </h1>';
 echo '<p>' . $row['ticket_status'] . '</p>';
 echo '<h1> Time </h1>';
 echo '<p>' . $row['ticket_register_time'] . '</p>';
 echo '<ul>';
  echo'<li><a href=' . $url1 . '>View Ticket</a></li>';
  echo'<li><a href=' .$url2 . '>Messages</a></li>';
  echo'<li><a id = "close-ticket-link" href=' .$url3 . '>Close Ticket</a></li>';
 echo '</ul>';
 echo '<hr>';
 echo '<br>';
 echo '<br>';
 echo '</div>';
 }
 ?>
 <footer>
 <p>© Copyright 2021-2023 IT Ticket</p>
 <p><a href = "http://localhost:9000/privacy/privacy_policy.php">Privacy Policy</a></p>
 </footer>
 <script src="../js_files/click.js"></script>
 <script src="../js_files/close_ticket_confirmation.js"></script>
</body>
<?php
}
?>
