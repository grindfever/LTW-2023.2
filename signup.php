<?php
session_start();
$conn = new PDO('sqlite:database.db');
ob_start();
?>
<html>
 <head>
  <title>Sign Up</title>
  <link rel="stylesheet" href="style.css">
 </head>
 <body>
 <header class = "header1">
  <h1>IT Ticket<h1>
  <h2>Here to help you solve all your tech problems!</h2>
  <a href="http://localhost:9000/main.php" class="home-button"><img src="images/home_icon.png" alt="Home"></a>
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
        <li><a href="http://localhost:9000/faq.php">FAQ</a></li>
       </ul>
      </li>
    </ul>
  </nav>
 <div class = "register">
  <div class = "signup">
   <form action = "#" id = "registration-form"  method = "POST">
    <div class = "title">
     <span class = "registration"> Registration </span>
    </div>
     <div class = "user-info">
      <div class = "input-box">
       <span class = "info" > Username </span>
       <input type = "text" id = "username" name = "Username">
      </div>
      <div class = "input-box">
       <span class = "info" > First Name </span>
       <input type = "text" id = "first_name" name = "First_Name">
      </div>
      <div class = "input-box">
       <span class = "info" > Last Name </span>
       <input type = "text" id = "last_name" name = "Last_Name">
      </div>
      <div class = "input-box">
       <span class = "info" > Email Address </span>
       <input type = "text" id = "email_address" name = "Email_Address">
      </div>
      <div class = "input-box">
        <span class = "info" > Phone Number </span>
        <input type = "text" id = "phone_number" placeholder = "Not required" name = "Phone_Number">
       </div>
       <div class = "input-box">
        <span class = "info" > Home Address </span>
        <input type = "text" id = "home_address" placeholder = "Not required" name = "Home_Address">
       </div>
       <div class = "input-box">
        <span class = "info" > Postal Code </span>
        <input type = "text" id = "postal_code" placeholder = "Not required" name = "Postal_Code">
       </div>
       <div class = "input-box">
        <span class = "info" > Password </span>
        <input type = "password" id = "password" name = "Password">
       </div>
       <div class = "input-box">
        <span class = "info" > Confirm Password </span>
        <input type = "password" id = "confirm_password" name = "Confirmed_Password">
       </div>
      </div>
      <div class = "button">
       <input type = "submit" name = "submit" value = "Register">
      </div>

<?php

$error_message = '';

function is_valid_password($password) {
  if (strlen($password) < 8) {
    return false;
  }
  if (!preg_match('/[A-Z]/', $password) || !preg_match('/[a-z]/', $password) || !preg_match('/[0-9]/', $password)) {
    return false;
  }
  return true;
}

function is_valid_username($username) {
 if (strlen($username) < 8){
  return false;
 }
 if(!preg_match('/[a-z]/' , $username) || !preg_match('/[0-9]/',$username)) {
  return false;
 }
 if(preg_match('/[A-Z]/' , $username)){
  return false;
 }
 return true;
}

function is_valid_email($email){
 if (preg_match("/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/", $email)) {
  return true;
} 
 return false;
}

if(isset($_POST['submit'])){
 if ($_SERVER['REQUEST_METHOD'] == 'POST'){
  $username = $_POST['Username'];
  $first_name = $_POST['First_Name'];
  $last_name = $_POST['Last_Name'];
  $password = $_POST['Password'];
  $email = $_POST['Email_Address'];
  $phone_number = $_POST['Phone_Number'];
  $address = $_POST['Home_Address'];
  $postal_code = $_POST['Postal_Code'];
  $confirmed = $_POST['Confirmed_Password'];
  $role = 'client';

 if($first_name == '' || $last_name == ''){
  $error_message = 'You have to fill in all the required fields!';
  $_SESSION['message'] = $error_message;
  ob_clean();
  header('Location: signup.php');
  exit();
  }

 if($confirmed == $password){
  if (is_valid_username($username) == false){
    $error_message = 'Usernames must have 8 characters, contain at least one lowercase letter and a number and cannot contain uppercase letters!';
    $_SESSION['message'] = $error_message;
    ob_clean();
    header('Location: signup.php');
    exit();
   }
   if (is_valid_email($email) == false){
    $error_message = 'Please introduce a valid email address!';
    $_SESSION['message'] = $error_message;
    ob_clean();
    header('Location: signup.php');
    exit();
   }
   if (is_valid_password($password) == false){
    $error_message = 'Passwords must have at least 8 characters and contain at least one uppercase letter, one lowercase letter and a number!';
    $_SESSION['message'] = $error_message;
    ob_clean();
    header('Location: signup.php');
    exit();
   }
   if(is_valid_password($password) && is_valid_username($username)){
    try{
     $password = password_hash($password,PASSWORD_DEFAULT);
     $confirmed = password_hash($confirmed,PASSWORD_DEFAULT);
     $stmt = $conn->prepare('INSERT INTO Users(username,passwrd,first_name,last_name,email,phone_number,home_address,postal_code,usertype,registration_time) VALUES(:username,:passwrd,:first_name,:last_name,:email,:phone_number,:home_address,:postal_code,:usertype,:registration_time)');
     $stmt->bindValue(':username', $username);
     $stmt->bindValue(':passwrd', $password);
     $stmt->bindValue(':first_name', $first_name);
     $stmt->bindValue(':last_name', $last_name);
     $stmt->bindValue(':email', $email);
     $stmt->bindValue(':phone_number', $phone_number);
     $stmt->bindValue(':home_address', $address);
     $stmt->bindValue(':postal_code', $postal_code);
     $stmt->bindValue(':usertype', $role);
     $stmt->bindValue(':registration_time', 'NOW()');
     $stmt->execute();
     session_destroy();
     ob_clean();
     header('Location: main.php');
     exit();
    }
    catch(PDOException $e){
     $error_message = 'Username or email address already exists! Please use a different one.';
     $_SESSION['message'] = $error_message;
     ob_clean();
     header('Location: signup.php');
     exit();
    } 
   }
  }
  else{
   $error_message = '<p>Passwords do not match! Please try again.</p>';
   $_SESSION['message'] = $error_message;
   ob_clean();
   header('Location: signup.php');
   exit();
  }
 }
}
if(isset($_SESSION['message'])){
 echo '<p>' . $_SESSION['message'] . '</p>';
 unset($_SESSION['message']);
 session_destroy();
}

 ?>
    </div>
   </form>
  </div>
  <footer>
    <p>© Copyright 2021-2023 IT Ticket</p>
    <p><a href = "http://localhost:9000/privacy/privacy_policy.php">Privacy Policy</a></p>
   </footer>
   <script src="js_files/click.js"></script>
   <script src="js_files/save_user_input.js"></script>
 </body>
</html>