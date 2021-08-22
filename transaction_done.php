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
    $transMid = $_SESSION['id'];
    $method = "";
    $bankAccount = 0;
    $total = 0;
    $tNo = 0;
    if (isset($_POST['submit'])) {
        $sql = "SELECT name,phone,address,account FROM `member`WHERE mId= " . $_SESSION['id'] . "";
        $member = mysqli_fetch_array(mysqli_query($db_link, $sql));
        if ($_POST["method"] == 1)
            $method =  "現金(來店取貨)";
        else
            $method =  "匯款(宅配)";
        $bankAccount = $member['account'];
        $total = $_POST['total'];
        // 1.新增一筆交易
        $sql2 = "INSERT INTO `transaction` (`transMid`,`method`,`bankAccount`,`total`) 
            VALUES ('$transMid','$method','$bankAccount','$total')";
        if (!mysqli_query($db_link, $sql2) == 0) {

            // 2.找出tNo
            $sql3 = "SELECT LAST_INSERT_ID() ";
            $tNo = mysqli_fetch_array(mysqli_query($db_link, $sql3))[0];
            // 3.開始把cart資料放入recordS
            $sql4 = "SELECT cart.mId,cart.cartTime,order.pNo,pName,price,amount,picture
                FROM  `cart`
                LEFT JOIN `order` on cart.mId = order.mId AND cart.cartTime = order.cartTime
                LEFT JOIN `product` on order.pNo =product.pNo 
                WHERE cart.cartTime IN(
                        SELECT t.cartTime FROM  (
                        SELECT * FROM cart WHERE cart.mId= " . $_SESSION['id'] . "
                        ORDER BY cartTime 
                        DESC 
                        LIMIT 1)
                    as t)";
            $result4 = mysqli_query($db_link, $sql4);
            while ($item = mysqli_fetch_array($result4)) {
                $pNo = $item['pNo'];
                $amount = $item['amount'];
                $salesPrice = $item['price'];
                $sql5 = "INSERT INTO `record` (`tNo`,`pNo`,`amount`,`salesPrice`) 
                    VALUES ('$tNo','$pNo','$amount','$salesPrice')";
                mysqli_query($db_link, $sql5);
            }
            $result42 = mysqli_query($db_link, $sql4);
            $item = mysqli_fetch_array($result42);
            $cartTime = $item['cartTime'];
            //把tNo放回cart
            $sql6  =   "UPDATE `cart` SET `tNo` = '$tNo' WHERE `mId`= '$transMid' AND `cartTime`= '$cartTime'";
            if (!mysqli_query($db_link, $sql6) == 0) {
                //建立新的cart
                $sql7 = "INSERT INTO `cart` (`mId`) VALUES ('$transMid');";
                mysqli_query($db_link, $sql7);
            }
        }
    } ?>
    <?php
    $sql8 = "SELECT name,phone,address,tNo,method,transTime,total
            FROM  `member`                
            LEFT JOIN `transaction` on member.mId =transaction.transMid 
            WHERE member.mId = '$transMid' 
            ORDER BY transTime
            DESC
            LIMIT 1";
    $result8 = mysqli_fetch_array(mysqli_query($db_link, $sql8));
    $sql9 = "SELECT pName,price,amount,picture
            FROM  `record`                
            LEFT JOIN `product` on record.pNo =product.pNo 
            WHERE record.tNo = " . $result8['tNo'] . "";
    $result9 = mysqli_query($db_link, $sql9);

    ?>
    <main>
        <div class="row  gx-5 justify-content-center " style=" height:100%; ">
            <div class="col-sm-8 lign-self-center getborder " style=" height:600px;">

                <!-- 訂購商品 -->
                <div class="row  gx-5 justify-content-center border-bottom marginTop">
                    <h4>訂購明細</h4>
                    <div class="col-sm-12 align-self-center overflow-auto border-bottom bg-white marginTop" style=" height:250px;">
                        <table class="table bg-white ">
                            <thead>
                                <tr>
                                    <th>商品</th>
                                    <th>名稱</th>
                                    <th>價格</th>
                                    <th>數量</th>
                                    <th>小計</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                //顯示分類標題
                                $result9->data_seek(0); //將記錄指標移到第一筆
                                while ($item = mysqli_fetch_array($result9)) {

                                    echo '<tr>';
                                    echo '<td> <img src="assets/' . $item['picture'] . '"></img></td>';
                                    echo '<td>' . $item['pName'] . '</td>';
                                    echo '<td>$' . $item['price'] . '</td>';
                                    echo '<td>' . $item['amount'] . '</p>';
                                    echo '<td>$' . ($item['price'] * $item['amount']) . '</td>';
                                    echo '</tr>';
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- 訂購人資料 -->
                <div class="row  gx-5 justify-content-center  marginTop">
                    <div class="col-sm-4 align-self-center  " style=" height:170px;">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">訂單編號：<?= $result8['tNo']; ?></li>
                            <li class="list-group-item">訂購人：<?= $result8['name']; ?></li>
                            <li class="list-group-item">訂購時間：<?= $result8['transTime']; ?></li>
                            <li class="list-group-item">付款方式：<?= $result8['method']; ?></li>
                            <li class="list-group-item">電話：<?= $result8['phone']; ?></li>
                            <li class="list-group-item">地址：<?= $result8['address']; ?></li>
                            <li class="list-group-item">總金額：$<?= $result8['total']; ?></li>
                        </ul>
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