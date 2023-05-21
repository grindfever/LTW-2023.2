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
  <h1>Welcome to Healthy Habits</h1>
  <p> Healthy Habits is a wellness platform designed to help individuals adopt and maintain a healthy lifestyle. We believe that small, consistent habits can lead to significant improvements in physical and mental well-being. Our platform provides you with the guidance, tools, and support needed to make positive changes and prioritize your health.</p>
  <h2>Our Approach</h2>
  <p>At Healthy Habits, we promote a holistic approach to health, focusing on three key pillars: nutrition, fitness, and mindfulness. By incorporating balanced eating, regular physical activity, and mindfulness practices into your daily routine, you can achieve optimal well-being and live a fulfilling life.</p>
   <div class ="healthyhabits-container">
    <h2>Features and Benefits:</h2>
  <ul>
    <li>Personalized meal plans and nutrition guidance</li>
    <li>Exercise routines tailored to your fitness level and goals</li>
    <li>Guided meditation and stress management techniques</li>
    <li>Progress tracking and goal setting</li>
    <li>Community support and accountability</li>
  </ul>
</div>
<footer>
  <img class="healthyhabits-img" src="../images/healthy.jpg" alt="healthyhabits">
</div>
    <p>Whether you're looking to lose weight, boost energy levels, manage stress, or simply improve your overall health, Healthy Habits is here to support you every step of the way. Start your journey towards a healthier, happier you today!</p>
    <p>For any inquiries or assistance regarding Healthy Habits, please feel free to contact our support team at support@healthyhabits.com or call us at tel:+1-123-456-7890. </p>
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