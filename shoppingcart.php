<?php @session_start();

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
        var pNo = 0;
        var amount = 0;
        var cartTime = "";
        var action = "";

        function handleSub(item_pNo, item_amount, member_cartTime) {
            pNo = item_pNo;
            amount = item_amount;
            cartTime = member_cartTime;
            action = "sub";
        }

        function handlePlus(item_pNo, item_amount, member_cartTime) {
            pNo = item_pNo;
            amount = item_amount;
            cartTime = member_cartTime;
            action = "plus";
        }

        function remove_item(item_pNo, member_cartTime) {
            pNo = item_pNo;
            cartTime = member_cartTime;
            action = "delete";
        }

        function goTransaction() {
            action = "goTransaction";

        }
        $(function() {
            var mId = <?php echo  $_SESSION['id'] ?>

            $("button").click(function() {
                var postData = {
                    pNo: pNo,
                    amount: amount,
                    mId: mId,
                    cartTime: cartTime,
                    action: action,
                }
                console.log(postData);

                $.ajax({
                    type: "POST",
                    url: "shoppingcart_done.php",
                    data: postData,
                    async: true, // 異步請求
                    cache: false, // 停止瀏覽器緩存加載
                    success: function(data) {
                        if (action == "sub" || action == "plus") {
                            var name = "#itemAmount" + pNo;
                            console.log(data);
                            $(name).html(data);
                            window.location.reload(true);
                        } else if (action === "goTransaction") {
                            window.location.href="transaction.php";

                        } else {
                            window.location.reload(true);
                        }
                    }
                });
            })
        })
    </script>
</head>

<body>
    <?php
    //資料庫+資料表連線----------------------------------------------
    header("Content-Type:text/html;charset=utf-8");
    include("connMysql.php");          //連線資料庫、選擇資料庫
    $sql = "SELECT cart.mId,cart.cartTime AS cartTime ,order.pNo,pName,price,amount,picture
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
    $result = mysqli_query($db_link, $sql);
    $nums = mysqli_num_rows($result);
    $isShow = false;
    include("header.php");
    ?>
    <div class="container">
        <table class="table table-hover" id="table1">
            <thead>
                <tr>
                    <th>商品</th>
                    <th>名稱</th>
                    <th>價格</th>
                    <th>數量</th>
                    <th>小計</th>
                    <th>刪除</th>
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
                            echo '<td > <button type="button" class="btn btn-outline-primary btn-sm" onclick="handleSub('.$item['pNo'].','.$item['amount'].', ` '. $item['cartTime'] . '`) ;"> - </button>       ';
                            echo '<p id ="itemAmount' . $item['pNo'] . '">' . $item['amount'] . '</p>';
                            echo '     <button type="button" class="btn btn-outline-primary btn-sm" onclick="handlePlus(' . $item['pNo'] . ',' . $item['amount'] . ',`' . $item['cartTime'] . '`);"> + </button> </td> ';
                            echo '<td id="itemTotal' . $item['pNo'] . '">$' . ($item['price'] * $item['amount']) . '</td>';
                            echo '<td> <button type="button" class="btn btn-danger btn-sm" onclick="remove_item(' . $item['pNo'] . ',`' . $item['cartTime'] . '`);">X</button></td>';
                            echo '</tr>';
                            $sum = $sum + $item['price'] * $item['amount'];
                            $isShow = true;
                        }
                    }
                }
                ?>
            </tbody>
            <tfoot>
                <tr>
                    <?php if ($isShow) { ?>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>$<?= $sum; ?></td>
                        <td><button type="button" class="btn btn-primary btn-sm" onclick="return goTransaction();">去買單</button></td>
                    <?php }  ?>
                </tr>
            </tfoot>


        </table>
        <?php echo (!$isShow) ? ("<h5 >購物車沒有任何商品</h5>") : ("");  ?>
    </div>
</body>

</html>
<style scoped>
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
</style>