<?php

    $oMysqli = new mysqli("localhost", "root", "", "message");
    $oMysqli->query("SET NAMES utf8");

    $iId = $_POST["cardId"];

    $oStmt = $oMysqli->prepare("DELETE FROM guest WHERE id = $iId");
    $oStmt->execute();

?>