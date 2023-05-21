<?php
session_start();
$conn = new PDO('sqlite:../database.db');
if(isset($_SESSION['username'])){
 $stmt = $conn->prepare('SELECT * FROM FAQS');
 $stmt->execute();
 $faqs = $stmt->fetchAll();
 include('../search_words.php');
 ?>
<!DOCTYPE html>
 <html>
  <head>
   <title>FAQ</title>
   <link rel = "stylesheet" href = "../style.css">
  </head>
  <body>
  <header class = "header1">
    <h1>IT Ticket<h1>
    <h2>Here to help you solve all your tech problems!</h2>
    <a href="http://localhost:9000/main.php" class="home-button"><img src="../images/home_icon.png" alt="Home"></a>
   <div id = "Login">
   <p><?php echo $_SESSION['username']; ?></p>
   </div>
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
  <div class="search-bar">
   <form method="POST" action="#">
    <input type="text" id="search-input" name="keyword" placeholder="Search FAQs with keywords or hashtags...">
    <button type="submit" id = "search-button">Search</button>
   </form>
  </div>
  <div class="faq-description">
   <p>Welcome to our FAQ page where you can find answers to commonly asked questions about our services.</p>
   <p>If you don't see your question listed here, feel free to reach out to our support team for further assistance.</p>
  </div>
 <?php
 echo '<div id = faq_content>';
 $faqs = array_reverse($faqs);
 if($_SERVER['REQUEST_METHOD'] == 'POST'){
  $keyword = $_POST['keyword'];
  $faqs = search_for_keywords($keyword,$faqs);
 }
 foreach($faqs as $faq){
  echo '<div class = "faq-show">';
   echo '<h1 id = "faq_show_question">' . $faq['question'] . '</h1>';
   $paragraphs = explode("\n\n", $faq['answer']);
   foreach ($paragraphs as $paragraph){
    echo '<p id = "faq_show_answer">' . $paragraph . '</p>';
   }
   echo '<div class="faq-buttons">';
    echo '<button class="upvote-btn">Upvote</button>';
    echo '<button class="downvote-btn">Downvote</button>';
    echo '<button class="copy-btn">Copy</button>';
    echo '</div>';
   echo '</div>';
 }
 echo '</div>';
?>
<footer>
 <p>© Copyright 2021-2023 IT Ticket</p>
 <p><a href = "http://localhost:9000/privacy/privacy_policy.php">Privacy Policy</a></p>
</footer>
<script src="../js_files/click.js"></script>
</body>
<?php
}
?>