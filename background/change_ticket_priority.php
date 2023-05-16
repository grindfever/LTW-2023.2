<?php
session_start();
ob_start();
$conn = new PDO('sqlite:../database.db');
if(isset($_SESSION['username']) && $_SESSION['usertype'] != 'client'){
 $ticket_id = $_GET['ticket_id'];
 $user_id = $_SESSION['user_id'];
 $stmt = $conn->prepare('SELECT * FROM Assignments WHERE ticket_id = ? AND user_id = ?');
 $stmt->bindParam(1,$ticket_id);
 $stmt->bindParam(2,$user_id);
 $stmt->execute();
 $check_assignment = $stmt->fetch();
 $check_ticket_id = $check_assignment['ticket_id'];
 $check_staff_id = $check_assignment['user_id'];
 if($check_ticket_id != $ticket_id || $check_staff_id != $user_id ){
  $_SESSION['message'] = 'You do not have permission to change the priority of this ticket!';
  ob_clean();
  header('Location:../staff/assigned_tickets.php');
  exit();
 }
 else{
  $new_priority = $_GET['priority'];
  $stmt = $conn->prepare('UPDATE Tickets SET ticket_priority = ? WHERE ticket_id = ?');
  $stmt->bindParam(1,$new_priority);
  $stmt->bindParam(2,$ticket_id);
  $stmt->execute();
  $_SESSION['message'] = 'You have successfully changed the priority of this ticket to ' . $new_priority .'!';
  ob_clean();
  header('Location:../staff/assigned_tickets.php');
  exit();
 }
}

