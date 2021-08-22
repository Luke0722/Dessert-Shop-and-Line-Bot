<?php @session_start(); ?>
<!DOCTYPE html>
<html>

<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>荻瑟特</title>
        <link rel="stylesheet" href="general.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
</head>

<body>
        <?php
        header("Content-Type:text/html;charset=utf-8");
        include("connMysql.php");          //連線資料庫、選擇資料庫
        include_once("header.php");
        ?>


        <?php
        //此判斷為判定觀看此頁有沒有權限
        //說不定是路人或不相關的使用者
        //因此要給予排除
        if (isset($_SESSION['id'])) {
                $id = $_SESSION['id'];
                //將資料庫裡的所有會員資料顯示在畫面上
                $sql = "SELECT * FROM member NATURAL JOIN `level` WHERE mId = '$id'";
                $result = mysqli_query($db_link, $sql);
                $row = mysqli_fetch_row($result);
        ?>
                <div class="container">
                        <div class="row marginTop ">
                                <div class="col-2">
                                        <button type="button" class="btn btn-primary btn-sm" onclick="window.location.href='logout.php'">登出</button>
                                </div>
                                <div class="col-2">
                                        <button type="button" class="btn btn-primary btn-sm" onclick="window.location.href='transaction_search.php'">交易查詢</button>
                                </div>
                        </div>
                        <hr>
                        <div class="row marginTop ">
                                <div class="col-sm-6 ">


                                        <h6>會員ID：<?= $row[1]; ?></h6>
                                        <h6>姓名：<?= $row[2]; ?></h6>
                                        <h6>email：<?= $row[3]; ?></h6>
                                        <h6>密碼：<?= $row[7]; ?></h6>
                                        <h6>手機號碼：<?= $row[4]; ?></h6>
                                        <h6>地址：<?= $row[5]; ?></h6>
                                        <h6>銀行帳號：<?= $row[6]; ?></h6>
                                        <h6>會員等級：<?= $row[8]; ?></h6>
                                </div>
                        </div>
                        <div class="row marginTop marginBottom">
                                <div class="col-sm-1"> <button type="button" class="btn btn-info btn-sm" onclick="window.location.href='register.php'">新增</button>
                                </div>
                                <div class="col-sm-1"> <button type="button" class="btn btn-info btn-sm" onclick="window.location.href='update.php'">修改</button>
                                </div>

                        </div>
                </div>

        <?php
        } else {
                echo '您無權限觀看此頁面!';
        }
        include("footer.php");
        ?>
</body>

</html>
<style scoped>
        .marginTop {
                margin-top: 2%;
        }

        .marginBottom {
                margin-bottom: 3%;
        }

        .btn {
                width: 100%;
        }

        .form-select {
                display: inline;
                width: 60%;
        }

        main {
                background: #fbfbf3;
                margin: 0px;
        }

        img {
                width: 80px;
        }

        p {
                display: inline;

        }

        .bg-white {
                background: white;
        }

        .border-top {
                border-top: 13px solid red;
        }
</style>