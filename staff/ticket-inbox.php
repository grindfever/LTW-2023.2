<?php
session_start();
$conn = new PDO('sqlite:../database.db');
if(isset($_SESSION['username']) && ($SESSION['usertype'] = 'admin' || $SESSION['usertype'] == 'agent')){
 if(isset($_SESSION['redirect'])){
  unset($_SESSION['redirect']);
 }
 if(isset($_SESSION['message'])) {
  echo '<script>alert("' . $_SESSION['message'] . '");</script>';
  unset($_SESSION['message']);
 }
 if((isset($_SESSION['admin_type']) && $_SESSION['admin_type'] == 'local admin') || ($_SESSION['usertype'] == 'agent')){
  if($_SESSION['usertype'] == 'agent'){
   $stmt = $conn->prepare('SELECT department_id FROM Agents WHERE agent_id = ?');
   $agent_id = $_SESSION['user_id'];
   $stmt->bindParam(1,$agent_id);
   $stmt->execute();
   $department_id = $stmt->fetchColumn();
  }
  else if($_SESSION['usertype'] = 'admin'){
   $stmt = $conn->prepare('SELECT department_id FROM Admins WHERE admin_id = ?');
   $admin_id = $_SESSION['user_id'];
   $stmt->bindParam(1,$admin_id);
   $stmt->execute();
   $department_id = $stmt->fetchColumn();
  }
  $stmt = $conn->prepare('SELECT * FROM Tickets WHERE ticket_department_id = ? AND (ticket_status = ? OR ticket_status = ?)');
  $open_status = 'open';
  $assigned_status = 'assigned';
  $stmt->bindParam(1,$department_id);
  $stmt->bindParam(2,$open_status);
  $stmt->bindParam(3,$assigned_status);
 }
 elseif(isset($_SESSION['admin_type']) && $SESSION['admin_type'] = 'main admin'){
  $stmt = $conn->prepare('SELECT department_id FROM Admins WHERE admin_id = ?');
  $admin_id = $_SESSION['user_id'];
  $stmt->bindParam(1,$admin_id);
  $stmt->execute();
  $department_id = $stmt->fetchColumn();
  $stmt = $conn->prepare('SELECT * FROM Tickets WHERE (ticket_status = ? OR ticket_status = ?)');
  $open_status = 'open';
  $assigned_status = 'assigned';
  $stmt->bindParam(1,$open_status);
  $stmt->bindParam(2,$assigned_status);
 }
 $stmt->execute();
 $tickets = $stmt->fetchAll();
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
          <li><a href="http://localhost:9000/projects&products/my-mentor.php">My Mentor</a></li>
          <li><a href="http://localhost:9000/projects&products/meal-match.php">Meal Match</a></li>
          <li><a href="http://localhost:9000/projects&products/event-planner.php">Event Planner</a></li>
          <li><a href="http://localhost:9000/projects&products/smart-gym.php">Smart Gym</a></li>
          <li><a href="http://localhost:9000/projects&products/healthy-habits.php">Healthy Habits</a></li>
        </ul>
      </li>
      <li>
       <span>FAQ</span>
       <ul>
        <li><a href="http://localhost:9000/faq.php">FAQ</a></li>
       </ul>
      </li>
      <?php
       if($_SESSION['usertype'] == "agent" || $_SESSION['usertype'] == "admin"){
        ?>
        <li>
         <span>Staff</span>
         <ul>
          <li><a href ="http://localhost:9000/staff/assigned_tickets.php">Assigned Tickets</a></li>
          <li><a href ="http://localhost:9000/staff/assigned_tickets.php">Staff Messages</a><li>
          <li><a href = "http://localhost:9000/staff/ticket-inbox.php">Ticket Inbox</a><li>
         </ul>
        </li>
      <?php
       }
       if($_SESSION['usertype'] == "admin"){
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
  <?php
 foreach($tickets as $row){
  $url1 = '../tickets/view_tickets.php?ticket_id=' . $row['ticket_id'];
  $url2 = '../background/assignments.php?ticket_id=' . $row['ticket_id'];
  $url3 = '../background/staff_close_tickets.php?ticket_id=' . $row['ticket_id'];
  $stmt = $conn->prepare('SELECT * FROM Users WHERE user_id = ?');
  $stmt->bindParam(1,$row['client_id']);
  $stmt->execute();
  $user_info = $stmt->fetch();
  $stmt = $conn->prepare('SELECT * FROM Departments WHERE department_id = ?');
  $stmt->bindParam(1,$row['ticket_department_id']);
  $stmt->execute();
  $department_info = $stmt->fetch();
  echo '<div class = active-ticket>';
  echo '<hr>';
  echo '<h1> Ticket ID </h1>';
  echo '<p>' . $row['ticket_id'] . '</p>';
  echo '<h1> Client ID </h1>';
  echo '<p>' . $row['client_id'] . '</p>';
  echo '<h1> Client Username </h1>';
  echo '<p>' . $user_info['username'] . '</p>';
  echo '<h1> Client Name </h1>';
  echo '<p>' . $user_info['first_name'] . ' ' . $user_info['last_name'] . '</p>';
  echo '<h1> Title </h1>';
  echo '<p>' . $row['ticket_title'] . '</p>';
  if(isset($_SESSION['admin_type']) && $SESSION['admin_type'] = 'main admin'){
   echo '<h1> Department </h1>';
   echo '<p>' . $department_info['department_name'] . '</p>';
  }
  echo '<h1> Status </h1>';
  echo '<p>' . $row['ticket_status'] . '</p>';
  echo '<h1> Time </h1>';
  echo '<p>' . $row['ticket_register_time'] . '</p>';
  echo '<ul>';
   echo'<li><a href=' . $url1 . '>View Ticket</a></li>';
   echo '<li><a href="#" onclick="showPrioritySelection(\'' . $url2 . '\');">Assign Ticket</a></li>';
   echo '<li><a href="#" onclick="confirmCloseTicket(\'' . $url3 . '\');">Close ticket</a></li>';
  echo '</ul>';
  echo '<script>
  function showPrioritySelection(url) {
    var priority = prompt("Please select a ticket priority:");
    if (priority != null && priority != "") {
      window.location.href = url + "&priority=" + priority;
    }
  }
  function confirmCloseTicket(url) {
   if (confirm("Are you sure you want to close this ticket?")) {
    window.location.href = url;
   }
  }
 </script>';
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
