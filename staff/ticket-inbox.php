<?php
session_start();
$conn = new PDO('sqlite:../database.db');
if(isset($_SESSION['username']) && ($SESSION['usertype'] = 'admin' || $SESSION['usertype'] == 'agent')){
 $stmt->prepare('SELECT admin_type FROM Admins WHERE admin_id = ?');
 if($_SESSION['usertype'] == 'agent'){
 $stmt = $conn->prepare('SELECT department_id FROM Agents WHERE agent_id = ?');
 $agent_id = $_SESSION['user_id'];
 $stmt->bindParam(1,$agent_id);
 $stmt->execute();
 $department_id = $stmt->fetchColumn();
 }
 else if($_SESSION['usertype'] = 'admin'){
  $stmt = $conn->prepare('SELECT department_id FROM Admins WHERE admin_id = ?');
  $admin_id = $_SESSION['user_id'];
  $stmt->bindParam(1,$admin_id);
  $stmt->execute();
  $department_id = $stmt->fetchColumn();
 }
 $stmt = $conn->prepare('SELECT * FROM Tickets WHERE ticket_department_id = ? AND (ticket_status = "open" OR ticket_status = "assigned")');
}