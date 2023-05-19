<?php
session_start();
ob_start();
$conn = new PDO('sqlite:../database.db');
$stmt = $conn->prepare('SELECT client_id from Tickets WHERE ticket_id = ?');
$verification_ticket_id = $_GET['ticket_id'];
$stmt->bindParam(1,$verification_ticket_id);
$stmt->execute();
$client_id = $stmt->fetchColumn();
if(isset($_SESSION['username']) && $client_id = $_SESSION['user_id']){
 if(isset($_GET['ticket_id'])){
  $stmt = $conn->prepare('UPDATE Tickets SET ticket_status = ? WHERE ticket_id = ?');
  $ticket_status = 'closed';
  $ticket_id = $_GET['ticket_id'];
  $stmt->bindParam(1,$ticket_status);
  $stmt->bindParam(2,$ticket_id);
  $stmt->execute();
  $stmt = $conn->prepare('DELETE FROM Assignments WHERE ticket_id = ?');
  $ticket_id = $_GET['ticket_id'];
  $stmt->bindParam(1,$ticket_id);
  $stmt->execute();
  $_SESSION['message'] = 'Your ticket has been closed successfully!';
  ob_clean();
  header('Location: ../tickets/active-tickets.php');
  exit();
 }
}
?>