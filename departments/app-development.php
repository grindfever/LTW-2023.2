<?php
$conn = new PDO('sqlite:../database.db');
session_start();
if(isset($_SESSION['username'])){
?>
<!DOCTYPE html>
<html>
<head>
    <title>App Development</title>
    <link rel = "stylesheet" href = "../style.css">
   </head>
   <body>
    <header class = "header1">
<<<<<<< Updated upstream
      <h1>IT Ticket<h1>
      <h2>Here to help you solve all your tech problems!</h2>
      <a href="http://localhost:9000/main.php" class="home-button"><img src="../images/home_icon.png" alt="Home"></a>
=======
    <h1>IT Ticket<h1>
    <h2>Here to help you solve all your tech problems!</h2>
    <a href="http://localhost:9000/main.php" class="home-button"><img src="../images/home_icon.png" alt="Home"></a>
<<<<<<< Updated upstream
>>>>>>> Stashed changes
=======
>>>>>>> Stashed changes
      <div id = "login">
      <?php
       echo '<p>' . $_SESSION['username'] . '</p>';
      ?>
      </div>
      <img src = "" alt = "">
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
          <li><a href="http://localhost:9000/departments/customer-service.php">Customer Service</a></li>
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
             <li><a href="http://localhost:9000/management/customer-service.php">Customer Service</a></li>
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
  <div class="Department">
    <h2>App Development Department</h2>
    <p>Our App Development team is dedicated to creating mobile applications that are intuitive, user-friendly, and efficient. We develop apps for both iOS and Android platforms, using the latest technologies and best practices to ensure the best user experience.</p>
    <h3>Services we offer:</h3>
    <ul>
      <li>Custom mobile app development</li>
      <li>App maintenance and updates</li>
      <li>App integration with other systems</li>
      <li>App testing and quality assurance</li>
      <li>App deployment and support</li>
    </ul>
    <h3>Our approach:</h3>
    <p>We believe in a collaborative approach to app development, working closely with our clients to understand their needs, goals, and user expectations. We follow a user-centric design process, focusing on the end-users and their needs throughout the development cycle.</p>
    <h3>Our team:</h3>
    <p>Our team consists of experienced mobile app developers, designers, and project managers who are passionate about delivering high-quality apps that meet the needs of our clients and their users. We have a proven track record of delivering successful mobile apps across various industries.</p>
    <?php
     $stmt = $conn->prepare('SELECT department_admin_id FROM Departments WHERE department_name = ?');
     $d_name = "App Development";
     $stmt->bindParam(1,$d_name);
     $stmt->execute();
     $admin_id = $stmt->fetchColumn();
     $stmt = $conn->prepare('SELECT star_points FROM Admins Where admin_id = ? ');
     $stmt->bindParam(1,$admin_id);
     $stmt->execute();
     $star_points = $stmt->fetchColumn();
     $stmt = $conn->prepare('SELECT * FROM Users WHERE user_id = ?');
     $stmt->bindParam(1,$admin_id);
     $stmt->execute();
     $data = $stmt->fetch();
     $admin_email = $data['email'];
     $admin_username = $data['username'];
     $admin_phone_number = $data['phone_number'];
     $admin_name = $data['first_name'] . ' ' . $data['last_name'];
    ?>
    <div class="Contact">
      <h3>Contact us:</h3>
      <p>If you have any questions, would like to discuss your app development project in more detail or simply any complaint or special request to make about our department, please don't hesitate to contact our admin.</p>
      <ul>
       <?php
        echo '<li>Name: ' . $admin_name . '</li>';
        echo '<li>Email: ' . $admin_email . '</li>';
        echo '<li>Phone Number: ' . $admin_phone_number . '</li>';
        echo '<li>Star Points: ' . $star_points . ' stars </li>';
       ?>
       </ul>
    </div>
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
?>