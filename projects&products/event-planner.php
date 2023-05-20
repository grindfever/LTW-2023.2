<?php
$conn = new PDO('sqlite:../database.db');
session_start();
if(isset($_SESSION['username'])){
?>
<!DOCTYPE html>
<html>
<head>
  <title>Event Planner</title>
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
  <h1>About Event Planner</h1>
  <p>
    The Event Planner is a powerful tool designed to assist you in organizing and managing your events seamlessly. Whether you are planning a small gathering, a corporate conference, or a grand celebration, our Event Planner provides you with the necessary features and resources to ensure a successful and memorable event.</p>
<<<<<<< Updated upstream
  <h2>Key Features</h2>
=======
   
    <div class="eventplanner-container">
       <h2>Key Features :</h2>
>>>>>>> Stashed changes
  <ul>
    <li>Event creation and customization options</li>
    <li>Guest management and RSVP tracking</li>
    <li>Task management and to-do lists</li>
    <li>Budget tracking and expense management</li>
    <li>Vendor management and collaboration</li>
    <li>Event promotion and marketing tools</li>
    <li>Real-time communication and updates</li>
  </ul>
<<<<<<< Updated upstream
=======
  <img class="eventplanner-img" src="../images/event.png" alt="wedding plan">
</div>
>>>>>>> Stashed changes
  <h2>How It Works</h2>
  <p>
    The Event Planner simplifies the event planning process. To get started, sign up for an account and create your event. Customize the event details, such as the date, time, venue, and theme. Manage your guest list by sending invitations and tracking RSVPs. Keep track of tasks and deadlines with the integrated task management feature. Monitor your budget and expenses to ensure you stay on track. Collaborate with vendors and event team members to streamline the planning process. Promote your event using the built-in marketing tools and communicate updates to your attendees in real-time.</p>
  <h2>Benefits of Event Planner</h2>
  <ul>
    <li>Saves time and effort in event organization</li>
    <li>Centralized platform for all event-related tasks and information</li>
    <li>Streamlines communication and collaboration among team members</li>
    <li>Helps you stay organized and on top of deadlines</li>
    <li>Provides valuable insights and analytics for event success</li>
    <li>Ensures a smooth and memorable event experience for attendees</li>
  </ul>
  <p>
    If you have any inquiries or require assistance with the Event Planner, please don't hesitate to contact our support team at support@eventplanner.com or call us at +1-123-456-7890. We are here to make your event planning journey a breeze!</p>
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