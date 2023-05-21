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
    <h1>Learn with MyMentor</h1>
    <p>MyMentor is a comprehensive mentorship platform designed to connect individuals with experienced professionals in various fields. Whether you are a student seeking guidance in your academic journey, a professional looking to enhance your skills, or someone exploring new career paths, MyMentor provides you with a valuable opportunity to connect with mentors who can guide and support you.</p>
    <h2>How It Works</h2>
    <p>MyMentor operates on a simple and user-friendly platform. After signing up and creating your profile, you can search for mentors based on your interests, goals, and preferences. Once you find a suitable mentor, you can send them a mentoring request. If the mentor accepts your request, you can start engaging in meaningful conversations, exchanging knowledge, and receiving valuable advice.</p>
    <h2>Benefits of MyMentor</h2>
    <p>MyMentor is a comprehensive mentorship platform designed to connect individuals with experienced professionals in various fields. Whether you are a student seeking guidance in your academic journey, a professional looking to enhance your skills, or someone exploring new career paths, MyMentor provides you with a valuable opportunity to connect with mentors who can guide and support you.</p>
    <h2>How It Works</h2>
    <p>MyMentor operates on a simple and user-friendly platform. After signing up and creating your profile, you can search for mentors based on your interests, goals, and preferences. Once you find a suitable mentor, you can send them a mentoring request. If the mentor accepts your request, you can start engaging in meaningful conversations, exchanging knowledge, and receiving valuable advice.</p>
    <div class="mymentor-container">
    <h2>Benefits of MyMentor :</h2>
    <ul>
        <li>Gain insights from experienced professionals in your field of interest</li>
        <li>Receive personalized guidance tailored to your specific needs and goals</li>
        <li>Expand your professional network and establish valuable connections</li>
        <li>Enhance your skills, knowledge, and confidence</li>
        <li>Stay motivated and focused on your personal and professional development</li>
    </ul>
    <img class="mymentor-img" src="../images/mentor.jpg" alt="mymentor">
</div>
<p>
      For any inquiries or assistance regarding MyMentor, please feel free to contact our support team at support@mymentor.com or call us at +1-123-456-7890. We are here to help you make the most out of your mentorship experience.</p>
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