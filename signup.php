<?php
$conn = new PDO('sqlite:database.db');
?>

<html>
 <head>
  <title>Sign Up</title>
  <link rel="stylesheet" href="style.css">
 </head>
 <body>
 <div class = "register">
  <div class = "signup">
   <form action = "#" method = "POST">
    <div class = "title">
     <span class = "registration"> Registration </span>
    </div>
     <div class = "user-info">
      <div class = "input-box">
       <span class = "info" > Username </span>
       <input type = "text" name = "Username">
      </div>
      <div class = "input-box">
       <span class = "info" > First Name </span>
       <input type = "text" name = "First_Name">
      </div>
      <div class = "input-box">
       <span class = "info" > Last Name </span>
       <input type = "text" name = "Last_Name">
      </div>
      <div class = "input-box">
       <span class = "info" > Email Address </span>
       <input type = "text" name = "Email_Address">
      </div>
      <div class = "input-box">
        <span class = "info" > Phone Number </span>
        <input type = "text" placeholder = "Not required" name = "Phone_Number">
       </div>
       <div class = "input-box">
        <span class = "info" > Home Address </span>
        <input type = "text" placeholder = "Not required" name = "Home_Address">
       </div>
       <div class = "input-box">
        <span class = "info" > Postal Code </span>
        <input type = "text" placeholder = "Not required" name = "Postal_Code">
       </div>
       <div class = "input-box">
        <span class = "info" > Password </span>
        <input type = "password" name = "Password">
       </div>
       <div class = "input-box">
        <span class = "info" > Confirm Password </span>
        <input type = "password" name = "Confirmed_Password">
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
  echo '<p>' . $error_message . '</p>';
  header('signup.php');
  exit();
  }

 if($confirmed == $password){
  if (is_valid_username($username) == false){
    $error_message = 'Usernames must have 8 characters, contain at least one lowercase letter and a number and cannot contain uppercase letters!';
    echo '<p>' . $error_message .'</p>';
    header('signup.php');
    exit();
   }
   if (is_valid_email($email) == false){
    $error_message = 'Please introduce a valid email address!';
    echo '<p>'. $error_message . '</p>';
    header('signup.php');
    exit();
   }
   if (is_valid_password($password) == false){
    $error_message = 'Passwords must have at least 8 characters and contain at least one uppercase letter, one lowercase letter and a number!';
    echo '<p>' . $error_message .'</p>';
    header('signup.php');
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
     echo '<p> Your account has been created successfully! </p';
     header('main.php');
     exit();
    }
    catch(PDOException $e){
     $error_message = 'Username or email address already exists! Please use a different one.';
     echo '<p>'. $error_message .'</p>';
     header('signup.php');
     exit();
    } 
   }
  }
  else{
   $error_message = '<p>Passwords do not match! Please try again.</p>';
   echo '<p>'. $error_message . '.</p>';
   header('signup.php');
   exit();
  }
 }
}

 ?>
    </div>
   </form>
  </div>
 </body>
</html>