<?php
$conn = new PDO('sqlite:database.db');
session_start();
?>

<!DOCTYPE html>
<html>
 <head>
  <title>IT Ticket</title>
  <link rel = "stylesheet" href = "style.css">
 </head>
 <body>
  <header class = "header1">
    <h1>IT Ticket<h1>
    <h2>Here to help you solve all your tech problems!</h2>
    <a href="http://localhost:9000/main.php" class="home-button"><img src="images/home_icon.png" alt="Home"></a>
    <div id = "login">
     <?php
     if(isset($_SESSION['username'])){
      echo '<p>' .$_SESSION['username']. '</p>';
     }
     else{
      ?>
       <form action = "" method = "POST">
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
        <?php
          if(isset($_POST['login'])){
            if ($_SERVER['REQUEST_METHOD'] == 'POST'){
             $username_or_email = $_POST['username_or_email'];
             $password = $_POST['password'];
            
             $stmt = $conn->prepare('SELECT username FROM Users WHERE username = ?');
             $stmt->bindParam(1,$username_or_email);
             $stmt->execute();
             $result1 = $stmt->fetchColumn();
            
             $stmt = $conn->prepare('SELECT email FROM Users WHERE email = ?');
             $stmt->bindParam(1,$username_or_email);
             $stmt->execute();
             $result2 = $stmt->fetchColumn();
            
             $error_message1 = "Invalid username,email or password, please try again.";
             $error_message2 = "Username/email and password do not match, please try again";
            
             if($result1 == false && $result2 == false){
              $_SESSION['message'] = $error_message1;
              echo '<meta http-equiv="refresh" content="0; url=main.php" />';
              exit();
             }
            
             else if($result1 !== false){
              $stmt = $conn->prepare('SELECT * FROM Users WHERE username = ?');
              $stmt->bindParam(1,$username_or_email);
              $stmt->execute();
              $stored_password_row = $stmt->fetch();
              $stored_password = $stored_password_row['passwrd'];
              if(password_verify($password,$stored_password)){
               $_SESSION['user_id'] = $stored_password_row['user_id'];
               $_SESSION['username'] = $stored_password_row['username'];
               $_SESSION['email'] = $stored_password_row['email'];
               $_SESSION['timeout'] = time() + 3600;
               $_SESSION['usertype'] = $stored_password_row['usertype'];
               $stmt = $conn->prepare('UPDATE Logins SET login_time = ? WHERE user_id = ?');
               $time = time();
               $stmt->bindParam(1,$time);
               $stmt->bindParam(2,$_SESSION['user_id']);
               echo '<meta http-equiv="refresh" content="0; url=main.php" />';
               exit();
              }
              else{
               $_SESSION['message'] = $error_message2;
               echo '<meta http-equiv="refresh" content="0; url=main.php" />';
               exit();
              }
             }
             else if($result2 !== false){
              $stmt = $conn->prepare('SELECT * FROM Users WHERE email = ?');
              $stmt->bindParam(1,$username_or_email);
              $stmt->execute();
              $stored_password_row = $stmt->fetch();
              $stored_password = $stored_password_row['passwrd'];
              if(password_verify($password,$stored_password)){
               $_SESSION['user_id'] = $stored_password_row['user_id'];
               $_SESSION['username'] = $stored_password_row['username'];
               $_SESSION['email'] = $stored_password_row['email'];
               $_SESSION['timeout'] = time() + 3600;
               $stmt = $conn->prepare('INSERT INTO Logins VALUES (?,?) WHERE user_id = ?');
               $stmt->bindParam(1,$_SESSION['user_id']);
               $stmt->bindParam(2,time());
               $stmt->bindParam(3,$_SESSION['user_id']);
               $stmt->execute();
               echo '<meta http-equiv="refresh" content="0; url=main.php" />';
               exit();
              }
              else{
               $_SESSION['message'] = $error_message2;
               echo '<meta http-equiv="refresh" content="0; url=main.php" />';
               exit();
              }
             }
           }
          }
          if(isset($_SESSION['message'])){
           echo '<p id = "login_error_message">' . $_SESSION['message'] . '</p>';
           unset($_SESSION['message']);
          }
        ?>
     </form>
     <p id = "main_page_signup"><a href ="http://localhost:9000/signup.php">Do not have an account? Sign up!</a></p>
     <img src = "" alt = "">
     <?php
     }
     ?>
    </div>
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
   <section class = "Description">
    <h1>What is IT Ticket?</h1>
     <p>Introducing IT Ticket, a web-based ticketing system that provides a streamlined process for reporting and resolving IT-related problems. This platform aims to simplify the task of IT support teams in addressing the technical issues that arise in the company's IT infrastructure. The platform has three types of users: admins, agents, and clients. Admins have the highest level of access and can manage users, create departments, and view reports. Agents can view tickets assigned to them, exchange messages with other agents and admins, and respond to client inquiries. Clients can report IT problems, track the status of their tickets, and exchange messages with any agents or admins assigned to their tickets.</p>
    <h1>How does IT Ticket work?</h1>
     <p>IT Ticket is equipped with seven departments to cater to different IT concerns, such as software tech support, hardware tech support, web development, customer service, security issues, network issues, and app development. Clients can submit tickets through the platform's user-friendly interface and track the status of their tickets in real-time. Agents can easily access their assigned tickets, view client messages, and respond to client inquiries. Admins can monitor ticket status, track resolution times, and generate reports to evaluate the performance of their IT support teams.</p>
     <p>IT Ticket's messaging feature allows agents and admins to exchange messages between themselves, ensuring that they can collaborate and resolve IT issues efficiently. Clients can also exchange messages with any agents or admins assigned to their tickets, providing them with real-time updates and support throughout the ticket resolution process.</p>
     <p>To ensure the platform's smooth operation, clients and agents must follow specific rules. Any clients found to be abusive, disruptive, or disrespectful towards agents or admins will receive a warning, and continued violations can result in a permanent account ban. Similarly, agents found to be negligent or providing poor quality service to clients can face disciplinary action or permanent account bans.</p>
     <p>IT Ticket also provides the opportunity for clients to submit a request to become an agent of a specific department. This feature allows clients with advanced IT skills to participate in the resolution of IT issues, providing them with a new level of engagement and a deeper understanding of the IT infrastructure.</p>
    <h1>Why use IT Ticket?</h1>
     <p>IT Ticket stands out as one of the best trouble ticketing systems around because of its user-friendly interface, efficient ticket management system, comprehensive reporting tools, messaging feature, and adherence to strict rules. IT Ticket simplifies the process of reporting and resolving IT issues, ensuring that clients receive quick and efficient support. Its departmental system ensures that IT problems are handled by specialists in their respective fields, and its real-time updates and email notifications keep clients informed on the status of their tickets. IT Ticket's messaging feature allows agents and admins to collaborate efficiently and provides clients with real-time support throughout the ticket resolution process.</p>
     <p>The platform's strict adherence to specific rules ensures a safe and respectful environment for all users. IT Ticket's reporting tool generates valuable data that IT support teams can use to improve their performance and identify areas for improvement. With IT Ticket, companies can expect a more organized and efficient process for handling IT issues, resulting in improved productivity and client satisfaction.</p>
   </section>
   <section class = "Projects">
    <h1>Collaborative Projects</h1>
     <div id = "MealMatch">
      <h1>MealMatch</h1>
       <p> MealMatch is a web application that helps people find and connect with others in their local community who are interested in sharing meals. Users can create a profile and specify their dietary preferences, cooking abilities, and availability to host or attend meals. The app will then use this information to match users with compatible meal-sharing partners in their area.</p>
       <p> MealMatch could also offer features like reviews and ratings of past meal-sharing experiences, a recipe-sharing platform, and a marketplace for buying and selling local ingredients. With the growing interest in sustainable food systems and the popularity of communal dining experiences, MealMatch could appeal to a wide range of users looking to connect over food.</p>
     </div>
     <div id = "MyMentor">
      <h1>MyMentor</h1>
      <p>MyMentor is a web platform that connects aspiring professionals with experienced mentors in their desired field. Users can create a profile outlining their career goals, interests, and experience level, and then search for mentors who match their criteria. Mentors can also create a profile highlighting their expertise and availability to mentor, and can offer one-on-one mentorship sessions or group workshops on specific topics.</p>
      <p>MyMentor could also offer resources like career advice articles, job search tools, and networking opportunities. As the job market becomes increasingly competitive, many people are looking for guidance and mentorship to help them succeed in their chosen career paths. MyMentor could fill this gap by offering a convenient and accessible platform for mentorship connections.</p>
     </div>
    </section>
    <footer>
     <p>© Copyright 2021-2023 IT Ticket</p>
     <p><a href = "http://localhost:9000/privacy/privacy_policy.php">Privacy Policy</a></p>
    </footer>
    <script src="js_files/click.js"></script>
 </body>
</html>


