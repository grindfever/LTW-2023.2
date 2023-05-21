<?php
session_start();
ob_start();
$conn = new PDO('sqlite:../database.db');
if(isset($_SESSION['username']) && ($_SESSION['usertype'] == 'admin' || $_SESSION['usertype'] == 'agent')){
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
        <li><a href="http://localhost:9000/faq.php">FAQS</a></li>
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
  <div class="faq-form">
    <h2>FAQ Form</h2>
    <form action="#" method="POST">
      <div class="form-group">
        <label for="question">Question:</label>
        <input type="text" id="question" name="question">
      </div>
      <div class="form-group">
        <label for="answer">Answer:</label>
        <textarea id="answer" name="answer" rows="7"></textarea>
      </div>
      <div class="form-group">
        <input type="submit" value="Submit" name = "faq_submit" class="faq-submit">
      </div>
    </form>
    <?php
     if(isset($_SESSION['message'])){
      echo '<p>' . $_SESSION['message'] . '</p>';
      unset($_SESSION['message']);
     }
    ?>
  </div>
  <?php
   if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $question = $_POST['question'];
    $answer = $_POST['answer'];
    $question = filter_var($question, FILTER_SANITIZE_STRING);
    $answer = filter_var($answer, FILTER_SANITIZE_STRING);
    $question = trim($question);
    $answer = trim($answer);
    $answer_w_paragraphs = add_paragraphs($answer);
    if(empty($answer) || empty($question)){
     $_SESSION['message'] = 'You have post both a question and an answer to such question! Please try again!';
     ob_clean();
     header('Location:faq_insertion.php');
     exit();
    }
    else{
     $stmt = $conn->prepare('INSERT INTO FAQS(question,answer) VALUES(?,?)');
     $stmt->bindParam(1,$question);
     $stmt->bindParam(2,$answer_w_paragraphs);
     $stmt->execute();
     $_SESSION['message'] = 'The FAQ database has been successfully updated with your question!';
     ob_clean();
     header('Location:faq_insertion.php');
     exit();
    }
   }
   ?>
   <footer>
    <p>© Copyright 2021-2023 IT Ticket</p>
    <p><a href = "http://localhost:9000/privacy/privacy_policy.php">Privacy Policy</a></p>
   </footer>
   <script src="../js_files/click.js"></script>
   <script src="../js_files/save_faq_input.js"></script>
<?php
}
?>