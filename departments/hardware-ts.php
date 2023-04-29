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
            <li><a href="http://localhost:9000/departments/software-ts.php">Software Techinical Support</a></li>
            <li><a href="http://localhost:9000/departments/hardware-ts.php">Hardware Techincal Support</a></li>
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
    <div class="Contact">
      <h3>Contact us:</h3>
      <p>If you need technical support for your hardware components or devices, please contact us at:</p>
      <ul>
        <li>Phone: 1-800-123-4567</li>
        <li>Email: hardwaresupport@company.com</li>
        <li>Live chat: Visit our website and click on the live chat icon</li>
      </ul>
    </div>
  </div>
  </body>
    <footer>
     <p>© Copyright 2021-2023 IT Ticket</p>
     <p><a href = "http://localhost:9000/privacy/privacy_policy.php">Privacy Policy</a></p>
    </footer>
</html> 