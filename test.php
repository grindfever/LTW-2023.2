<?php
// This is not a page of the website, it is only designed to test updates to the database
$conn = new PDO('sqlite:database.db');
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
?>