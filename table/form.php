<?php
    include_once 'conn.php';
    $Id = $_POST['Id'];
    $Jmeno = $_POST['Jmeno'];
    $Cas = date("j.m h:i");

    $sql = "INSERT INTO List (Id, Jmeno, Cas)
      VALUES ('$Id', '$Jmeno', '$Cas');";
    mysqli_query($connection, $sql);
    header("Location: table");