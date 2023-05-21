<?php
session_start();
$conn = new PDO('sqlite:../database.db');

// Fetch department id by name
function fetch_department_id_by_name($conn, $department_name) {
    $stmt = $conn->prepare('SELECT department_id FROM Departments WHERE department_name=?');
    $stmt->bindParam(1, $department_name);
    $stmt->execute();

    return $stmt->fetchColumn();
}

if(isset($_POST)) {
    $ticket_id = $_SESSION['ticket_id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $department = fetch_department_id_by_name($conn, $_POST['department']);
    $priority = $_POST['priority'];
    $hashtag = $_POST['hashtag'];
    var_dump($_POST);

    $stmt = $conn->prepare('UPDATE Tickets SET ticket_title=?,ticket_description=?,ticket_department_id=?,ticket_priority=?,ticket_hashtag=? WHERE ticket_id=?');
    $stmt->bindParam(1, $title);
    $stmt->bindParam(2, $description);
    $stmt->bindParam(3, $department);
    $stmt->bindParam(4, $priority);
    $stmt->bindParam(5, $hashtag);
    $stmt->bindParam(6, $ticket_id);
    $stmt->execute();

    header('Location: view_ticket.php?ticket_id=' . $ticket_id);
}
?>