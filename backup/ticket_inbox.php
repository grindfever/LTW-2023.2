<?php
session_start();
$conn = new PDO('sqlite:../database.db');
function filterTickets($tickets, $departmentValue, $priorityValue, $statusValue) {
    if ($departmentValue !== 'all') {
      $tickets = array_filter($tickets, function ($ticket) use ($departmentValue) {
        return $ticket['department_id'] === $departmentValue;
      });
    }
  
    if ($priorityValue !== 'all') {
      $tickets = array_filter($tickets, function ($ticket) use ($priorityValue) {
        return $ticket['priority'] === $priorityValue;
      });
    }
  
    if ($statusValue !== 'all') {
      $tickets = array_filter($tickets, function ($ticket) use ($statusValue) {
        return $ticket['status'] === $statusValue;
      });
    }
  
    return $tickets;
  }
  
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
 $stmt = $conn->prepare('SELECT * FROM Departments');
 $stmt->execute();
 $departments = $stmt->fetchAll();
 $filteredTickets = $tickets;
  $departmentValue = isset($_POST['departmentValue']) ? $_POST['departmentValue'] : 'all';
  $priorityValue = isset($_POST['priorityValue']) ? $_POST['priorityValue'] : 'all';
  $statusValue = isset($_POST['statusValue']) ? $_POST['statusValue'] : 'all';
  
  $filteredTickets = filterTickets($tickets, $departmentValue, $priorityValue, $statusValue);
  
  echo json_encode([
    'activeTickets' => $filteredTickets
  ]);
 ?>
 <!DOCTYPE html>
<html>
 <head>
  <title>Staff Inbox</title>
  <link rel="stylesheet" href="../style.css">
  <link rel="import" href="http://localhost:9000/staff/choose_priority.php">
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
  <h1 id = "active_tickets">Inbox</h1>

  <label for="filter-type-select">Select Filter Type:</label>
  <select id="filter-type-select" name="filterType">
    <option value="none">None</option>
    <option value="department">Department</option>
    <option value="priority">Priority</option>
    <option value="status">Status</option>
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
      <select id="priority-select" name="priorityValue">
        <option value="all">All</option>
        <option value="high">High</option>
        <option value="medium">Medium</option>
        <option value="low">Low</option>
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
  <?php
 foreach($filteredTickets as $row){
  $url1 = '../tickets/view_tickets.php?ticket_id=' . $row['ticket_id'];
  $url2 = '../background/assignments.php?ticket_id=' . $row['ticket_id'];
  $url3 = '../background/staff_close_tickets.php?ticket_id=' . $row['ticket_id'];
  $url4 = '../background/transfer_ticket_department.php?ticket_id=' . $row['ticket_id'];
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
  if($row['ticket_status'] == 'assigned'){
   echo '<h1> Priority </h1>';
   echo '<p>' . $row['ticket_priority'] . '</p>';
  }
  echo '<h1> Time </h1>';
  echo '<p>' . $row['ticket_register_time'] . '</p>';
  echo '<ul>';
   echo'<li><a href=' . $url1 . '>View Ticket</a></li>';
   if($row['ticket_status'] == 'open'){
    echo '<li><a href="#" onclick="showModal(\'' . $url2 . '\');">Assign Ticket</a></li>';
   }
   else{
    echo '<li><a href=' . $url2 . '>Assign Ticket</a></li>';
   }
   echo '<li><a href="#" onclick="showModal1(\'' . $url4 . '\');">Transfer ticket</a></li>';
   echo '<li><a href="#" onclick="confirmCloseTicket(\'' . $url3 . '\');">Close ticket</a></li>';
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
echo '<div id="DepartmentModal" class="modal1">
<div class="modal-content1">
  <span class="close" onclick="closeModal1()">&times;</span>
  <h2>Ticket Department</h2>
  <p>Select which department you wish to transfer this ticket to:</p>
  <form>
    <div class="department-options">
      <label><input type="radio" name="department" value=746>Hardware Technical Support</label>
      <label><input type="radio" name="department" value=745>Software Technical Support</label>
      <label><input type="radio" name="department" value=751>App Development</label>
      <label><input type="radio" name="department" value=750>Web Development</label>
      <label><input type="radio" name="department" value=747>Network Support</label>
      <label><input type="radio" name="department" value=749>Security Issues</label>
      <label><input type="radio" name="department" value=748>Customer Service</label>
      <input type="hidden" id="assignUrl1">
      <button type="button" onclick="confirmDepartment()">Confirm</button>
    </div>
  </form>
</div>
</div>';
echo '<script>
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
function showModal1(url) {
  document.getElementById("DepartmentModal").style.display = "block";
  document.getElementById("assignUrl1").value = url;
}

function closeModal1() {
  document.getElementById("DepartmentModal").style.display = "none";
}

function confirmDepartment() {
  const assignUrl = document.getElementById("assignUrl1").value;
  const department = document.querySelector("input[name=\'department\']:checked").value;
  window.location.href = assignUrl + "&department=" + department;
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
<script src="../js_files/filters.js"></script>
</body>
<?php 
}
?>