<?php

    $mysqli = new mysqli("localhost", "root", "", "message");
    $mysqli->query("SET NAMES utf8");
    // $stmt->close();
    // $mysqli->close();
    $name = $_POST["guestName"];
    $content = $_POST["guestMessage"];
    $sql = "INSERT INTO guest (`name`, content) VALUES (?, ?)";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("ss", $name, $content);
    $stmt->execute();
    header("Location: message.php");

?>