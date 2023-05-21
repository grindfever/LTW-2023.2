<?php
session_start();
$conn = new PDO('sqlite:../database.db');
include('../filter_functions.php');
if(isset($_SESSION['username'])){
 if(isset($_SESSION['message'])) {
  echo '<script>alert("' . $_SESSION['message'] . '");</script>';
  unset($_SESSION['message']);
 if(isset($_SESSION['redirect'])){
  unset($_SESSION['redirect']);
 }
}
$stmt = $conn->prepare('SELECT * FROM Departments');
$stmt->execute();
$departments = $stmt->fetchAll();
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
  <h1 id = "active_tickets">Active Tickets</h1>
  <form action="#" method="POST" id = "ticket-filter-form">
  <label for="filter-type-select">Select Filter Type:</label>
  <select id="filter-type-select" name="filterType">
    <option value="none">None</option>
    <option value="department">Department</option>
    <option value="status">Status</option>
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

    <div id="status-filter" class="filter">
      <label for="status-select">Filter by Status:</label>
      <select id="status-select" name="statusValue">
        <option value="all">All</option>
        <option value="open">Open</option>
        <option value="assigned">Assigned</option>
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
$stmt = $conn->prepare('SELECT * FROM Tickets WHERE client_id = ? AND (ticket_status = ? OR ticket_status = ?)');
$client_id = $_SESSION['user_id'];
$ticket_status_1 = 'open';
$ticket_status_2 = 'assigned';
$stmt->bindParam(1,$client_id);
$stmt->bindParam(2,$ticket_status_1);
$stmt->bindParam(3,$ticket_status_2);
$stmt->execute();
$result = $stmt->fetchall();
$filteredTickets = $result;
 if (isset($_POST['apply-filter-button'])) {
  $filterType = $_POST['filterType'];
  $departmentValue = $_POST['departmentValue'];
  $statusValue = $_POST['statusValue'];
  $registrationtimeValue = $_POST['registrationtimeValue'];
  if ($filterType === 'department') {
    if ($departmentValue !== 'all') {
      $filteredTickets = filterTicketsByDepartment($result, $departmentValue);
    }
  } elseif ($filterType === 'status') {
    if ($statusValue !== 'all') {
      $filteredTickets = filterTicketsByStatus($result, $statusValue);
    }
  } elseif ($filterType === 'registration-time') {
    if ($registrationtimeValue !== 'all') {
      $filteredTickets = filterTicketsByRegistrationTime($result, $registrationtimeValue);
    }
  }
 }
foreach($filteredTickets as $row){
 $url1 = 'view_tickets.php?ticket_id=' . $row['ticket_id'];
 $url2 = '../messages/messages.php?ticket_id=' . $row['ticket_id'];
 $url3 = '../background/close_tickets.php?ticket_id=' . $row['ticket_id'];
 echo '<div class = active-ticket>';
 echo '<hr>';
 $stmt = $conn->prepare('SELECT department_name FROM Departments WHERE department_id = ?');
 $ticket_department_id = $row['ticket_department_id'];
 $stmt->bindParam(1,$ticket_department_id);
 $stmt->execute();
 $department_name = $stmt->fetchColumn();
 echo '<h1> ID </h1>';
 echo '<p>' . $row['ticket_id'] . '</p>';
 echo '<h1> Title </h1>';
 echo '<p>' . $row['ticket_title'] . '</p>';
 echo '<h1> Department </h1>';
 echo '<p>' . $department_name . '</p>';
 echo '<h1> Status </h1>';
 echo '<p>' . $row['ticket_status'] . '</p>';
 echo '<h1> Time </h1>';
 echo '<p>' . $row['ticket_register_time'] . '</p>';
 echo '<ul>';
  echo'<li><a href=' . $url1 . '>View Ticket</a></li>';
  echo'<li><a href=' .$url2 . '>Messages</a></li>';
  echo '<li><a href="#" onclick="confirmCloseTicket(\'' . $url3 . '\');">Close ticket</a></li>';
 echo '</ul>';
echo '<script>
function confirmCloseTicket(url) {
  if (confirm("Are you sure you want to close this ticket?")) {
   window.location.href = url;
  }
 }
 </script>';
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
 <script src="../js_files/filter_form.js"></script>
</body>
<?php
}
?>
