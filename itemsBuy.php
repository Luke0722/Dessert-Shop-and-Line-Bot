<?php @session_start(); ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>荻瑟特</title>
    <link rel="stylesheet" href="general.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
    <script type="text/javascript">
        var parameter = 0;
        var amount = 0;
        var id = 0;
        var myAlert = document.getElementById('myAlert')

        function handleSub(pNo) {
            var value = parseInt($("#item" + pNo).val(), 10); //取值
            if (value > 1) {
                $("#item" + pNo).val(value - 1); //賦值

            }
        }

        function handlePlus(pNo) {
            var value = parseInt($("#item" + pNo).val(), 10); //取值
            $("#item" + pNo).val(value + 1); //賦值
        }

        function addItems(pNo, mId) {
            parameter = pNo;
            amount = parseInt($("#item" + pNo).val(), 10); //取值
            id = mId;
        }
        $(function() {
            $('.addItems').click(function() {

                $.ajax({
                    type: "POST",
                    url: "itemsBuy_done.php",
                    data: {
                        pNo: parameter,
                        amount: amount,
                        mId: id
                    },
                    async: true, // 異步請求
                    cache: false, // 停止瀏覽器緩存加載
                    success: function(data) {
                        console.log(data);
                        $('#overlay').modal('show');

                        setTimeout(function() {
                            $('#overlay').modal('hide');
                        }, 1000);
                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown) {
                        alert(XMLHttpRequest.status);
                        alert(XMLHttpRequest.readyState);
                        alert(textStatus);
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
                                <button type="button" class="btn btn-secondary btn-sm" onclick="handleSub(<?= $item['pNo']; ?>)" style="width:10%;">-</button>
                                <input type="number" id="item<?= $item['pNo']; ?>" class="form-control" value=1>
                                <button type="button" class="btn btn-secondary btn-sm" onclick="handlePlus(<?= $item['pNo']; ?>)" style="width:10%;">+</button>
                                <button type="button" class="btn btn-primary btn-sm addItems" onclick="addItems(<?= $item['pNo']; ?>,<?= $_SESSION['id']; ?>)" style="width:35%;">加入購物車</button>
                            </div>
                    <?php
                        }
                    }
                    ?>
                </div>
            <?php } ?>
        </div>
        <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
            <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
            </symbol>
        </svg>

        <div class="modal fade" id="overlay">
            <div class="modal-dialog">
                <div class="alert alert-success d-flex align-items-center" role="alert">
                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:">
                        <use xlink:href="#check-circle-fill" />
                    </svg>
                    <div>
                        商品成功加入購物車
                    </div>
                </div>
            </div>
        </div>
    </main>
    <?php include("footer.php"); ?>
</body>

</html>
<style scoped>
    img {
        width:150px;
    }

    .category {
        padding: 8px 0px;
    }

    .form-control {
        display: inline;
        width: 20%;
        font-size: 12px;
    }
</style>