<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Message</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="http://code.jquery.com/jquery-3.3.1.min.js"></script>
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
                    <?php echo $rowId . ', ' . $rowName . ', ' . $rowContent; ?>
                    <!-- <button type="submit" class="btn btn-info btn-sm">修改</button> -->
                    <button type="submit" class="btn btn-info btn-sm editModal" data-toggle="modal" data-target="#alterModal" id="<?php echo $rowId; ?>">修改</button>
                    <!-- <button type="submit" class="btn btn-danger btn-sm">刪除</button> -->
                    <button type="submit" class="btn btn-danger btn-sm"><a href="delete.php?id=<?php echo $rowId; ?>">刪除</a></button>
                </div>
            </div>

        <?php } ?>

            <!-- Modal -->
            <form>
                <div class="modal fade" id="alterModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-backdrop="static">
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
                                <div class="form-group">
                                    <label>暱稱：</label>
                                    <input type="text" class="form-control" name="updateName" value="" id="modalName">
                                </div>
                                <div class="form-group">
                                    <label>留言：</label>
                                    <textarea class="form-control" rows="3" name="updateMessage" id="modalMessage"></textarea>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-info" data-dismiss="modal">取消</button>
                                <button type="button" class="btn btn-danger" id="update">確認修改</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

    </div>

    <script>

    var editId = "";
    // var editName = "";
    // var editContent = "";

    // function editClick($rowId, $name, $content) {
        // alert($rowId);
        // alert($name);
        // alert($content);
        // editId = $rowId;
        // editName = $name;
        // editContent = $content;
        // document.getElementById("modalName").value = editName;
        // document.getElementById("modalMessage").value = editContent;
    // };

    $(document).ready(function() {

        $('#update').click(function() {
            // var modalId = $('#modalId').val();
            var modalName = $('#modalName').val();
            var modalMessage = $('#modalMessage').val();
            // console.log(editId);
            // console.log(modalName);
            // console.log(modalMessage);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                method: 'POST',
                url: 'update.php',
                data: {
                    'guestId': editId,
                    'updateName': modalName,
                    'updateMessage': modalMessage,
                },
                success: function() {
                    location.reload();
                    // console.log(modalName);
                    // console.log(modalMessage);
                }
            })

        });

        $('.editModal').click(function() {
            editId = $(this).attr('id');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                method: 'POST',
                url:'modal.php',
                data: {
                    'modalId': editId,
                },
                success: function($_response) {
                    var resModal = JSON.parse($_response);
                    $('#modalName').val(resModal.modalName);
                    $('#modalMessage').val(resModal.modalContent);
                }
            })
        });

    })

    </script>

</body>
</html>