<?php
$conn = new PDO('sqlite:../database.db');
$stmt = $conn->prepare('INSERT INTO Messages(message_id,sender_id,receiver_id,content,time_of_message) VALUES(?,?,?,?,?)');
$first_id = 1330106;
$sender_id = 100650;
$receiver_id = 100651;
$content = 'Just manually setting the first message id';
$time_of_message = date('d/m/Y H:i');
$stmt->bindParam(1,$first_id);
$stmt->bindParam(2,$sender_id);
$stmt->bindParam(3,$sender_id);
$stmt->bindParam(4,$content);
$stmt->bindParam(5,$time_of_message);
$stmt->execute();
?>