<?php
$conn = new PDO('sqlite:../database.db');
session_start();
if(isset($_SESSION['username'])){
?>

<!DOCTYPE html>
<html>
<head>
    <title>Hardware Tech Support</title>
    <link rel = "stylesheet" href = "../style.css">
   </head>
   <body>
    <header class = "header1">
      <h1>Trouble Tickets<h1>
      <h2>Here to help you solve all your tech problems!</h2>
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
  <div class="Department">
    <h2>Hardware Technical Support</h2>
    <p>Welcome to the Hardware Technical Support department! Our team of experts is here to help you with all of your hardware-related issues, from computer crashes to printer malfunctions.</p>
    <p>We understand that technology problems can be frustrating, but we are dedicated to providing you with prompt and effective solutions to get you back to work as quickly as possible. Our team is trained to handle a wide variety of hardware issues, so no matter what the problem is, we are confident we can help.</p>
    <h3>Services we offer</h3>
    <ul>
      <li>Diagnosing and repairing computer hardware issues</li>
      <li>Fixing printer and scanner problems</li>
      <li>Installation and configuration of hardware components</li>
      <li>Assistance with hardware-related software issues</li>
      <li>Recommendations for hardware upgrades and replacements</li>
    </ul>
    <h3>How to request support</h3>
    <p>If you are experiencing a hardware issue, you can submit a support ticket through our website by navigating to the "Tickets" section and selecting "New Ticket." Be sure to provide as much detail as possible about the issue you are experiencing so that we can diagnose and resolve the problem quickly.</p>
    <p>Alternatively, you can reach out to us directly by calling our support hotline at 555-1234. Our team is available to take your call 24/7 and will work with you to resolve your issue as quickly as possible.</p>
    <h3>Our team:</h3>
    <p>Our team comprises certified hardware experts who have years of experience in providing technical support for hardware components and devices. They possess excellent analytical and problem-solving skills, and they are always up-to-date with the latest advancements in hardware technology. Our team is dedicated to providing the best possible support to our customers.</p>
    <?php
     $stmt = $conn->prepare('SELECT department_admin_id FROM Departments WHERE department_name = ?');
     $d_name = "Hardware Technical Support";
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
      <p>If you need extra technical support for your hardware components or devices or have any complaints or special requests to make, please contact our admin.</p>
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
  <script src = "../js_files/click.js"></script>
  </body>
</html> 
<?php
}
?>