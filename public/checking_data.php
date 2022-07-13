<?php

$pdoMaster = new PDO('mysql:host=mysql;dbname=mydb', 'mydb_user', 'mydb_pwd');
$pdoSlave = new PDO('mysql:host=mysql-slave;dbname=mydb', 'mydb_slave_user', 'mydb_slave_pwd');
$pdoSecond = new PDO('mysql:host=mysql-second;dbname=mydb', 'mydb_second_user', 'mydb_second_pwd');

echo "\nstarted checking\n";

foreach (range(1, 10) as $item) {
    $data = $pdoMaster->query("SELECT SQL_NO_CACHE * from users ORDER BY id DESC LIMIT 1")->fetch();
    $lastId = $data['id'];
    echo "Last ID from master: $lastId\n";

    $data = $pdoSlave->query("SELECT SQL_NO_CACHE * from users WHERE id = {$lastId}")->fetch();
    $lastSlaveId = $data['id'];
    echo "Last ID from slave: $lastSlaveId\n";

    $data = $pdoSecond->query("SELECT SQL_NO_CACHE * from users WHERE id = {$lastId}")->fetch();
    $lastSecondId = $data['id'];
    echo "Last ID from second: $lastSecondId\n";

    if (
        $lastId !== $lastSlaveId
        || $lastId !== $lastSecondId
    ) {
        throw new RuntimeException('last ids in replica is not equals');
    }
}

echo "finished checking\n";
