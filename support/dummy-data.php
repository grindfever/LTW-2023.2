<?php

$conn = new PDO('sqlite:database.db');

$insert_sql = "INSERT INTO Users (user_id,username, passwrd, first_name, last_name, email, phone_number, home_address, postal_code, usertype, registration_time)
                   VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, 'admin', ?)";
$stmt = $conn->prepare($insert_sql);

$my_id = 100650;
$my_username = 'frankie02m';
$my_password = password_hash('ACMLFCf2021.',PASSWORD_DEFAULT);
$my_name = 'Francisco';
$my_lastname = 'Magalhães';
$my_email = 'francisco.magalhaes2002@gmail.com';
$my_phone_number = '916630256';
$my_address = 'Travessa Fernando Namora, n10, 3esquerdo';
$my_postal_code = '4425-701';
$my_registration_time = 'NOW()';
$my_department_id = 751;
$my_star_points = 5;
$my_admin_type = 'main admin';

$stmt->bindParam(1, $my_id);
$stmt->bindParam(2, $my_username);
$stmt->bindParam(3, $my_password);
$stmt->bindParam(4, $my_name);
$stmt->bindParam(5, $my_lastname);
$stmt->bindParam(6, $my_email);
$stmt->bindParam(7, $my_phone_number);
$stmt->bindParam(8, $my_address);
$stmt->bindParam(9, $my_postal_code);
$stmt->bindParam(10, $my_registration_time);

$stmt->execute();

$update_sql = "INSERT INTO Admins (admin_id,department_id,star_points,admin_type) VALUES(?,?,?,?)";

$stmt = $conn->prepare($update_sql);

$stmt->bindParam(1,$my_id);
$stmt->bindParam(2,$my_department_id);
$stmt->bindParam(3,$my_star_points);
$stmt->bindParam(4,$my_admin_type);

$stmt->execute();

$passwords = array('pasSword!123', 'abc1DF23eg0', 'qwert_T..y', 'leT*mein', '123456FVc@', 'nsjST.1122', 'dfgUwkp012', 'VXN999GTIf');

$addresses = array(
    '123 Main St',
    '456 Maple Ave',
    '789 Oak St',
    '111 Elm St',
    '222 Pine St'
);

$first_names = array('John', 'Mary', 'David', 'Sarah', 'Michael', 'Karen', 'Robert', 'Emily', 'James', 'Jennifer', 'Frank', 'Kurt', 'Nancy', 'Mark', 'Albert', 'Gustavo', 'Katherine');

$last_names = array('Smith', 'Johnson', 'Brown', 'Wilson', 'Davis', 'Jones', 'Taylor', 'Anderson', 'Martin', 'Thomas', 'Ferguson', 'Mcgregor', 'Peterson', 'Patterson');

$email_providers = array('gmail.com', 'yahoo.com', 'hotmail.com', 'outlook.com', 'aol.com');


$admin_types = array('main admin', 'local admin');

$d_id = 745;



for ($i = 1; $i <= 6; $i++) {
    $first_name_index = array_rand($first_names);
    $last_name_index = array_rand($last_names);
    $email_provider_index = array_rand($email_providers);
    
    $phone_number = rand(1000000000, 9999999999);
    $postal_code = rand(10000, 99999);
    
    $registration_time = date('Y-m-d H:i:s', strtotime('-' . rand(1, 365) . ' days'));

    $number = rand(0,10000);
    
    $username = strtolower($first_names[$first_name_index] . '.' . $last_names[$last_name_index]) . $number;
    $password_index = array_rand($passwords);
    $password = password_hash($passwords[$password_index], PASSWORD_DEFAULT);
    $email = strtolower($first_names[$first_name_index] . '.' . $last_names[$last_name_index] . '@' . $email_providers[$email_provider_index]);
    
    $address_index = array_rand($addresses);
    $address = $addresses[$address_index];
    
    $insert_sql = "INSERT INTO Users (username, passwrd, first_name, last_name, email, phone_number, home_address, postal_code, usertype, registration_time)
                   VALUES (?, ?, ?, ?, ?, ?, ?, ?, 'admin', ?)";
    
    $stmt = $conn->prepare($insert_sql);
    
    $stmt->bindParam(1, $username);
    $stmt->bindParam(2, $password);
    $stmt->bindParam(3, $first_names[$first_name_index]);
    $stmt->bindParam(4, $last_names[$last_name_index]);
    $stmt->bindParam(5, $email);
    $stmt->bindParam(6, $phone_number);
    $stmt->bindParam(7, $address);
    $stmt->bindParam(8, $postal_code);
    $stmt->bindParam(9, $registration_time);
    
    $stmt->execute();
    
    $admin_id = $conn->lastInsertID();
    $star_points = rand(0,5);

    $admin_type_index = array_rand($admin_types);
    $admin_type = $admin_types[$admin_type_index];

    $update_sql = "INSERT INTO Admins (admin_id, department_id, star_points, admin_type) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($update_sql);
    $stmt->bindParam(1, $admin_id);
    $stmt->bindParam(2, $d_id);
    $stmt->bindParam(3,$star_points);
    $stmt->bindParam(4,$admin_type);
    $stmt->execute();
    $d_id += 1;
}

?>