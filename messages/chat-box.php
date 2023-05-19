<?php
if(!isset($_SESSION)) 
{ 
  session_start(); 
} 
$conn = new PDO('sqlite:../database.db');

function fetch_messages_by_ticket_id($conn) {
  $ticket_id = $_SESSION['ticket_id'];
  $stmt = $conn->prepare('SELECT * FROM Messages WHERE ticket_id=?');
  $stmt->bindParam(1, $ticket_id);
  $stmt->execute();

  $messages = $stmt->fetchAll();

  return $messages;
}

function fetch_username_by_id($conn, $user_id) {
  $stmt = $conn->prepare('SELECT username FROM Users WHERE user_id = ' . $user_id);
  $stmt->execute();
  $username = $stmt->fetch()[0];

  return $username;
}

function fetch_all_messages($conn) {
  // Get all mesages assigned to this ticket
  $messages = fetch_messages_by_ticket_id($conn);

  // Get current user id <=> sender id
  $current_user_id = $_SESSION['user_id'];

  $output = '';
  foreach($messages as $message) {
    if($message['sender_id'] == $current_user_id){
      $div_name = 'my_message';
    }
    else{
      $div_name = 'received_message';
    }

    // TODO: Make sure the username is right
    $current_username = fetch_username_by_id($conn, $current_user_id);

    // Display all the messages associated to this ticket
    $output .= '<div class="text_message" id = "' . $div_name . '" ><p id ='. $message['time_of_message'] . ' >' . $current_username . '<small> ' .  $message['time_of_message'] . '</small></p><p>' . $message['content'] . '</p></div>';
  }
  return $output;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  if (count($_POST) > 0) {
    $stmt = $conn->prepare('INSERT INTO Messages(receiver_id,sender_id,content,ticket_id,time_of_message) VALUES(?,?,?,?,?)');
    
    $new_message = $_POST['new_message'];
    $sender_id = $_SESSION['user_id'];
    $receiver_id = $_SESSION['client_id'];
    $ticket_id = $_SESSION['ticket_id'];
    $time_of_message = date('d/m/Y H:i');

    $stmt->bindParam(1,$receiver_id);
    $stmt->bindParam(2,$sender_id);
    $stmt->bindParam(3,$new_message);
    $stmt->bindParam(4,$ticket_id);
    $stmt->bindParam(5,$time_of_message);
    $stmt->execute();
  }
}

echo fetch_all_messages($conn);

?>