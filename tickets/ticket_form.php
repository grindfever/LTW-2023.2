<?php
session_start();
ob_start();
$conn = new PDO('sqlite:../database.db');
if(isset($_SESSION['username'])){
 function add_paragraphs($input) {
  $paragraphs = explode("\n", $input);
  $output = '';
  foreach ($paragraphs as $paragraph) {
   $output .= "<p>$paragraph</p>";
  }
  return $output;
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
  <div class = "ticket-form">
    <form method= "POST" action = "submit_form.php">
     <h1 id = "ticket-form">New Ticket</h1>
     <div class = "ticket-info">
        <div class="ticket-input-box">
          <label><b>Title</b></label>
          <input type="text" name="title">
        </div>
        <div class="ticket-input-box">
          <label><b>Priority</b></span>
          <input type="text" id="ticket_priority" name="priority">
        </div>
        <div class="ticket-input-box">
          <label><b>Hashtag</b></label>
          <input type="text" id="ticket_hashtag" name="hashtag">
        </div>
        <label for="Department"><b>Choose a department:</b></label>
        <select name="department" id="department">
          <option value="Software Technical Support">Software Technical Support</option>
          <option value="Hardware Technical Support">Hardware Technical Support</option>
          <option value="Costumer Service">Costumer Service</option>
          <option value="Web Development">Web Development</option>
          <option value="App Development">App Development</option>
          <option value="Network Support">Network Support</option>
          <option value="Security Issues">Security Issues</option>
        </select>
        <div class = "description-input-box">
          <label><b>Description</b></label>
          <textarea class = "description-text" id = "description_text" name = "description"></textarea>
        </div>
        <div class = "submission">
          <input type = "submit" name = "submit" value = "Submit">
        </div>
     </div>
     <?php
      if(isset($_SESSION['message'])) {
        echo '<p>' . $_SESSION['message'] . '</p>';
        unset($_SESSION['message']);
      }
     ?>
    </form>
  </div>
  <footer>
    <p>© Copyright 2021-2023 IT Ticket</p>
    <p><a href = "http://localhost:9000/privacy/privacy_policy.php">Privacy Policy</a></p>
   </footer>
  <script src="../js_files/click.js"></script>
  <script src="../js_files/save_ticket_input.js"></script>
 </body>
</html>
<?php
}
?>