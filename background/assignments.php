<?php
session_start();
ob_start();
$conn = new PDO('sqlite:../database.db');
$user_id = $_SESSION['user_id'];
$stmt = $conn->prepare('SELECT ticket_department_id FROM Tickets WHERE ticket_id = ?');
$ticket_id = $_GET['ticket_id'];
$stmt->bindParam(1,$ticket_id);
$stmt->execute();
$department_id = $stmt->fetchColumn();
$stmt = $conn->prepare('SELECT admin_id FROM Admins WHERE department_id = ? AND admin_id = ?');
$stmt->bindParam(1,$department_id);
$stmt->bindParam(2,$user_id);
$stmt->execute();
$admin_id = $stmt->fetchColumn();
$stmt = $conn->prepare('SELECT agent_id FROM Agents WHERE department_id = ? AND agent_id = ?');
$stmt->bindParam(1,$department_id);
$stmt->bindParam(2,$user_id);
$stmt->execute();
$agent_id = $stmt->fetchColumn();
if(isset($_SESSION['username']) && $_SESSION['usertype'] != 'client'){
 if((isset($_SESSION['admin_type']) && $_SESSION['admin_type'] == 'main admin') || $_SESSION['user_id'] == $agent_id || $_SESSION['user_id'] == $admin_id ){
  if(isset($_GET['ticket_id'])){
   $stmt = $conn->prepare('SELECT * FROM Assignments WHERE ticket_id = ? AND user_id = ?');
   $ticket_id = $_GET['ticket_id'];
   $user_id = $_SESSION['user_id'];
   $stmt->bindParam(1,$ticket_id);
   $stmt->bindParam(2,$user_id);
   $stmt->execute();
   $check = $stmt->fetch();
   if($check == false){
    $stmt = $conn->prepare('UPDATE Tickets SET ticket_status = ? WHERE ticket_id = ?');
    $assigned_status = 'assigned';
    $stmt->bindParam(1,$assigned_status);
    $stmt->bindParam(2,$ticket_id);
    $stmt->execute();
    $stmt = $conn->prepare('UPDATE Tickets SET ticket_priority = ? WHERE ticket_id = ?');
    $ticket_priority = $_GET['priority'];
    $stmt->bindParam(1,$ticket_priority);
    $stmt->bindParam(2,$ticket_id);
    $stmt->execute();
    $stmt = $conn->prepare('INSERT INTO Assignments(ticket_id,user_id,assignment_time) VALUES(?,?,?)');
    $stmt->bindParam(1,$ticket_id);
    $stmt->bindParam(2,$user_id);
    $date = date('d/m/Y H:i');
    $stmt->bindParam(3,$date);
    $stmt->execute();
    $_SESSION['message'] = 'Ticket has been assigned successfully!';
    ob_clean();
    header('Location:../staff/ticket-inbox.php');
    exit();
   }
   else{
    $_SESSION['message'] = 'You have already assigned this ticket to yourself!';
    ob_clean();
    header('Location:../staff/ticket-inbox.php');
    exit();
   }
  }
 }
}
$_SESSION['message'] = 'You do not have permission to assign this ticket to yourself!';
ob_clean();
header('Location:../staff/ticket-inbox.php');
exit();
?>