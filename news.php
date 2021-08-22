<?php
  @session_start();
  header("Content-Type:text/html;charset=utf-8");
  include('connMysql.php');
?>
<!DOCTYPE html>
<html lang="en">
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>荻瑟特</title>
    <link type='text/css' rel='stylesheet' href="general.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"
        integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js"
        integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous">
    </script>
 <body>
 <?php include_once('header.php');?>
 <main>
        <div class="container">
            <div class="row d-flex justify-content-center ">
              <div class="col-md-12 news d-flex align-items-center justify-content-center ">
                <h4>活動訊息</h4>
              </div>
            </div> 
            <?php 
              $cate2 = "活動訊息";
              $sql2 = "SELECT * FROM news_content WHERE category = '$cate2'";
              $result2 = mysqli_query($db_link, $sql2);
              while ($row2 = mysqli_fetch_array($result2)){
                echo '<div class="row news d-flex justify-content-center ">';
                echo '<div class="col-md-6 news-content d-flex align-items-center justify-content-center ">';
                echo    '<p class="w3-text-red">'.$row2['news'].'</p><br>';
                echo '</div>';
                echo '</div>';
                }
              ?>
        </div>
        <div class="container">
            <div class="row d-flex justify-content-center ">
              <div class="col-md-12  d-flex align-items-center justify-content-center ">
                  <h4>新品上市</h4>
              </div>
            </div>
            <?php
              $cate1 = "新品上市";
              $sql1 = "SELECT * FROM news_content WHERE category = '$cate1'";
              $result1 = mysqli_query($db_link, $sql1);
              while ($row1 = mysqli_fetch_array($result1)){
                echo '<div class="row news d-flex justify-content-center ">';
                echo '<a href = "itemsBuy.php" class="col-md-6 news-content d-flex align-items-center justify-content-center btn btn-link">';
                echo    '<p>'.$row1['news'].'</p><br>';
                echo '</a>';
                echo '</div>';
              }
            ?>
        </div>
    </main>
    <?php include_once("footer.php");?>
 
  </body>
</html>
<style scoped>
.news-content{
  padding:2% 1%;
  background:lightgray;
  }
.news{
  margin:3% 0%;
}
</style>