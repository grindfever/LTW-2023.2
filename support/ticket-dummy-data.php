<?php
$conn = new PDO('sqlite:database.db');
$ticket_id = 50501;
$client_id = 100657;
$ticket_title = 'Loud PC fan and slow laptop';
$ticket_description = 'Hello, I am experiencing hardware issues with my laptop. The laptop is running very slow and the fan is making a loud noise. Additionally, I have noticed that the battery is draining very quickly and the laptop is getting very hot.<br><br>I have tried restarting the laptop and closing any unnecessary applications, but the issue persists. I suspect that there may be a problem with the fan or the battery.<br><br>Please let me know what steps I need to take to resolve this issue. I am currently working from home and need my laptop to complete my work.<br><br>Thank you for your assistance.<br><br>Best regards,<br>Gustavo Nelson';

$ticket_department = 746;
$ticket_status = 'open';
$time = time();

$stmt = $conn->prepare('INSERT INTO Tickets(ticket_id,client_id,ticket_title,ticket_description,ticket_department_id,ticket_status,ticket_register_time) VALUES(?,?,?,?,?,?,?)');
$stmt->bindParam(1,$ticket_id);
$stmt->bindParam(2,$client_id);
$stmt->bindParam(3,$ticket_title);
$stmt->bindParam(4,$ticket_description);
$stmt->bindParam(5,$ticket_department);
$stmt->bindParam(6,$ticket_status);
$stmt->bindParam(7,$time);
$stmt->execute();
?>