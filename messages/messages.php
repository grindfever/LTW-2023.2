<?php
session_start();
ob_start();
$conn = new PDO('sqlite:../database.db');

$stmt = $conn->prepare('SELECT client_id from Tickets WHERE ticket_id = ?');
$verification_ticket_id = $_GET['ticket_id'];
$stmt->bindParam(1,$verification_ticket_id);
$stmt->execute();

$client_id = $stmt->fetchColumn();
$_SESSION['client_id'] = $client_id;
$stmt = $conn->prepare('SELECT ticket_department_id FROM Tickets WHERE ticket_id = ?');
$stmt->bindParam(1,$verification_ticket_id);
$stmt->execute();

$ticket_department_id = $stmt->fetchColumn();
$staff_user_id = $_SESSION['user_id'];
$stmt = $conn->prepare('SELECT department_id FROM Admins WHERE admin_id = ?');
$stmt->bindParam(1,$staff_user_id);
$stmt->execute();

$verification_ticket_department_id_admins = $stmt->fetchColumn();
$stmt = $conn->prepare('SELECT department_id FROM Agents WHERE agent_id = ?');
$stmt->bindParam(1,$staff_user_id);
$stmt->execute();

$verification_ticket_department_id_agents = $stmt->fetchColumn();

if((isset($_SESSION['username']) && $_SESSION['user_id'] == $client_id) || ($_SESSION['usertype'] == 'admin' && $_SESSION['admin_type'] == 'main admin') || ($_SESSION['usertype'] == 'admin' && $_SESSION['admin_type'] == 'local admin' && $ticket_department_id == $verification_ticket_department_id_admins) || ($_SESSION['usertype'] == 'admin' && $_SESSION['admin_type'] == 'main admin') || ($_SESSION['usertype'] == 'agent' && $ticket_department_id == $verification_ticket_department_id_agents)) {
 if(isset($_GET['ticket_id'])) {
?>

<!DOCTYPE html>
<html>
<head>
  <title>Messages</title>
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
             <li><a href="#" onclick="showModal('change_username')">Change Username</a></li>
             <li><a href="#" onclick="showModal('change_email')">Change Email</a></li>
             <li><a href="#" onclick="showModal('change_password')">Change Password</a></li>
             <li><a href="http://localhost:9000/background/logout.php">Logout</a></li>
            </ul>
          </li>
        </ul>
      </li>
      <li>
        <span>Tickets</span>
        <ul>
          <li><a href="http://localhost:9000/tickets/ticket_form.php">New Ticket</a></li>
          <li><a href="http://localhost:9000/tickets/active_tickets.php">Active Tickets</a></li>
          <li><a href="http://localhost:9000/tickets/closed_tickets.php">Previous Tickets</a></li>
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
          <li><a href="http://localhost:9000/departments/customer-service.php">Customer Service</a></li>
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
      <?php
       if($_SESSION['usertype'] == "agent" || $_SESSION['usertype'] == "admin") {
        ?>
        <li>
         <span>Staff</span>
         <ul>
          <li><a href ="http://localhost:9000/staff/assigned_tickets.php">Assigned Tickets</a></li>
          <li><a href ="http://localhost:9000/staff/staff_messages.php">Staff Messages</a><li>
          <li><a href = "http://localhost:9000/staff/ticket-inbox.php">Ticket Inbox</a><li>
         </ul>
        </li>
      <?php
        }
       if($_SESSION['usertype'] == "admin") {
      ?>
       <li>
        <span>Management</span>
        <ul>
          <li>
            <span>Departments</span>
            <ul>
             <li><a href="http://localhost:9000/management/software-ts.php">Software Technical Support</a></li>
             <li><a href="http://localhost:9000/management/hardware-ts.php">Hardware Technical Support</a></li>
             <li><a href="http://localhost:9000/management/web-development.php">Web Development</a></li>
             <li><a href="http://localhost:9000/management/app-development.php">App Development</a></li>
             <li><a href="http://localhost:9000/management/network-support.php">Network Support</a></li>
             <li><a href="http://localhost:9000/management/costomer-service.php">Costomer Service</a></li>
             <li><a href="http://localhost:9000/management/security-issues.php">Security Issues</a></li>
            </ul>
          </li>
          <li><a href="http://localhost:9000/management/requests.php">Requests & Complaints Inbox</a></li>
        </ul>    
       </li>
       <?php
       }
      ?>
    </ul>
  </nav>  
  <div id="chat-box-wrapper">
    <div id="chat-box">
    <?php
      $_SESSION['ticket_id'] = $_GET['ticket_id'];
      include "chat-box.php";
    ?>
    </div>
  </div>
<form method="POST" id="chat-form">
       <textarea id="message_text" name="new_message" placeholder="Enter message here"></textarea>
       <input type="submit" id="send_button" value="Send"/>
</form>

<footer>
 <p>© Copyright 2021-2023 IT Ticket</p>
 <p><a href = "http://localhost:9000/privacy/privacy_policy.php">Privacy Policy</a></p>
</footer>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<script src="../js_files/click.js"></script>
<script src="../js_files/close_ticket_confirmation.js"></script>
<script src="../js_files/increasing-textarea-size.js"></script>
<script src="../js_files/adjust-button-height.js"></script>
<script src="../js_files/real_time_messages.js"></script>
</body>
</html>
<?php
  }
}
?>