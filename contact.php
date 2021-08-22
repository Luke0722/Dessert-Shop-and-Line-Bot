<?php
  @session_start();
  header("Content-Type:text/html;charset=utf-8");
  include('connMysql.php');
  
  $id = 1;
  $sql = "SELECT * FROM contact_content WHERE id = '$id'";
  $result = mysqli_query($db_link, $sql);
?>
<!Doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>荻瑟特</title>
    <link rel="stylesheet" href="general.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
</head>

<body>
    <?php include_once("header.php"); ?>
    <main>
        <div class="container d-flex align-items-center " style=" height:700px; border-bottom:1px solid black;">
            <div class="col-lg-6">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3682.706117805268!2d120.26308531409612!3d22.627446985154567!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x346e0408e7591e3f%3A0x439730cbe265ebf9!2z5ZyL56uL5Lit5bGx5aSn5a24566h55CG5a246Zmi!5e0!3m2!1szh-TW!2stw!4v1620663396124!5m2!1szh-TW!2stw" width="450" height="450" style="border:3px #004B97	 solid;" allowfullscreen="true" loading="lazy"></iframe>
            </div>
            <div class="col-lg-6">
            <?php while ($row = mysqli_fetch_array($result)) { ?>
                <h5 style="margin-top:10px;"><strong> <?php echo $row['store']; ?></strong></h5>
                <hr class="short">
                <p><strong> 電話&ensp; |&emsp;</strong><?php echo $row['tel']; ?> </p>
                <p><strong> 傳真&ensp; |&emsp;</strong><?php echo $row['fax']; ?> </p>
                <p><strong> 地址&ensp; |&emsp;</strong><?php echo $row['location']; ?> </p>
                <p><strong> 營運時間&ensp;|&emsp;</strong><?php echo $row['openingHour']; ?> </p>
                <?php } ?>
            </div>
        </div>
    </main>
    <?php include_once("footer.php"); ?>
</body>

</html>
<style scoped>
    hr.short {
        width: 5%;
        border-top: 2px solid darkgray;
        display: inline-block;
    }
</style>