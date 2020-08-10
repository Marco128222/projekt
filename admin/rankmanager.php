<?php

define("DEFAULT", 0);
// RENTALPERMISSIONS
define("RENTALMOD", 1);
define("RENTALADMIN", 2);
// CARFACTORYPERMISSIONS
define("CARMOD", 3);
define("CARADMIN", 4);
// RENTALPERMISSIONS
define("TAXIMOD", 5);
define("TAXIADMIN", 6);
// ADMINPERMISSIONS
define("MOD", 13);
define("ADMIN", 24);

function getRank($username)
{
    require("mysql.php");
    $stmt = $mysql->prepare("SELECT * FROM accounts WHERE USERNAME = :user");
    $stmt->bindParam(":user", $username, PDO::PARAM_STR);
    $stmt->execute();
    $row = $stmt->fetch();
    return $row["RANKGROUP"];
}
