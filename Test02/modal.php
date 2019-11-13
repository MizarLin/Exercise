<?php
    // $mysqli = new mysqli("localhost", "root", "", "message");
    // $mysqli->query("SET NAMES utf8");

    // $id = $_POST['editId'];
    // $sql = "SELECT * FROM guest WHERE id = $id";
    // $stmt = $mysqli->prepare($sql);
    // $stmt->execute();
    // $stmt->store_result();
    // $stmt->bind_result($modalId, $modalName, $modalData, $modalContent);

    $link = mysqli_connect("localhost", "root", "") or die ("無法開啟Mysql資料庫連結"); //建立mysql資料庫連結
    mysqli_select_db($link, "message"); //選擇資料庫message

    $id = $_POST['modalId'];
    // var_dump($id);

    // $nameSql = "SELECT `name` FROM guest WHERE id = $id";
    $nameResult = mysqli_query($link, "SELECT `name` FROM guest WHERE id = $id"); //執行SQL查詢
    $nameSend = mysqli_fetch_array($nameResult);

    // $contentSql = "SELECT content FROM guest WHERE id = $id";
    $contentResult = mysqli_query($link, "SELECT content FROM guest WHERE id = $id"); //執行SQL查詢
    $contentSend = mysqli_fetch_array($contentResult);

    echo json_encode(array('modalName' => $nameSend['name'], 'modalContent' => $contentSend['content']));

    //$row = mysqli_fetch_assoc($result); //將陣列以欄位名索引
    //$row = mysqli_fetch_row($result); //將陣列以數字排列索引
    // $total_fields=mysqli_num_fields($result); //取得欄位數
    // $total_records=mysqli_num_rows($result);  //取得記錄數    
?>