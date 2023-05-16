<?php
$conn = new PDO('sqlite:../database.db');
session_start();
if(isset($_SESSION['username'])){
?>

<!DOCTYPE html>
<html>
<head>
    <title>Security Issues</title>
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
             <li><a href="http://localhost:9000/management/customer-service.php">Costomer Service</a></li>
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
            <h2>Security Issues Department</h2>
            <p>Our department is responsible for ensuring the security of our organization's systems and data. We work to prevent security breaches, protect sensitive information, and respond to security incidents. Our team is composed of experienced security professionals who are trained in the latest security technologies and practices.</p>
            <h3>Services we offer:</h3>
            <ul>
                <li>Security assessments and audits</li>
                <li>Security incident response</li>
                <li>Vulnerability management</li>
                <li>Penetration testing</li>
                <li>Security training and awareness</li>
            </ul>
            <h3>Our approach</h3>
            <p>Our approach to security is proactive and holistic. We take a multi-layered approach to security, utilizing a combination of technical controls, policies and procedures, and employee education and awareness. We work closely with other departments to ensure that security is integrated into all aspects of our organization's operations.</p>
            <h3>Our team:</h3>
            <p>Our team is composed of experienced security professionals who hold industry certifications such as CISSP, CISM, and CISA. Our team members have expertise in a wide range of security technologies and practices, including network security, application security, and cloud security.</p>
    <?php
     $stmt = $conn->prepare('SELECT department_admin_id FROM Departments WHERE department_name = ?');
     $d_name = "Security Issues";
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
            <p>If you have any extra security concerns or questions or simply wish to make a complaint or special request to our department, please do not hesitate to contact our admin.</p>
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