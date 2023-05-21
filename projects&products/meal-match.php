<?php
$conn = new PDO('sqlite:../database.db');
session_start();
if(isset($_SESSION['username'])){
?>

<!DOCTYPE html>
<html>
<head>
  <title>Meal Match</title>
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
    <h1>About Meal Match</h1>
    <p>
      Meal Match is a platform that aims to connect food enthusiasts with local chefs and cooks who offer unique dining experiences. Whether you're looking for a private chef to cook a special meal for an event or seeking to join a group of like-minded individuals for a culinary adventure, Meal Match provides a convenient and exciting way to discover and book extraordinary dining experiences.</p>
    <h2>How It Works</h2>
    <p>Meal Match simplifies the process of finding and booking dining experiences. As a user, you can browse through a variety of chef profiles, menus, and available dates. Once you find a chef or a dining experience that captures your interest, you can make a reservation and communicate directly with the chef to discuss any specific requirements or dietary restrictions.</p>
    <h2>Benefits of Meal Match</h2>
    <div class="mealmatch-container">
      <h2>Benefits of Meal Match :</h2>
    <ul>
      <li>Discover unique dining experiences curated by talented chefs</li>
      <li>Enjoy personalized and customized menus</li>
      <li>Interact and connect with local chefs and food enthusiasts</li>
      <li>Create memorable dining experiences for special occasions</li>
      <li>Support local culinary talent and the sharing economy</li>
    </ul>
    <img class="mealmatch-img" src="../images/meal.jpg" alt="mealmatch">
    </div>
    <p> For any inquiries or assistance regarding Meal Match, please feel free to contact our support team at support@mealmatch.com or call us at +1-123-456-7890. We are here to help you explore a world of culinary delights.</p>
  </div>
</body>
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