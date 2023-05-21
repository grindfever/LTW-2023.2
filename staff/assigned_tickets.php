<?php
session_start();
$conn = new PDO('sqlite:../database.db');
include('../filter_functions.php');
if($_SESSION['usertype'] == 'admin' || $_SESSION['usertype'] == 'agent'){
 if(isset($_SESSION['redirect'])){
  unset($_SESSION['redirect']);
 }
 if(isset($_SESSION['message'])) {
  echo '<script>alert("' . $_SESSION['message'] . '");</script>';
  unset($_SESSION['message']);
  }
 $user_id = $_SESSION['user_id'];
 $stmt = $conn->prepare('SELECT ticket_id FROM Assignments WHERE user_id = ?');
 $stmt->bindParam(1,$user_id);
 $stmt->execute();
 $tickets = $stmt->fetchAll();
 $assigned_tickets = [];
 foreach($tickets as $ticket){
  $stmt = $conn->prepare('SELECT * FROM Tickets WHERE ticket_id = ?');
  $stmt->bindParam(1,$ticket['ticket_id']);
  $stmt->execute();
  $added_ticket = $stmt->fetch();
  $assigned_tickets[] = $added_ticket;
 }
 $stmt = $conn->prepare('SELECT * FROM Departments');
 $stmt->execute();
 $departments = $stmt->fetchAll();
 ?>
 <!DOCTYPE html>
<html>
 <head>
  <title>My Assigned Tickets</title>
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
          <li><a href="http://localhost:9000/background/logout.php">Logout</a></li>
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
        <li><a href="http://localhost:9000/FAQ/faq.php">FAQS</a></li>
        <?php
         if(isset($_SESSION['username']) && ($_SESSION['usertype'] == 'admin' || $_SESSION['usertype'] == 'agent')){
        ?>
        <li><a href="http://localhost:9000/FAQ/faq_insertion.php">Update FAQS</a></li>
        <?php
        }
        ?>
       </ul>
      </li>
      <?php
       if($_SESSION['usertype'] == "agent" || $_SESSION['usertype'] == "admin"){
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
       if($_SESSION['usertype'] == "admin"){
      ?>
       <li>
        <span>Management</span>
        <ul>
         <li><a href="http://localhost:9000/management/user_managment.php">User Managment</a></li>
         <li><a href="http://localhost:9000/management/requests.php">Requests & Complaints Inbox</a></li>
        </ul>    
       </li>
      <?php
       }
      ?>
    </ul>
  </nav>
  <form action="#" method="POST" id = "ticket-filter-form">
  <label for="filter-type-select">Select Filter Type:</label>
  <select id="filter-type-select" name="filterType">
    <option value="none">None</option>
    <option value="department">Department</option>
    <option value="priority">Priority</option>
    <option value="registration-time">Registration Date</option>
  </select>

  <div id="filter-options">
    <div id="department-filter" class="filter">
      <label for="department-select">Filter by Department:</label>
      <select id="department-select" name="departmentValue">
        <option value="all">All</option>
        <?php foreach ($departments as $department): ?>
          <option value="<?php echo $department['department_id']; ?>"><?php echo $department['department_name']; ?></option>
        <?php endforeach; ?>
      </select>
    </div>

    <div id="priority-filter" class="filter">
      <label for="priority-select">Filter by Priority:</label>
      <select id="status-select" name="priorityValue">
        <option value="all">All</option>
        <option value="high">High</option>
        <option value="medium">Medium</option>
        <option value="low">Low</option>
      </select>
    </div>
  </div>

  <div id="registration-time-filter" class="filter">
      <label for="registration-time-select">Filter by Registration Time:</label>
      <select id="registration-time-select" name="registrationtimeValue">
        <option value="all">All</option>
        <option value="today">Today</option>
        <option value="yesterday">Yesterday</option>
        <option value="2 days ago">Two days ago</option>
        <option value="last 7 days">This Week</option>
        <option value="last 2 weeks">In Last Two Weeks</option>
        <option value="last month">In the Last Month</option>
        <option value="last 2 months">In the Last 2 Months</option>
        <option value="last year">In the Last Year</option>
      </select>
    </div>
  <button type="submit" name="apply-filter-button">Apply Filter</button>
</form>
  <?php
  $filteredTickets = $assigned_tickets;
  if (isset($_POST['apply-filter-button'])) {
   $filterType = $_POST['filterType'];
   $departmentValue = $_POST['departmentValue'];
   $priorityValue = $_POST['priorityValue'];
   $statusValue = $_POST['statusValue'];
   $registrationtimeValue = $_POST['registrationtimeValue'];
   if ($filterType === 'department') {
     if ($departmentValue !== 'all') {
       $filteredTickets = filterTicketsByDepartment($assigned_tickets, $departmentValue);
     }
   } elseif ($filterType === 'priority') {
     if ($priorityValue !== 'all') {
       $filteredTickets = filterTicketsByPriority($assigned_tickets, $priorityValue);
     }
   } elseif ($filterType === 'registration-time') {
     if ($registrationtimeValue !== 'all') {
       $filteredTickets = filterTicketsByRegistrationTime($assigned_tickets, $registrationtimeValue);
     }
   }
  }
 foreach($filteredTickets as $row){
  $ticket_id = $row['ticket_id'];
  $url1 = '../tickets/view_tickets.php?ticket_id=' . $row['ticket_id'];
  $url2 = '../messages/messages.php?ticket_id=' . $row['ticket_id'];
  $url4 = '../background/unassignments.php?ticket_id=' . $row['ticket_id'];
  $url3 = '../background/staff_close_tickets.php?ticket_id=' . $row['ticket_id'];
  $url5 = '../background/change_ticket_priority.php?ticket_id=' . $row['ticket_id'];
  $stmt = $conn->prepare('SELECT * FROM Users WHERE user_id = ?');
  $stmt->bindParam(1,$row['client_id']);
  $stmt->execute();
  $user_info = $stmt->fetch();
  $stmt = $conn->prepare('SELECT department_name FROM Departments WHERE department_id = ?');
  $stmt->bindParam(1,$row['ticket_department_id']);
  $stmt->execute();
  $department_name = $stmt->fetchColumn();
  if($row['ticket_status'] == 'assigned'){
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
    echo '<p>' . $department_name . '</p>';
   }
   echo '<h1> Priority </h1>';
   echo '<p>' . $row['ticket_priority'] . '</p>';
   $stmt = $conn->prepare('SELECT * FROM Assignments WHERE ticket_id = ?');
   $stmt->bindParam(1,$row['ticket_id']);
   $stmt->execute();
   $assigned_agents = $stmt->fetchAll();
   echo '<h1> Number of Assigned Agents </h1>';
   echo '<p>' . count($assigned_agents) . '</p>';
   echo '<h1> Time </h1>';
   echo '<p>' . $row['ticket_register_time'] . '</p>';
   echo '<ul>';
    echo'<li><a href=' . $url1 . '>View Ticket</a></li>';
    echo'<li><a href=' . $url2 . '>Messages</a></li>';
    echo '<li><a href="#" onclick="confirmUnassignTicket(\'' . $url4 . '\');">Unassign ticket</a></li>';
    echo '<li><a href="#" onclick="confirmCloseTicket(\'' . $url3 . '\');">Close ticket</a></li>';
    echo '<li><a href="#" onclick="showModal(\'' . $url5 . '\');">Change Priority</a></li>';
   echo '</ul>';
   echo '<div id="myModal" class="modal">
   <div class="modal-content">
     <span class="close" onclick="closeModal()">&times;</span>
     <h2>Select Ticket Priority</h2>
     <p>Please select a priority for this ticket:</p>
     <form>
       <div class="priority-options">
         <label><input type="radio" name="priority" value="low"> Low</label>
         <label><input type="radio" name="priority" value="medium"> Medium</label>
         <label><input type="radio" name="priority" value="high"> High</label>
       </div>
       <input type="hidden" id="assignUrl">
       <button type="button" onclick="confirmPriority()">Confirm</button>
     </form>
   </div>
   </div>';
   echo '<script>
   function confirmCloseTicket(url) {
     if (confirm("Are you sure you want to close this ticket?")) {
      window.location.href = url;
     }
    }
    function confirmUnassignTicket(url) {
      if (confirm("Are you sure you want to unassign this ticket?")) {
       window.location.href = url;
      }
     }
     function showModal(url) {
      document.getElementById("myModal").style.display = "block";
      document.getElementById("assignUrl").value = url;
    }
    
    function closeModal() {
      document.getElementById("myModal").style.display = "none";
    }
    
    function confirmPriority() {
      const assignUrl = document.getElementById("assignUrl").value;
      const priority = document.querySelector("input[name=\'priority\']:checked").value;
      window.location.href = assignUrl + "&priority=" + priority;
    }
   </script>';
   echo '<hr>';
   echo '</div>';
  }
 }
 ?>
 <footer>
 <p>© Copyright 2021-2023 IT Ticket</p>
 <p><a href = "http://localhost:9000/privacy/privacy_policy.php">Privacy Policy</a></p>
</footer>
<script src="../js_files/click.js"></script>
<script src="../js_files/close_ticket_confirmation.js"></script>
<script src="../js_files/filter_form.js"></script>
</body>
<?php 
}
?>