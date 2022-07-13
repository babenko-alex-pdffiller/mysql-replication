<?php

$pdo = new PDO('mysql:host=mysql;dbname=mydb', 'mydb_user', 'mydb_pwd');

$query = 'CREATE TABLE users(
        id int NOT NULL AUTO_INCREMENT,
        email  VARCHAR(20) NOT NULL,
        birthday_at DATETIME NOT NULL, 
        created_at DATETIME NOT NULL, 
        updated_at DATETIME NOT NULL,
        PRIMARY KEY (id)        
    );';
$ret = $pdo->exec($query);

echo 'Table created successfully', "\n";

foreach (range(1, 1000) as $firstItem) {
    $values = '';
    foreach (range(1, 1000) as $secondItem) {
        $email  = $firstItem . $secondItem . '@test.com';
        $birthdayAt = '2000-01-01 00:00:00';
        $createdAt = $updatedAt = date('Y-m-d H:i:s');
        $values .= "('$email', '$birthdayAt', '$createdAt', '$updatedAt'),";
    }
    $values = substr($values, 0, -1);
    $pdo->exec("INSERT INTO users (email, birthday_at, created_at, updated_at) VALUES $values");
    echo '.';
}

echo '.';

echo 'Data inserted successfully', "\n";
