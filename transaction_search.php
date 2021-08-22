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
    $sql = "SELECT * FROM `transaction`WHERE transMid= " . $_SESSION['id'] . "";
    $result = mysqli_query($db_link, $sql);
    ?>
    <main>
        <div class="row  gx-5 justify-content-center " style=" height:100%; ">
            <div class="col-sm-8 lign-self-center getborder " style=" height:600px;">
                <div class="row  gx-5 justify-content-center border-bottom marginTop">
                    <h4>交易資料</h4>
                    <div class="col-sm-12 align-self-center overflow-auto border-bottom bg-white marginTop" style=" height:250px;">
                        <table class="table bg-white ">
                            <thead>
                                <tr>
                                    <th>交易編號</th>
                                    <th>交易時間</th>
                                    <th>交易總金額</th>

                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                //顯示分類標題

                                while ($transation = mysqli_fetch_array($result)) {

                                    echo '<tr>';
                                    echo '<td><a href="transaction_search_done.php?id=' . $transation['tNo'] . '">' . $transation['tNo'] . '</a></td>';
                                    echo '<td>' . $transation['transTime'] . '</td>';
                                    echo '<td>$' . $transation['total'] . '</p>';

                                    echo '</tr>';
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>

    </main>
    <?php include("footer.php"); ?>
</body>

</html>
<style scoped>
    .marginTop {
        margin-top: 3%;
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

    .border-bottom {
        border-bottom: 13px solid red;
    }

    .list-group-item {
        border: 0px;
        font-size: 14px;
        padding: 4px;
        background-color: transparent;
    }
</style>