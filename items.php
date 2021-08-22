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
    //資料庫+資料表連線----------------------------------------------
    header("Content-Type:text/html;charset=utf-8");
    include("connMysql.php");              //連線資料庫、選擇資料庫
    $sql = "SELECT * FROM  `category`";
    $sql2 = "SELECT * FROM `product`";
    $result = mysqli_query($db_link, $sql);
    $result2 = mysqli_query($db_link, $sql2);
    include_once("header.php");
    ?>
    <main>
    <div class="container">
            <?php while ($category = mysqli_fetch_array($result)) { ?>
                <!--類別-->
                <div class="row category">
                    <h3><?= $category['cName']; ?></h3>
                </div>

                <!--商品-->
                <div class="row">
                    <?php
                    $result2->data_seek(0); //將商品的記錄指標移到第一筆
                    while ($item = mysqli_fetch_array($result2)) {
                        //一個商品內容
                        if ($category['cId'] == $item['cId']) {
                    ?>
                            <div class="col-sm-6 col-md-4 col-xl-3 center" style="margin-bottom:3%;">
                                <img src="assets/<?= $item['picture']; ?> "></img>
                                <div class="d-flex justify-content-center " style="margin-top:3%;">
                                    <h6> <?= $item['pName']; ?> </h6>
                                    <h6> $<?= $item['price']; ?> </h6>
                                </div>
                                <p> <?= $item['pIntro']; ?> </p>
                            </div>
                    <?php
                        }
                    }
                    ?>
                </div>
            <?php } ?>
        </div>
    </main>
    <?php include("footer.php"); ?>
</body>

</html>
<style scoped>
    img {
        width: 150px;
    }

    .category {
        padding: 8px 0px;
    }
</style>