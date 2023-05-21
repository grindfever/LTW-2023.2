<?php
$conn = new PDO('sqlite:../database.db');
session_start();
if(isset($_SESSION['username'])){
?>
<!DOCTYPE html>
<html>
<head>
  <title>My Mentor</title>
  <link rel="stylesheet" href="../style.css">
</head>
<body>
  <header class="header1">
    <h1>Trouble Tickets</h1>
    <h2>Here to help you solve all your tech problems!</h2>
    <a href="http://localhost:9000/main.php" class="home-button"><img src="../images/home_icon.png" alt="Home"></a>
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
 </nav>  
<div class="projprod">
  <h1>Get Fit with SmartGym</h1>
  <p>SmartGym is the ultimate fitness companion, designed to help you reach your fitness goals faster and more effectively. Whether you're looking to lose weight, build muscle, or simply maintain your current fitness level, SmartGym has got you covered.</p>
  <h2>Features and Benefits</h2>
  <p>With SmartGym, you get access to a range of cutting-edge features and benefits that are guaranteed to take your fitness journey to the next level:</p>
  <p>With SmartGym, you get access to a range of cutting-edge features and benefits that are guaranteed to take your fitness journey to the next level:</p>
    <div class ="smartgym-container">
  <ul>
    <li>Personalized workout plans tailored to your fitness goals, preferences, and schedule</li>
    <li>Real-time coaching and feedback to ensure proper form and technique</li>
    <li>Smart tracking and analysis of your workouts, progress, and performance</li>
    <li>Integration with popular fitness apps and wearables for seamless tracking and monitoring</li>
    <li>Access to a community of like-minded fitness enthusiasts for motivation and support</li>
  </ul>
  <p>With SmartGym, you don't have to be a fitness expert to get results. Our easy-to-use platform and intuitive interface make it simple and convenient to get started and stay on track. Whether you're at home, in the gym, or on the go, SmartGym is always with you, providing the guidance and support you need to reach your fitness goals.</p>
  <h2>Try SmartGym Today</h2>
  <p>Ready to take your fitness journey to the next level? Sign up for SmartGym today and start your free trial. For any inquiries or assistance regarding SmartGym, please feel free to contact our support team at support@smartgym.com or call us at +1-123-456-7890. We are here to help you achieve your fitness goals.</p>
  <img class="smartgym-img" src="../images/gym.jpg" alt="smartgym">
</div>
  <p> With SmartGym, you don't have to be a fitness expert to get results. Our easy-to-use platform and intuitive interface make it simple and convenient to get started and stay on track. Whether you're at home, in the gym, or on the go, SmartGym is always with you, providing the guidance and support you need to reach your fitness goals.</p>
  <h2>Try SmartGym Today</h2>
  <p> Ready to take your fitness journey to the next level? Sign up for SmartGym today and start your free trial. For any inquiries or assistance regarding SmartGym, please feel free to contact our support team at support@smartgym.com or call us at +1-123-456-7890. We are here to help you achieve your fitness goals.</p>
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