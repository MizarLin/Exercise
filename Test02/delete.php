<?php

    // $mysqli = new mysqli("localhost", "root", "", "message");
    // $mysqli->query("SET NAMES utf8");
    // // $stmt->close();
    // // $mysqli->close();
    // $id = $_GET["id"];
    // // $content = $_POST["guestMessage"];
    // $sql = "DELETE FROM guest WHERE id = $id";
    // $stmt = $mysqli->prepare($sql);
    // // $stmt->bind_param("s", $name);
    // $stmt->execute();
    // header("Location: message.php");

    $mysqli = new mysqli("localhost", "root", "", "message");
    $mysqli->query("SET NAMES utf8");
    // $stmt->close();
    // $mysqli->close();
    $id = $_POST["cardId"];
    // $content = $_POST["guestMessage"];
    $sql = "DELETE FROM guest WHERE id = $id";
    $stmt = $mysqli->prepare($sql);
    // $stmt->bind_param("s", $name);
    $stmt->execute();
    // header("Location: message.php");

?>