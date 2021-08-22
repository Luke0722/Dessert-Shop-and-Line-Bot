<?php
@session_start();
if (!isset($_SESSION['id']))
    echo "沒有權限";

?>
<!Doctype html>

<head>
    <meta charset="utf-8">
    <title>荻瑟特</title>
    <link rel="stylesheet" href="general.css">
    <!--各頁面通用CSS-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
    <script type="text/javascript">

    </script>
</head>

<body>
    <?php
    //資料庫+資料表連線----------------------------------------------
    header("Content-Type:text/html;charset=utf-8");
    include("connMysql.php");          //連線資料庫、選擇資料庫
    $sql = "SELECT cart.mId,cart.cartTime,order.pNo,pName,price,amount,picture
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
    $sql2 = "SELECT name,phone,address
            FROM `member`
            WHERE mId= " . $_SESSION['id'] . "";
    $result = mysqli_query($db_link, $sql);
    $result2 = mysqli_query($db_link, $sql2);
    $member = mysqli_fetch_array($result2);
    $nums = mysqli_num_rows($result);
    include("header.php");
    ?>
    <main>
        <div class="container  overflow-hidden ">
            <div class="row  gx-5 " style=" height:100%; ">
                <div class="col-sm-8 align-self-center overflow-auto " style=" border-right:1px solid black;  height:400px;">
                    <table class="table " id="table1">
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
                            if ($nums > 0) {
                                $result->data_seek(0); //將記錄指標移到第一筆
                                $sum = 0;
                                while ($item = mysqli_fetch_array($result)) {
                                    if ($item['amount'] > 0) {
                                        echo '<tr id="item' . $item['pNo'] . '">';
                                        echo '<td> <img src="assets/' . $item['picture'] . '"></img></td>';
                                        echo '<td>' . $item['pName'] . '</td>';
                                        echo '<td> $' . $item['price'] . '</td>';
                                        echo '<td > <p id ="itemAmount' . $item['pNo'] . '">' . $item['amount'] . '</p>';
                                        echo '<td id="itemTotal' . $item['pNo'] . '">$' . ($item['price'] * $item['amount']) . '</td>';
                                        echo '</tr>';
                                        $sum = $sum + $item['price'] * $item['amount'];
                                    }
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <div class="col-sm-4 align-self-center ">
                    <h4>結帳</h4>
                    <form class="marginTop" enctype="multipart/form-data" method="post" action="transaction_done.php">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item ">付款人：<?= $member['name']; ?></li>
                            <li class="list-group-item">
                                付款方式：
                                <select class="form-select form-select-sm" aria-label=".form-select-sm example" name="method">
                                    <option selected value="1">現金(來店取貨)</option>
                                    <option value="2">匯款(宅配)</option>
                                </select>
                            </li>
                            <li class="list-group-item">電話：<?= $member['phone']; ?></li>
                            <li class="list-group-item">地址：<?= $member['address']; ?></li>
                            <li class="list-group-item">總金額：$<?= $sum; ?></li>
                            <input type="hidden" name="total" value="<?= $sum; ?>">
                        </ul>
                        <div class="center marginTop">
                            <button type="submit" name="submit" class="btn btn-primary ">結帳</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
</body>

</html>
<style scoped>
    .marginTop {
        margin-top: 10%;
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
        width: 150px;
    }

    p {
        display: inline;
    }

    .list-group-item {
        border: 0px;
    }
</style>