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
        <div class="col-md-12">
        <?php

        if(isset($_SESSION['aId']))
        {
                //將$_SESSION['email']丟給$email
                //這樣在下SQL語法時才可以給搜尋的值
                $account = $_SESSION['Account'];
                $pw = $_SESSION['Password'];
                $id = $_SESSION['aId'];

                //尋找資料
                $sql = "SELECT * FROM admin WHERE aId = '$id'";
                $result = mysqli_query($db_link, $sql);
                $row = mysqli_fetch_row($result);

                if($row[4] == "一般管理員"){
                    echo "<form name=\"form\" method=\"post\" action=\"update_myAccount_done.php\">";
                    echo "ID：(此項目無法修改)<input type=\"text\" disabled=\"disabled\" name=\"id\" value=\"$row[0]\" /> <br>";
                    echo "帳號：<input type=\"text\" name=\"account\" value=\"$row[1]\" /><br>";
                    echo "姓名：<input type=\"text\" name=\"name\" value=\"$row[2]\" /><br>";
                    echo "密碼：<input type=\"password\" name=\"Password1\" value=\"$row[3]\" /> <br>";
                    echo "請再次輸入密碼：<input type=\"password\" name=\"Password2\" /> <br>";
                    echo "身分：(此項目無法修改)<input type=\"text\" disabled=\"disabled\" name=\"authority\" value=\"$row[4]\" /><br>";
                    echo "<input type=\"submit\" name=\"button\" value=\"確定\" />";
                    echo "</form>";
                }
                else{
                    echo "<form name=\"form\" method=\"post\" action=\"update_myAccount_done.php\">";
                    echo "<div class='form-group'>";
                    echo "<label>ID：(此項目無法修改)</label>";
                    echo "<input type=\"text\" disabled=\"disabled\" name=\"id\" value=\"$row[0]\" /> <br>";
                    echo "</div>";
                    echo "<div class='form-group'>";
                    echo "<label>帳號：</label>";
                    echo "<input type=\"text\" name=\"account\" value=\"$row[1]\" /><br>";
                    echo "</div>";
                    echo "<div class='form-group'>";
                    echo "<label>姓名：</label>";
                    echo "<input type=\"text\" name=\"name\" value=\"$row[2]\" /><br>";
                    echo "</div>";
                    echo "<div class='form-group'>";
                    echo "<label>密碼：</label>";
                    echo "<input type=\"password\" name=\"Password1\" value=\"$row[3]\" /> <br>";
                    echo "</div>";
                    echo "<div class='form-group'>";
                    echo "<label>請再次輸入密碼：</label>";
                    echo "<input type=\"password\" name=\"Password2\" /> <br>";
                    echo "</div>";
                    echo "<div class='form-group'>";
                    echo "<label>Authority</label>";
                    echo "<select class='form-select' id = 'rName' aria-label='.form-select-sm example' name='rName'>";
                    echo "<option value='一般管理員'>一般管理員</option>";
                    echo "<option selected value='進階管理員'>進階管理員</option>";
                    echo "</select></div>";
                    echo "<input type=\"submit\" name=\"button\" value=\"確定\" style = \"margin: 10px;\" />";
                    echo "</form>";
                }
               
        }
        else
        {
                echo '尚無權限！';
                echo '<meta http-equiv=REFRESH CONTENT=2;url=index.php>';
        }
        ?>
        </div>
      </div>
    </div>
  </main>
  <?php include("footer.php"); ?>
</body>
</html>