<?php
  @session_start();
  header("Content-Type:text/html;charset=utf-8");
  include('connMysql.php');

  $id = 1;
  $sql = "SELECT * FROM index_content WHERE ID = '$id'";
  $result = mysqli_query($db_link, $sql);

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>荻瑟特</title>
  <link type='text/css' rel='stylesheet' href="general.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
</head>

<body>
  <?php include_once('header.php'); ?>
  <main>
  <?php include_once('banner.php'); ?>
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="center title">
            <h2>荻瑟特</h2>
            <hr class="short">
          </div>
        </div>
      </div>
      <div class="row about-us-content d-flex align-items-center ">
        <div class="col-md-6">
          <div>
          <?php while ($row = mysqli_fetch_array($result)) { ?>
            <img src="assets/<?php echo $row['image']; ?>">
          </div>
        </div>
        <div class="col-md-6">
          <div style = "margin: 50px">
            <h2 class = "title"><?php echo $row['title']; ?></h2><br>
            <h5 class = "pre-text"><?php echo $row['content']; ?></h5><br>
            <h4><?php echo $row['slogan']; ?></h4><br>
          <?php } ?>
          </div>
        </div>
      </div>
    </div>
  </main>
  <?php include("footer.php"); ?>
</body>
`

</html>
<style scoped>
    .title {
        padding: 2% 0%;
    }

    .pre-text { 
            white-space: pre-wrap;
    }

    hr.short {
        width: 100%;
        border-top: 2px solid darkgray;
    }

    .about-us-content {
        height: 400px;
    }
    img{
        margin: 0px 0px 0px 10px;
        width:100%;
    }
</style>