<?php

    $oMysqli = new mysqli("localhost", "root", "", "message");
    $oMysqli->query("SET NAMES utf8");

    $iId = $_POST["guestId"];
    var_dump($id);
    $sNewName = $_POST["updateName"];
    $sNewContent = $_POST["updateMessage"];

    $oStmt = $oMysqli->prepare("UPDATE guest SET `name`=?, content=? WHERE id = $iId");
    $oStmt->bind_param("ss", $sNewName, $sNewContent);
    $oStmt->execute();

?>