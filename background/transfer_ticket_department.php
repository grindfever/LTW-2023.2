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
$stmt = $conn->prepare('SELECT ticket_status FROM Tickets WHERE ticket_id = ?');
$stmt->bindParam(1,$ticket_id);
$stmt->execute();
$ticket_status = $stmt->fetchColumn(); 
if(isset($_SESSION['username']) && $_SESSION['usertype'] != 'client'){
 if((isset($_SESSION['admin_type']) && $_SESSION['admin_type'] == 'main admin') || $_SESSION['user_id'] == $agent_id || $_SESSION['user_id'] == $admin_id ){
  if(isset($_GET['ticket_id']) && isset($_GET['department'])){
   if($ticket_status == 'open'){
    $new_department_id = $_GET['department'];
    $stmt = $conn->prepare('UPDATE Tickets SET ticket_department_id = ? WHERE ticket_id = ?');
    $stmt->bindParam(1,$new_department_id);
    $stmt->bindParam(2,$ticket_id);
    $stmt->execute();
    $stmt = $conn->prepare('SELECT department_name FROM Departments WHERE department_id = ?');
    $stmt->bindParam(1,$new_department_id);
    $stmt->execute();
    $department_name = $stmt->fetchColumn();
    $_SESSION['message'] = 'Ticket ' . $ticket_id . ' was successfully transfered to ' . $department_name . '!';
    ob_clean();
    header('Location:../staff/ticket-inbox.php');
    exit();
   }
   else{
    $_SESSION['message'] = 'You cannot transfer an assigned ticket to another department!';
    ob_clean();
    header('Location:../staff/ticket-inbox.php');
    exit();
   }
  }
 }
 else{
  $_SESSION['message'] = 'You do not have permission to transfer ticket ' .$ticket_id . '!';
  ob_clean();
  header('Location:../staff/ticket-inbox.php');
  exit();
 }
}