<?php
session_start();
ob_start();
$conn = New PDO('sqlite:../database.db');
if(isset($_SESSION['username']) && $_SESSION['usertype'] == 'admin'){
 $target_user_id = $_GET['user_id'];
 $stmt = $conn->prepare('SELECT * FROM Users WHERE user_id = ?');
 $stmt->bindParam(1,$target_user_id);
 $stmt->execute();
 $target_data = $stmt->fetch();
 $target_usertype = $target_data['usertype'];
 $target_username = $target_data['username'];
 if($target_usertype != 'admin'){
  if($target_usertype == 'agent'){
   $stmt = $conn->prepare('DELETE FROM Assignments WHERE user_id = ?');
   $stmt->bindParam(1,$target_user_id);
   $stmt->execute();
   $stmt = $conn->prepare('SELECT * FROM Tickets WHERE client_id = ?');
   $stmt->bindParam(1,$target_user_id);
   $stmt->execute();
   $agent_tickets = $stmt->fetchAll();
   foreach($agent_tickets as $ticket){
    $stmt = $conn->prepare('DELETE FROM Assignments WHERE ticket_id = ?');
    $stmt->bindParam(1,$ticket['ticket_id']);
    $stmt->execute();
   }
   $stmt = $conn->prepare('DELETE FROM Tickets WHERE client_id = ?');
   $stmt->bindParam(1,$target_user_id);
   $stmt->execute();
   $stmt = $conn->prepare('DELETE FROM Agents WHERE agent_id = ?');
   $stmt->bindParam(1,$target_user_id);
   $stmt->execute();
   $stmt = $conn->prepare('DELETE FROM Users WHERE user_id = ?');
   $stmt->bindParam(1,$target_user_id);
   $stmt->execute();
  }
  elseif($target_usertype == 'client'){
   $stmt = $conn->prepare('SELECT * FROM Tickets WHERE client_id = ?');
   $stmt->bindParam(1,$target_user_id);
   $stmt->execute();
   $client_tickets = $stmt->fetchAll();
   foreach($client_tickets as $client_ticket){
    $stmt = $conn->prepare('DELETE FROM Assignments WHERE ticket_id = ?');
    $stmt->bindParam(1,$client_ticket['ticket_id']);
    $stmt->execute();
   }
   $stmt = $conn->prepare('DELETE FROM Tickets WHERE client_id = ?');
   $stmt->bindParam(1,$target_user_id);
   $stmt->execute();
   $stmt = $conn->prepare('DELETE FROM Users WHERE user_id = ?');
   $stmt->bindParam(1,$target_user_id);
   $stmt->execute();
  }
  $_SESSION['message'] = $target_username . ' was banned permenantly!';
  ob_clean();
  header('Location:../../management/user_managment.php');
  exit();

 }
 else{
  $_SESSION['message'] = 'You cannot ban an admin!';
  ob_clean();
  header('Location:../management/user_managment.php');
  exit();
 }
}