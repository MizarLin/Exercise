<?php

    $oMysqli = new mysqli("localhost", "root", "", "message");
    $oMysqli->query("SET NAMES utf8");

    $sName = $_POST["guestName"];
    $sContent = $_POST["guestMessage"];

    $oStmt = $oMysqli->prepare("INSERT INTO guest (`name`, content) VALUES (?, ?)");
    $oStmt->bind_param("ss", $sName, $sContent);
    $oStmt->execute();
    header("Location: index.php");

?>