<?php

    $oLink = mysqli_connect("localhost", "root", "", "message");

    $iId = $_POST['modalId'];

    $bNameResult = mysqli_query($oLink, "SELECT `name` FROM guest WHERE id = $iId");
    $aNameSend = mysqli_fetch_array($bNameResult);
    
    $bContentResult = mysqli_query($oLink, "SELECT content FROM guest WHERE id = $iId");
    $bContentSend = mysqli_fetch_array($bContentResult);

    echo json_encode(array('modalName' => $aNameSend['name'], 'modalContent' => $bContentSend['content']));

?>