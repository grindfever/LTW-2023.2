<?php 
session_start();
$conn = new PDO('sqlite:../database.db');
if(isset($_SESSION['message'])){
 echo '<script>alert("' . $_SESSION['message'] . '");</script>';
 unset($_SESSION['message']);
}
function count_ticket_number($user_id,$conn){
 $stmt = $conn->prepare('SELECT * FROM Tickets WHERE client_id = ? AND ticket_status != ?');
 $stmt->bindParam(1,$user_id);
 $status = 'closed';
 $stmt->bindParam(2,$status);
 $stmt->execute();
 $myTickets = $stmt->fetchAll();
 return count($myTickets);
}
function count_assigned_ticket_number($user_id,$conn){
 $stmt = $conn->prepare('SELECT * FROM Assignments WHERE user_id = ?');
 $stmt->bindParam(1,$user_id);
 $stmt->execute();
 $myAssignedTickets = $stmt->fetchAll();
 return count($myAssignedTickets);
}
if(isset($_SESSION['message'])){
 echo '<script>alert("' . $_SESSION['message'] . '");</script>';
 unset($_SESSION['message']);
}
if(isset($_SESSION['username']) && $_SESSION['usertype'] == 'admin'){
 ?>
 <!DOCTYPE html>
<html>
 <head>
  <title>User Managment</title>
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
 <?php
 if($_SESSION['admin_type'] == 'main admin'){
  $stmt = $conn->prepare('SELECT * FROM Users');
  $stmt->execute();
  $users = $stmt->fetchAll();
 }
 else{
    $stmt = $conn->prepare('SELECT * FROM Users WHERE usertype = ?');
    $client_usertype= 'client';
    $stmt->bindParam(1,$client_usertype);
    $stmt->execute();
    $users = $stmt->fetchAll();
    $stmt = $conn->prepare('SELECT department_id FROM Admins WHERE admin_id = ?');
    $admin_id = $_SESSION['user_id'];
    $stmt->bindParam(1,$admin_id);
    $stmt->execute();
    $my_d_id = $stmt->fetchColumn();
    $stmt = $conn->prepare('SELECT * FROM Agents WHERE department_id = ?');
    $stmt->bindParam(1,$my_d_id);
    $stmt->execute();
    $agents = $stmt->fetchAll();
    foreach($agents as $agent){
     $stmt = $conn->prepare('SELECT * FROM Users WHERE user_id = ?');
     $agent_user_id = $agent['agent_id'];
     $stmt->bindParam(1,$agent_id);
     $stmt->execute();
     $new_user = $stmt->fetch();
     $users[] = $new_user;
    }
 }
 echo '<table>';
 echo "<tr><th>ID</th><th>Username</th><th>Email</th><th>Name</th><th>Usertype</th><th>RegistrationTime</th><th>LastLogin</th><th>DepartmentName</th><th>StarPoints</th><th>ActiveTickets</th><th>AssignedTickets</th><th>AdminActions</th></tr>";
 foreach($users as $user){
  echo '<tr>';
  echo '<td>' . $user['user_id'] . '</td>';
  echo '<td>' . $user['username'] . '</td>';
  echo '<td>' . $user['email'] . '</td>';
  echo '<td>' . $user['first_name'] .  " " . $user['last_name'] . '</td>';
  echo '<td>' . $user['usertype'] . '</td>';
  echo '<td>' . $user['registration_time'] . '</td>';
  $stmt = $conn->prepare('SELECT login_time FROM Logins WHERE user_id = ?');
  $stmt->bindParam(1,$user['user_id']);
  $stmt->execute();
  $user_login_time = $stmt->fetchColumn();
  echo '<td>' . $user_login_time . '</td>';
  if($user['usertype'] == 'agent'){
   $stmt = $conn->prepare('SELECT * FROM Agents WHERE agent_id = ?');
   $stmt->bindParam(1,$user['user_id']);
   $stmt->execute();
   $user_role_data = $stmt->fetch();
   $user_department_id = $user_role_data['department_id'];
   $user_star_points = $user_role_data['star_points'];
   $stmt = $conn->prepare('SELECT department_name FROM Departments WHERE department_id = ?');
   $stmt->bindParam(1,$user_department_id);
   $stmt->execute();
   $user_department_name = $stmt->fetchColumn();
   echo "<td>" . $user_department_name . "</td>";
   echo "<td>" . $user_star_points . "</td>";
   echo '<td>' . count_ticket_number($user['user_id'],$conn) . '</td>';
   echo '<td>' . count_assigned_ticket_number($user['user_id'],$conn) . '</td>';
  }
  elseif($user['usertype'] == 'admin'){
   $stmt = $conn->prepare('SELECT * FROM Admins WHERE admin_id = ?');
   $stmt->bindParam(1,$user['user_id']);
   $stmt->execute();
   $user_role_data = $stmt->fetch();
   $user_department_id = $user_role_data['department_id'];
   $user_star_points = $user_role_data['star_points'];
   $stmt = $conn->prepare('SELECT department_name FROM Departments WHERE department_id = ?');
   $stmt->bindParam(1,$user_department_id);
   $stmt->execute();
   $user_department_name = $stmt->fetchColumn();
   echo '<td>' . $user_department_name . '</td>';
   echo '<td>' . $user_star_points . '</td>';
   echo '<td>' . count_ticket_number($user['user_id'],$conn) . '</td>';
   echo '<td>' . count_assigned_ticket_number($user['user_id'],$conn) . '</td>';
  }
  elseif($user['usertype'] == 'client'){
   $user_department_name = 'N/A';
   $user_star_points = 'N/A';
   echo '<td>' . $user_department_name . '</td>';
   echo '<td>' .$user_star_points . '</td>';
   echo '<td>' . count_ticket_number($user['user_id'],$conn) . '</td>';
   echo '<td> N/A </td>';
  }
  ?>
  <td id = "admin_actions">
   <?php
   if($user['usertype'] == 'agent'){
   ?>
   <?php echo '<button id = "managment" onclick="showModal2(' . $user['user_id'] . ')">Promote</button>'; ?>
   <?php echo '<button id = "managment" onclick="confirmPerformAction(\'demotion\', '.$user['user_id'].')">Demote</button>'; ?>
   <?php echo '<button id = "managment" onclick="confirmPerformAction(\'ban\', '.$user['user_id'].')">Ban</button>'; ?>
   <?php echo '<button id = "managment" onclick="showModal(' . $user['user_id'] . ')">Transfer</button>'; ?>
   <?php
   }
   if($user['usertype'] == 'client'){
   ?>
   <?php echo '<button id="managment" onclick="showModal1(' . $user['user_id'] . ')">Promote</button>'; ?>
   <?php echo '<button id = "managment" onclick="confirmPerformAction(\'ban\', '.$user['user_id'].')">Ban</button>'; ?>
   <?php
   }
   if($user['usertype'] == 'admin'){
   ?>
   <?php echo '<button id = "managment" onclick="confirmPerformAction(\'demotion\', '.$user['user_id'].')">Demote</button>'; ?>
   <?php echo '<button id = "managment" onclick="showModal(' . $user['user_id'] . ')">Transfer</button>'; ?>
   <?php
   }
   ?>
  </td>
  <div id="UserDepartmentModal" class="modal1">
<div class="modal-content1">
  <span class="close" onclick="closeModal()">&times;</span>
  <h2>New User Department</h2>
  <p>Select which department you wish to transfer this user to:</p>
  <form>
    <div class="department-options">
      <label><input type="radio" name="department" value=746>Hardware Technical Support</label>
      <label><input type="radio" name="department" value=745>Software Technical Support</label>
      <label><input type="radio" name="department" value=751>App Development</label>
      <label><input type="radio" name="department" value=750>Web Development</label>
      <label><input type="radio" name="department" value=747>Network Support</label>
      <label><input type="radio" name="department" value=749>Security Issues</label>
      <label><input type="radio" name="department" value=748>Customer Service</label>
      <input type="hidden" id="assignUrl">
      <button type="button" onclick="chooseNewDepartment('transfer', <?php echo $user['user_id']; ?>)">Confirm</button>
    </div>
  </form>
</div>
</div>
<div id="NewAgentModal" class="modal1">
<div class="modal-content1">
  <span class="close" onclick="closeModal()">&times;</span>
  <h2>New User Department</h2>
  <p>Select which department you wish to assign to this new agent:</p>
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
      <button type="button" onclick="chooseNewDepartment('promotion', <?php echo $user['user_id']; ?>)">Confirm</button>
    </div>
  </form>
</div>
</div>
<div id="NewAdminModal" class="modal1">
<div class="modal-content1">
  <span class="close" onclick="closeModal()">&times;</span>
  <h2>New User Department</h2>
  <p>Select which type of admin you wish this agent to be:</p>
  <form>
    <div class="department-options">
     <label><input type="radio" name="admin_type" value="main admin">Main Admin</label>
     <label><input type="radio" name="admin_type" value="local admin">Local Admin</label>
     <input type="hidden" id="assignUrl2">
     <button type="button" onclick="chooseAdminType(<?php echo $user['user_id']; ?>)">Confirm</button>
    </div>
  </form>
</div>
</div>
  <?php
  echo "</tr>";
 }
 echo '</table>';
?>
<footer>
 <p>© Copyright 2021-2023 IT Ticket</p>
 <p><a href = "http://localhost:9000/privacy/privacy_policy.php">Privacy Policy</a></p>
</footer>
<script src = "../js_files/management_functions.js"></script>
<script src="../js_files/click.js"></script>
</body>
</html>
<?php
}
?>
