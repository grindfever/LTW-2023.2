<?php

session_start();
ob_start();

$conn = new PDO('sqlite:../database.db');
function add_paragraphs($input) {
    $paragraphs = explode("\n", $input);
    $output = '';
    foreach ($paragraphs as $paragraph) {
    $output .= "<p>$paragraph</p>";
    }
    return $output;
}

if(isset($_POST['submit'])){
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        $client_id = $_SESSION['user_id'];
        $ticket_title = $_POST['title'];
        $ticket_department = $_POST['department'];
        $description = $_POST['description'];
        $ticket_priority = $_POST['priority'];
        $ticket_hashtag = $_POST['hashtag'];
        $ticket_description = add_paragraphs($_POST['description']);
        $ticket_status = 'open';
        $time = date('d/m/Y H:i');
        
        if(!empty($ticket_title) and !empty($description)){
            try{
                $stmt = $conn->prepare('SELECT department_id FROM Departments WHERE department_name = ?');
                $stmt->bindParam(1,$ticket_department);
                $stmt->execute();
                $ticket_department_id = $stmt->fetchColumn();
                $stmt = $conn->prepare('INSERT INTO Tickets(client_id,ticket_title,ticket_description,ticket_department_id,ticket_status,ticket_register_time,ticket_priority,ticket_hashtag) VALUES(?,?,?,?,?,?,?,?)');
                $stmt->bindParam(1, $client_id);
                $stmt->bindParam(2, $ticket_title);
                $stmt->bindParam(3, $ticket_description);
                $stmt->bindParam(4, $ticket_department_id);
                $stmt->bindParam(5, $ticket_status);
                $stmt->bindParam(6, $time);
                $stmt->bindParam(7, $ticket_priority);
                $stmt->bindParam(8, $ticket_hashtag);
                $stmt->execute();
                $_SESSION['message'] = 'Your ticket was successfully submitted';
                ob_clean();
                header('Location: ticket_form.php');
                exit();
            }
            catch (PDOException $e) {
                echo 'Error: ' . $e->getMessage();
            }
        }
        else{
            $_SESSION['message'] = 'You must fill in all the required fields!';
            ob_clean();
            header('Location: ticket_form.php');
            exit();
        }
    }
}
?>