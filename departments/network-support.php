<?php
$conn = new PDO('sqlite:../database.db');
session_start();
if(isset($_SESSION['username'])){
?>

<!DOCTYPE html>
<html>
<head>
    <title>Network Support</title>
    <link rel = "stylesheet" href = "../style.css">
   </head>
   <body>
    <header class = "header1">
    <h1>IT Ticket<h1>
    <h2>Here to help you solve all your tech problems!</h2>
    <a href="http://localhost:9000/main.php" class="home-button"><img src="images/home_icon.png" alt="Home"></a>
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
      <h2>Network Support Department</h2>
      <p>The Network Support Department is responsible for providing technical support and maintaining the company's network infrastructure. Our main goal is to ensure that the company's network operates efficiently and securely, and that any issues or problems are addressed promptly.</p>
      <h3>Services we offer:</h3>
      <ul>
       <li>Network design and implementation</li>
       <li>Network troubleshooting and problem resolution</li>
       <li>Network security assessments and risk management</li>
       <li>Network performance optimization</li>
       <li>Network maintenance and upgrades</li>
      </ul>
      <h3>Our approach</h3>
      <p>Our approach to network support is based on a proactive and preventative mindset. We aim to identify and address potential issues before they become major problems, and to continuously monitor and optimize the network to ensure maximum efficiency and security.</p>
      <h3>Our team:</h3>
      <p>Our team of network support specialists has extensive experience and expertise in network design, implementation, and maintenance. We stay up-to-date with the latest technologies and trends in network support to ensure that we can provide the best possible service to our clients.</p>
    <?php
     $stmt = $conn->prepare('SELECT department_admin_id FROM Departments WHERE department_name = ?');
     $d_name = "Network Support";
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
        <p>If you have any extra questions or concerns regarding the company's network, as well as any complaints or special requests about our department, please do not hesitate to contact our admin:</p>
        <ul>
        <?php
        echo '<li>Name: ' . $admin_name . '</li>';
        echo '<li>Email: ' . $admin_email . '</li>';
        echo '<li>Phone Number: ' . $admin_phone_number . '</li>';
        echo '<li>Star Points: ' . $star_points . ' stars </li>';
       ?>
        <li>Office hours: Monday-Friday, 9am-5pm</li>
        </ul>
      </div>
  </div>
</section>
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
