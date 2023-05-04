<?php
$conn = new PDO('sqlite:../database.db');
session_start();
if(isset($_SESSION['username'])){
?>

<!DOCTYPE html>
<html>
<head>
    <title>Software Tech Support</title>
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
    <section>
    <div class="Department">
    <h2>Software Technical Support</h2>
    <p>Our software technical support team is here to assist you with any technical problems you may encounter while using our software products. Our main goal is to ensure that our customers have a seamless and enjoyable experience using our products.</p>
    <h3>Services we offer:</h3>
    <ul>
      <li>Installation and configuration support</li>
      <li>Troubleshooting and issue resolution</li>
      <li>Software updates and upgrades</li>
      <li>Training and support for new software features</li>
    </ul>
    <h3>Our approach</h3>
    <p>Our approach to software technical support is customer-focused. We understand that every customer has unique needs, and we strive to provide personalized and efficient solutions to every problem. Our team is dedicated to delivering high-quality technical support services that meet the needs of our customers.</p>
    <h3>Our team:</h3>
    <p>Our software technical support team consists of experienced professionals with extensive knowledge of our products and services. We have a team of experts who specialize in different areas of software development, which allows us to provide comprehensive technical support services. Our team is dedicated to providing prompt and effective solutions to any technical problems our customers may encounter.</p>
    <?php
     $stmt = $conn->prepare('SELECT department_admin_id FROM Departments WHERE department_name = ?');
     $d_name = "Software Technical Support";
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
      <p>If you need extra technical support, or wish to make any complaint or special request to our department please do not hesitate to contact our admin.</p>
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
</section>
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