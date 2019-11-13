<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Message</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    <style>
        .guestDiv {
            margin: 0px 100px;
        }

        #messageBtn {
            text-align: right;
        }

        #deskTitle {
            font-size: 100px;
            text-align: center;
        }

        #alertBtn {
            text-align: right;
        }
    </style>
</head>
<body>

    <?php
        $link = mysqli_connect("localhost", "root", "") or die ("無法開啟Mysql資料庫連結"); //建立mysql資料庫連結
        mysqli_select_db($link, "message"); //選擇資料庫message
        $sql = "SELECT * FROM guest ORDER BY id DESC"; //在guest資料表中選擇所有欄位
        $result = mysqli_query($link, $sql); //執行SQL查詢
        //$row = mysqli_fetch_assoc($result); //將陣列以欄位名索引
        //$row = mysqli_fetch_row($result); //將陣列以數字排列索引
        $total_fields=mysqli_num_fields($result); //取得欄位數
        $total_records=mysqli_num_rows($result);  //取得記錄數
        // print_r($result);
    ?>

    <div class="guestDiv">

        <div class="form-group" id="deskTitle">
            留言板
        </div>

        <form action="insert.php" method="post">
            <div class="form-group">
                <label for="inputId">暱稱：</label>
                <input type="text" class="form-control" id="inputId" name="guestName" required>
            </div>
            <div class="form-group">
                <label for="inputMessage">留言：</label>
                <textarea class="form-control" id="inputMessage" rows="3" name="guestMessage"></textarea>
            </div>
            <div class="form-group" id="messageBtn">
                <button type="submit" class="btn btn-dark">送出</button>
            </div>
        </form>

        <?php
        // $name = empty($_POST["name"])? die("請輸入暱稱"):mysql_escape_string($_POST["name"]);
        // $content = empty($_POST["content"])? die("請輸入暱稱"):mysql_escape_string($_POST["content"]);
        // $sql = "INSERT INTO guest (name, content) VALUES (?, ?)";
        // $stmt = $mysqli->prepare($sql);
        // $stmt->bind_param("ss", $name, $content);
        // $stmt->execute();
        ?>

        <?php for ($i=0; $i<$total_records; $i++) { $row = mysqli_fetch_assoc($result); $rowId = $row['id']; $rowName = $row["name"]; $rowData = $row["data"]; $rowContent = $row["content"]; ?>

            <div class="card border-secondary mb-3">
                <div class="card-header bg-transparent border-secondary"><?php echo $rowData; ?></div>
                <div class="card-body">
                    <h5 class="card-title"><b><?php echo $rowName; ?></b></h5>
                    <p class="card-text"><?php echo $rowContent; ?></p>
                </div>
                <div class="card-footer bg-transparent border-secondary" id="alertBtn">
                    <?php echo $row['id']; ?>
                    <!-- <button type="submit" class="btn btn-info btn-sm">修改</button> -->
                    <button type="submit" class="btn btn-info btn-sm" data-toggle="modal" data-target="#alterModal<?php echo $rowId; ?>">修改</button>
                    <!-- <button type="submit" class="btn btn-danger btn-sm">刪除</button> -->
                    <button type="submit" class="btn btn-danger btn-sm"><a href="delete.php?id=<?php echo $rowId; ?>">刪除</a></button>
                </div>
            </div>

            <!-- Modal -->
            <form action="update.php" method="post">
                <div class="modal fade" id="alterModal<?php echo $rowId; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-backdrop="static">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalCenterTitle">修改內容</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <!-- ... -->
                                <input type="hidden" name="guestId" value="<?php echo $rowId; ?>">
                                <div class="form-group">
                                    <label for="alertId">暱稱：</label>
                                    <input type="text" class="form-control" id="alertId" name="updateName" value="<?php echo $rowName; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="alertMessage">留言：</label>
                                    <textarea class="form-control" id="alertMessage" rows="3" name="updateMessage"><?php echo $rowContent; ?></textarea>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <?php echo $rowId; ?>
                                <button type="button" class="btn btn-info" data-dismiss="modal">取消</button>
                                <button type="submit" class="btn btn-danger">確認修改</button>
                                <!-- <button type="button" class="btn btn-danger"><a href="update.php?id=<?php echo $rowId ?>">確認修改</a></button> -->
                            </div>
                        </div>
                    </div>
                </div>
            </form>

        <?php } ?>

    </div>

    <script>

    </script>

</body>
</html>