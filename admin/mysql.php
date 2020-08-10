<?php
$host = "localhost";
$name = "carfactory";
$user = "root";
$passwort = '';
try {
    $mysql = new PDO(
        "mysql:host=$host;dbname=$name",
        $user,
        $passwort,
        array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")
    );
} catch (PDOException $e) {
    echo "SQL Error: " . $e->getMessage();
}
