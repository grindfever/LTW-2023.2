<?php
$conn = new PDO('sqlite:database.db');
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Main Page</title>
    <link rel = "stylesheet" href = "../style.css">
   </head>
   <body>
    <header class = "header1">
      <h1>Trouble Tickets<h1>
      <h2>Here to help you solve all your tech problems!</h2>
      <div id = "login">
       <div class = "input-box">
        <span class = "login">Username or Email</span>
        <input type = "text" name = "username_or_email">
       </div>
       <div class = "input-box">
        <span class = "login">Password</span>
        <input type = "password" name = "password">
       </div>
       <div class = "button">
        <input type = "submit" name = "login" value = "Login">
       </div>
      </div>
      <p><a href ="http://localhost:9000/signup.php">Do not have an account? Sign up!</a></p>
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
                <li><a href="#">Logout</a></li>
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
      <div class="Contact">
        <h3>Contact us:</h3>
        <p>If you have any questions or concerns regarding the company's network, please do not hesitate to contact us:</p>
        <ul>
          <li>Phone: (555) 123-4567</li>
          <li>Email: networksupport@company.com</li>
          <li>Office hours: Monday-Friday, 9am-5pm</li>
        </ul>
      </div>
  </div>
</section>
</body>
    <footer>
     <p>© Copyright 2021-2023 IT Ticket</p>
     <p><a href = "http://localhost:9000/privacy/privacy_policy.php">Privacy Policy</a></p>
    </footer>
</html>