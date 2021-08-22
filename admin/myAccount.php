<?php @session_start();

header("Content-Type:text/html;charset=utf-8");
include("../connMysql.php"); 

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>荻瑟特 BE</title>
  <link type='text/css' rel='stylesheet' href="general.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>

  <style>
    body{
      background-color: whitesmoke;
      color: #566787;
      background: #f5f5f5;
      font-family: 'Varela Round', sans-serif;
    }
    input{
      width: 100%;
      height: 5%;
      border: 1px;
      border-radius: 05px;
      padding: 5px 15px 8px 15px;
      margin: 5px 0px 5px 10px;
      box-shadow: 1px 1px 2px 1px grey;
    }
    textarea{
      width: 100%;
      height: 5%;
      border: 1px;
      border-radius: 05px;
      padding: 8px 15px 8px 15px;
      margin: 5px 0px 0px 10px;
      box-shadow: 1px 1px 2px 1px grey;
    }
  </style>
</head>

<body>
  <?php include_once('header.php'); ?>
  <main>
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="center title">
            <h2 style="text-align: center; margin: 15px;">My Account</h2>
            <hr class="short">
          </div>
        </div>
      </div>
      <div class="row index-content d-flex align-items-center ">
        <div class="col-md-12" style="text-align: center;">
        <?php
        //此判斷為判定觀看此頁有沒有權限
        //說不定是路人或不相關的使用者
        //因此要給予排除
                if(isset($_SESSION['aId']))
                {

                        $id = $_SESSION['aId'];
                
                        //將資料庫裡的所有會員資料顯示在畫面上
                        $sql = "SELECT * FROM admin WHERE aId = '$id'";
                        $result = mysqli_query($db_link, $sql);
                        while($row = mysqli_fetch_row($result))
                        {
                                echo "Admin ID：$row[0]<br>"."姓名：$row[1] <br>". "帳號：$row[2] <br> "."密碼：$row[3] <br>"."身分：$row[4] <br>";
                        }
                                               
                        echo '<a href="update_myAccount.php"><i class="material-icons" style = " color: #46A3FF; margin: 10px;">create</i></a>';
                        echo '<a href="logout.php"><i class="material-icons" style = " color: #46A3FF; margin: 10px;">logout</i></a>';
                }
                else
                {
                        echo '您無權限觀看此頁面!';
                }
        ?>
        </div>
      </div>
    </div>
  </main>
  <?php include("footer.php"); ?>
</body>
</html>