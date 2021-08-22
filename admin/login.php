<?php
//載入 db.php 檔案，讓我們可以透過它連接資料庫，因為此檔案放在 admin 裡，要找到 db.php 就要回上一層 ../php 裡面才能找到
include('../connMysql.php');

//還沒想好要怎麼要進入admin login 頁面
// if( )
// {
//   //直接轉跳到 index.php 後端首頁
//   header("Location: index.php");
// }
?>
<!Doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Backend</title>
    <link rel="stylesheet" href="general.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
</head>

<body>
    <main>
        <div class="container  overflow-hidden " style=" height:500px; ">
            <div class="row  gx-5 " style=" height:100%; ">
          	  <h1 class="text-center" style="padding-top:70px ; border-bottom:1px solid black; ">Backend Log In</h1>
                <div class="col-sm align-self-center " style=" border-right:1px ; ">
                    <h3 style="padding-bottom:20px"> Log In</h3>
                    <!-- 傳送至DB -->
                    <form name="form" method="post" action="connect.php">
                        <div class="form-group">
                            <label>Admin ID</label>
                            <input type="text" class="form-control" placeholder="Enter Your ID" id="aId" name="aId">
                        </div>
                        <div class="form-group">
                            <label>Account</label>
                            <input type="text" class="form-control" placeholder="Enter Your Account" id="Account" name="Account">
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" class="form-control" placeholder="Enter Your Password" id="Password" name="Password">
                        </div>
                        <button type="submit" class="btn btn-primary">Login</button> &nbsp;&nbsp;
                    </form>
                </div>
            </div>
        </div>
    </main>

</body>

</html>