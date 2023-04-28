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
  