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
    <form method= "POST" action = "#">
     <h1 id = "ticket-form">New Ticket</h1>
     <div class = "ticket-info">
      <div class = "title-input-box">
        <span class = "title">Title</span>
        <input type = "text" id = "ticket_title" name = "title">
      </div>
        <label for="Department">Choose a department:</label>
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
        <span class = "description">Description</span>
        <textarea class = "description-text" id = "description_text" name = "description"></textarea>
      </div>
      <div class = "submission">
        <input type = "submit" name = "submit" value = "Submit">
      </div>
     </div>
     <?php
       if(isset($_POST['submit'])){
        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
         $client_id = $_SESSION['user_id'];
         $ticket_title = $_POST['title'];
         $ticket_department = $_POST['department'];
         $description = $_POST['description'];
         $ticket_description = add_paragraphs($_POST['description']);
         $ticket_status = 'open';
         $time = date('d/m/Y H:i');
         ;
         if(!empty($ticket_title) and !empty($description)){
          try{
          $stmt = $conn->prepare('SELECT department_id FROM Departments WHERE department_name = ?');
          $stmt->bindParam(1,$ticket_department);
          $stmt->execute();
          $ticket_department_id = $stmt->fetchColumn();
          $stmt = $conn->prepare('INSERT INTO Tickets(client_id,ticket_title,ticket_description,ticket_department_id,ticket_status,ticket_register_time) VALUES(?,?,?,?,?,?)');
          $stmt->bindParam(1,$client_id);
          $stmt->bindParam(2,$ticket_title);
          $stmt->bindParam(3,$ticket_description);
          $stmt->bindParam(4,$ticket_department_id);
          $stmt->bindParam(5,$ticket_status);
          $stmt->bindParam(6,$time);
          $stmt->execute();
          $_SESSION['message'] = 'Your ticket was successfully submitted';
          ob_clean();
          header('Location: ticket-form.php');
          exit();
         }
         catch (PDOException $e) {
          echo 'Error: ' . $e->getMessage();
        }
        }
         else{
          $_SESSION['message'] = 'You must fill in all the required fields!';
          ob_clean();
          header('Location: ticket-form.php');
          exit();
         }
        }
       }
       if(isset($_SESSION['message'])){
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