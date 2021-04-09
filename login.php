<?php

function pokusLogin()
{

    include_once("../config.php");

    try {
        $conn = new PDO("mysql:host=$servername;dbname=pribulikZadanie05", $username, $password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }

    return $conn;


}