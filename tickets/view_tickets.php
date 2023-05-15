<?php
session_start();
$conn = new PDO('sqlite:../database.db');
$stmt = $conn->prepare('SELECT client_id from Tickets WHERE ticket_id = ?');
$verification_ticket_id = $_GET['ticket_id'];
$stmt->bindParam(1,$verification_ticket_id);
$stmt->execute();
$client_id = $stmt->fetchColumn();
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

if((isset($_SESSION['username']) && $_SESSION['user_id'] == $client_id) || ($_SESSION['usertype'] == 'admin' && $_SESSION['admin_type'] == 'main admin') || ($_SESSION['usertype'] == 'admin' && $_SESSION['admin_type'] == 'local admin' && $ticket_department_id == $verification_ticket_department_id_admins) || ($_SESSION['usertype'] == 'admin' && $_SESSION['admin_type'] == 'main admin') || ($_SESSION['usertype'] == 'agent' && $ticket_department_id == $verification_ticket_department_id_agents)){
 if(isset($_GET['ticket_id'])){
  $_SESSION['ticket_id'] = $_GET['ticket_id'];
  $ticket_id = $_SESSION['ticket_id'];
  $stmt = $conn->prepare('SELECT * FROM Tickets WHERE ticket_id = ?');
  $stmt->bindParam(1,$ticket_id);
  $stmt->execute();
  $ticket = $stmt->fetch();
  $stmt = $conn->prepare('SELECT department_name FROM Departments WHERE department_id = ?');
  $department_id = $ticket['ticket_department_id'];
  $stmt->bindParam(1,$department_id);
  $stmt->execute();
  $ticket_department_name = $stmt->fetchColumn();
  $ticket['ticket_description'] = strip_tags($ticket['ticket_description'], '<br>');
  $ticket['ticket_description'] = str_replace('<br>', "\n", $ticket['ticket_description']);
  $ticket['ticket_description'] = nl2br($ticket['ticket_description']);
  $ticket['ticket_description'] = '<p>' . str_replace("\n\n", '</p><p>', $ticket['ticket_description']) . '</p>';
  $ticket['ticket_description'] = strip_tags($ticket['ticket_description'],'<br>');
  $ticket['ticket_description'] = strip_tags($ticket['ticket_description'],'</br>');


  ?>
 <html>
 <head>
  <title>View Ticket</title>
  <link rel="stylesheet" href="../style.css">
 </head>
 <body>
  <header class = "header1">
    <h1>IT Ticket<h1>
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
          <li><a href="http://localhost:9000/departments/costumer-service.php">Costumer Service</a></li>
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
  <div class = "ticket-form">
  <form>
    <h1 id = "ticket-form">My Ticket</h1>
    <div class = "ticket-info">
      <div class = "title-input-box">
        <span class = "title">Title</span>
        <input type = "text" name = "title" value="<?php echo $ticket['ticket_title']; ?>" disabled>
      </div>
      <div class="department-input-box">
       <span class="department">Department</span>
       <select name="department" disabled>
        <option value="Software Technical Support" <?php if ($ticket_department_name == 'Software Technical Support') echo 'selected'; ?>>Software Technical Support</option>
        <option value="Hardware Technical Support" <?php if ($ticket_department_name == 'Hardware Technical Support') echo 'selected'; ?>>Hardware Technical Support</option>
        <option value="Costomer Service" <?php if ($ticket_department_name == 'Costumer Service') echo 'selected'; ?>>Costomer Service</option>
        <option value="Network Support" <?php if ($ticket_department_name == 'Network Support') echo 'selected'; ?>>Network Support</option>
        <option value="Security Issues" <?php if ($ticket_department_name == 'Security Issues') echo 'selected'; ?>>Security Issues</option>
        <option value="App Development" <?php if ($ticket_department_name == 'App Development') echo 'selected'; ?>>App Development</option>
        <option value="Web Development" <?php if ($ticket_department_name == 'Web Development') echo 'selected'; ?>>Web Development</option>
       </select>
      </div>

      <div class = "description-input-box">
        <span class = "description">Description</span>
        <textarea class = "description-text" name = "description" disabled><?php echo $ticket['ticket_description']; ?></textarea>
      </div>
      <div class = "submission">
        <input type = "submit" name = "submit" value = "Submit" disabled>
      </div>
    </div>
  </form>
</div>
<footer>
 <p>© Copyright 2021-2023 IT Ticket</p>
 <p><a href = "http://localhost:9000/privacy/privacy_policy.php">Privacy Policy</a></p>
 </footer>
 <script src="../js_files/click.js"></script>
 </body>
</html> 
<?php
 }
}
?>

  