<?php

$conn = new PDO('sqlite:database.db');

$insert_sql = "INSERT INTO Users (username, passwrd, first_name, last_name, email, phone_number, home_address, postal_code, usertype, registration_time)
                   VALUES (?, ?, ?, ?, ?, ?, ?, ?, 'agent', ?)";
$stmt = $conn->prepare($insert_sql);

$my_username = 'frankie_agent02_2.0';
$my_password = password_hash('ACMLFCf2021.',PASSWORD_DEFAULT);
$my_name = 'Francisco';
$my_lastname = 'Magalhães';
$my_email = 'francisco.mag.alhaes.2002@gmail.com';
$my_phone_number = '916630256';
$my_address = 'Travessa Fernando Namora, n10, 3esquerdo';
$my_postal_code = '4425-701';
$my_registration_time = 'NOW()';
$my_department_id = 751;
$my_star_points = 5;

$stmt->bindParam(1, $my_username);
$stmt->bindParam(2, $my_password);
$stmt->bindParam(3, $my_name);
$stmt->bindParam(4, $my_lastname);
$stmt->bindParam(5, $my_email);
$stmt->bindParam(6, $my_phone_number);
$stmt->bindParam(7, $my_address);
$stmt->bindParam(8, $my_postal_code);
$stmt->bindParam(9, $my_registration_time);

$stmt->execute();
$agent_id = $conn->lastInsertID();
$update_sql = "INSERT INTO Agents (agent_id,department_id,star_points) VALUES(?,?,?)";

$stmt = $conn->prepare($update_sql);

$stmt->bindParam(1,$agent_id);
$stmt->bindParam(2,$my_department_id);
$stmt->bindParam(3,$my_star_points);

$stmt->execute();

