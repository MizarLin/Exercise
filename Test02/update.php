<?php

    $mysqli = new mysqli("localhost", "root", "", "message");
    $mysqli->query("SET NAMES utf8");

    // $stmt->close();
    // $mysqli->close();
    // $id = $_GET["guestId"];
    $id = $_POST["guestId"];
    // echo $id;
    $newName = $_POST["updateName"];
    $newContent = $_POST["updateMessage"];
    // echo $newName;
    // echo $newContent;
    $sql = "UPDATE guest SET `name`=?, content=? WHERE id = $id";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("ss", $newName, $newContent);
    $stmt->execute();
    // header("Location: message.php");

?>