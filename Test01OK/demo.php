<?php

$mysqli = new mysqli("localhost", "root", "", "message");
$mysqli->query("SET NAMES utf8");
// $stmt->close();
// $mysqli->close();
$sql = "SELECT * FROM guest";
$stmt = $mysqli->prepare($sql);
$stmt->execute();
$stmt->store_result($id, $name, $data, $content)
// header("Location: message.php");

?>