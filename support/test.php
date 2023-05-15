<?php
// This is not a page of the website, it is only designed to test updates to the database
$conn = new PDO('sqlite:../database.db');
$query = "SELECT user_id,username,email,usertype FROM Users";
$stmt = $conn->query($query);
$table = $stmt->fetchAll();

echo '<table>';
echo "<tr><th>ID</th><th>Username</th><th>Email</th><th>User Type</th></tr>";
foreach ($table as $row) {
    echo "<tr>";
    echo "<td>" . $row['user_id'] . "</td>";
    echo "<td>" . $row['username'] . "</td>";
    echo "<td>" . $row['email'] . "</td>";
    echo "<td>" . $row['usertype'] . "</td>";
    echo "</tr>";
}
echo '</table>';

$query1 = "SELECT * FROM Admins";
$stmt = $conn->query($query1);
$table1 = $stmt->fetchAll();

echo '<table>';
echo "<tr><th>ID</th><th>DepartmentID</th><th>Star Points</th><th>Admin Type</th></tr>";
foreach ($table1 as $row) {
    echo "<tr>";
    echo "<td>" . $row['admin_id'] . "</td>";
    echo "<td>" . $row['department_id'] . "</td>";
    echo "<td>" . $row['star_points'] . "</td>";
    echo "<td>" . $row['admin_type'] . "</td>";
    echo "</tr>";
}
echo '</table>';

$query2 = "SELECT * FROM Tickets";
$stmt = $conn->query($query2);
$table2 = $stmt->fetchAll();

echo '<table>';
echo "<tr><th>TicketID</th><th>ClientID</th><th>Ticket Title</th><th>DepartmentID</th><th>Ticket Status</th><th>Ticket Priority</th></tr>";
foreach ($table2 as $row) {
    echo "<tr>";
    echo "<td>" . $row['ticket_id'] . "</td>";
    echo "<td>" . $row['client_id'] . "</td>";
    echo "<td>" . $row['ticket_title'] . "</td>";
    echo "<td>" . $row['ticket_department_id'] . "</td>";
    echo "<td>" . $row['ticket_status'] . "</td>";
    echo "<td>" . $row['ticket_description'] . "</td>";
    echo "<td>" . $row['ticket_register_time'] . "</td>";
    echo "<td>" . $row['ticket_priority'] . "</td>";
    echo "</tr>";
}
echo '</table>';

$query3 = "SELECT * FROM Departments";
$stmt = $conn->query($query3);
$table3 = $stmt->fetchAll();
echo '<table>';
echo "<tr><th>DepartmentID</th><th>Department Name</th><th>Department AdminID</th></tr>";
foreach ($table3 as $row) {
    echo "<tr>";
    echo "<td>" . $row['department_id'] . "</td>";
    echo "<td>" . $row['department_name'] . "</td>";
    echo "<td>" . $row['department_admin_id'] . '</td>';
    echo "</tr>";
}
echo '</table>';

$query4 = "SELECT * FROM Agents";
$stmt = $conn->query($query4);
$table4 = $stmt->fetchAll();
echo '<table>';
echo "<tr><th>Agent ID</th><th>Department ID</th><th>Star Points</th></tr>";
foreach ($table4 as $row) {
    echo "<tr>";
    echo "<td>" . $row['agent_id'] . "</td>";
    echo "<td>" . $row['department_id'] . "</td>";
    echo "<td>" . $row['star_points'] . '</td>';
    echo "</tr>";
}
echo '</table>';

$query5 = "SELECT * FROM Assignments";
$stmt = $conn->query($query5);
$table5 = $stmt->fetchAll();
echo '<table>';
echo "<tr><th>Staff ID</th><th>Ticket ID</th></tr>";
foreach ($table5 as $row) {
    echo "<tr>";
    echo "<td>" . $row['user_id'] . "</td>";
    echo "<td>" . $row['ticket_id'] . "</td>";
    echo "</tr>";
}
echo '</table>';

$query6 = "SELECT * FROM Messages";
$stmt = $conn->query($query6);
$table6 = $stmt->fetchAll();
echo '<table>';
echo "<tr><th>Sender ID</th><th>Ticket ID</th><th>Content</th><th>Time</th></tr>";
foreach ($table6 as $row) {
    echo "<tr>";
    echo "<td>" . $row['sender_id'] . "</td>";
    echo "<td>" . $row['ticket_id'] . "</td>";
    echo "<td>" . $row['content'] . "</td>";
    echo "<td>" . $row['time_of_message'] . "</td>";
    echo "</tr>";
}
echo '</table>';
?>