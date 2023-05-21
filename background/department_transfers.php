<?php
session_start();
$conn = New PDO('sqlite:../database.db');
if(isset($_SESSION['username']) && $_SESSION['usertype'] == 'admin'){
 $target_user_id = $_GET['user_id'];
 $new_department_id = $_GET['new_department_id'];
 $stmt = $conn->prepare('SELECT department_name FROM Departments WHERE department_id = ?');
 $stmt->bindParam(1,$new_department_id);
 $stmt->execute();
 $new_department_name = $stmt->fetchColumn();
 $stmt = $conn->prepare('SELECT * FROM Users WHERE user_id = ?');
 $stmt->bindParam(1,$target_user_id);
 $stmt->execute();
 $target_data = $stmt->fetch();
 $target_usertype = $target_data['usertype'];
 $target_username = $target_data['username'];

 if($target_usertype == 'agent'){
  $stmt = $conn->prepare('UPDATE Agents SET department_id = ? WHERE agent_id = ?');
  $stmt->bindParam(1,$new_department_id);
  $stmt->bindParam(2,$target_user_id);
  $stmt->execute();
  $stmt = $conn->prepare('SELECT * FROM Assignments WHERE user_id = ?');
  $stmt->bindParam(1,$target_user_id);
  $stmt->execute();
  $assignments = $stmt->fetchAll();
  foreach($assignments as $assignment){
   $stmt = $conn->prepare('SELECT * FROM Assignments WHERE ticket_id = ?');
   $stmt->bindParam(1,$assignment['ticket_id']);
   $stmt->execute();
   $assignments1 = $stmt->fetchAll();
   $number_of_assignments = count($assignments1);
   if($number_of_assignments === 1){
    $stmt = $conn->prepare('UPDATE Tickets SET ticket_status = ? WHERE ticket_id = ?');
    $open_status = 'open';
    $stmt->bindParam(1,$open_status);
    $stmt->bindParam(2,$assignment['ticket_id']);
    $stmt->execute();
   }
  }
  $stmt = $conn->prepare('DELETE FROM Assignments WHERE user_id = ?');
  $stmt->bindParam(1,$target_user_id);
  $stmt->execute();
  $_SESSION['message'] = 'Agent ' . $target_username . ' has been transfered to ' . $new_department_name . '!';
  header('Location:../management/user_managment.php');
  exit();
 }
 else{
  $_SESSION['message'] = 'You can only transfer agents to a different department!';
  header('Location:../management/user_managment.php');
  exit();
 }
}
?>