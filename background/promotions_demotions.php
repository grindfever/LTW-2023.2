<?php
session_start();
$conn = New PDO('sqlite:../database.db');
if(isset($_SESSION['username']) && $_SESSION['usertype'] == 'admin'){
 $action_type = $_GET['action_type'];
 $target_user_id = $_GET['user_id'];
 $new_admin_type = $_GET['new_admintype'];
 $star_points = 0;
 $stmt = $conn->prepare('SELECT usertype FROM Users WHERE user_id = ?');
 $stmt->bindParam(1,$target_user_id);
 $stmt->execute();
 $old_role = $stmt->fetchColumn();
 $stmt = $conn->prepare('SELECT username FROM Users WHERE user_id = ?');
 $stmt->bindParam(1,$target_user_id);
 $stmt->execute();
 $target_username = $stmt->fetchColumn();
 $stmt = $conn->prepare('SELECT admin_type FROM Admins WHERE admin_id = ?');
 $stmt->bindParam(1,$target_user_id);
 $stmt->execute();
 $current_admin_type = $stmt->fetchColumn();
 $stmt->execute();
 if($current_admin_type != 'main admin'){
 if($action_type == 'promotion' && $old_role == 'client'){
  $task_type ='promotion';
  $new_role = 'agent';
  $stmt = $conn->prepare('UPDATE Users SET usertype = ? where user_id = ?');
  $stmt->bindParam(1,$new_role);
  $stmt->bindParam(2,$target_user_id);
  $stmt->execute();
  $task_type ='promotion';
  $new_department_id = $_GET['new_department_id'];
  $stmt = $conn->prepare('INSERT INTO Agents(agent_id,department_id,star_points) VALUES(?,?,?)');
  $stmt->bindParam(1,$target_user_id);
  $stmt->bindParam(2,$new_department_id);
  $stmt->bindParam(3,$star_points);
  $stmt->execute();
  $stmt = $conn->prepare('INSERT INTO Admin_Tasks(task_type,user_id,admin_id,task_time) VALUES(?,?,?,?)');
  $time = date('d/m/Y H:i');
  $stmt->bindParam(1,$task_type);
  $stmt->bindParam(2,$target_user_id);
  $stmt->bindParam(3,$_SESSION['user_id']);
  $stmt->bindParam(4,$time);
  $stmt->execute();
  $_SESSION['message'] = 'You successfully promoted ' . $target_username . ' to agent!';
  ob_clean();
  header('Location:../management/user_managment.php');
  exit();
 }
 if($action_type == 'promotion' && $old_role == 'agent'){
  $task_type == 'promotion';
  $new_role = 'admin';
  $stmt = $conn->prepare('UPDATE Users SET usertype = ? where user_id = ?');
  $stmt->bindParam(1,$new_role);
  $stmt->bindParam(2,$target_user_id);
  $stmt->execute();
  $stmt = $conn->prepare('SELECT department_id FROM Agents WHERE agent_id =?');
  $stmt->bindParam(1,$target_user_id);
  $stmt->execute();
  $current_department_id = $stmt->fetchColumn();
  $task_type = 'promotion';
  $new_department_id = $_GET['new_department_id'];
  $stmt = $conn->prepare('INSERT INTO Admins(admin_id,department_id,star_points,admin_type) VALUES(?,?,?,?)');
  $stmt->bindParam(1,$target_user_id);
  $stmt->bindParam(2,$current_department_id);
  $stmt->bindParam(3,$star_points);
  $stmt->bindParam(4,$new_admin_type);
  $stmt->execute();
  $stmt = $conn->prepare('INSERT INTO Admin_Tasks(task_type,user_id,admin_id,task_time) VALUES(?,?,?,?)');
  $time = date('d/m/Y H:i');
  $stmt->bindParam(1,$task_type);
  $stmt->bindParam(2,$target_user_id);
  $stmt->bindParam(3,$_SESSION['user_id']);
  $stmt->bindParam(4,$time);
  $stmt->execute();
  $_SESSION['message'] = 'You successfully promoted ' . $target_username . ' to admin!';
  ob_clean();
  header('Location:../management/user_managment.php');
  exit();
 }
 if($action_type == 'demotion' && $old_role == 'agent'){
  $task_type ='demotion';
  $new_role = 'client';
  $stmt = $conn->prepare('UPDATE Users SET usertype = ? where user_id = ?');
  $stmt->bindParam(1,$new_role);
  $stmt->bindParam(2,$target_user_id);
  $stmt->execute();
  $new_department_id = $_GET['new_department_id'];
  $stmt = $conn->prepare('DELETE FROM Agents WHERE agent_id = ?');
  $stmt->bindParam(1,$target_user_id);
  $stmt->execute();
  $stmt = $conn->prepare('DELETE FROM Assignments WHERE user_id = ?');
  $stmt->bindParam(1,$target_user_id);
  $stmt->execute();
  $stmt = $conn->prepare('INSERT INTO Admin_Tasks(task_type,user_id,admin_id,task_time) VALUES(?,?,?,?)');
  $time = date('d/m/Y H:i');
  $stmt->bindParam(1,$task_type);
  $stmt->bindParam(2,$target_user_id);
  $stmt->bindParam(3,$_SESSION['user_id']);
  $stmt->bindParam(4,$time);
  $stmt->execute();
  $_SESSION['message'] = 'You successfully demoted ' . $target_username . ' to client!';
  ob_clean();
  header('Location:../management/user_managment.php');
  exit();
 }
 if($action_type == 'demotion' && $old_role == 'admin'){
  $task_type = 'demotion';
  $new_role = 'agent';
  $stmt = $conn->prepare('UPDATE Users SET usertype = ? where user_id = ?');
  $stmt->bindParam(1,$new_role);
  $stmt->bindParam(2,$target_user_id);
  $stmt->execute();
  $stmt = $conn->prepare('SELECT department_id FROM Admins WHERE admin_id =?');
  $stmt->bindParam(1,$target_user_id);
  $stmt->execute();
  $new_department_id = $_GET['new_department_id'];
  $stmt = $conn->prepare('DELETE FROM Admins WHERE admin_id = ?');
  $stmt->bindParam(1,$target_user_id);
  $stmt->execute();
  $stmt = $conn->prepare('INSERT INTO Agents(agent_id,department_id,star_points) VALUES(?,?,?)');
  $stmt->bindParam(1,$target_user_id);
  $stmt->bindParam(2,$current_department_id);
  $stmt->bindParam(3,$star_points);
  $stmt = $conn->prepare('INSERT INTO Admin_Tasks(task_type,user_id,admin_id,task_time) VALUES(?,?,?,?)');
  $time = date('d/m/Y H:i');
  $stmt->bindParam(1,$task_type);
  $stmt->bindParam(2,$target_user_id);
  $stmt->bindParam(3,$_SESSION['user_id']);
  $stmt->bindParam(4,$time);
  $stmt->execute();
  $_SESSION['message'] = 'You successfully demoted ' . $target_username . ' to agent!';
  ob_clean();
  header('Location:../management/user_managment.php');
  exit();
 }
}
else{
 $_SESSION['message'] = 'You cannot promote or demote a main admin!';
 ob_clean();
 header('Location:../management/user_managment.php');
 exit();
}
}
?>