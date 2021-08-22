<?php @session_start();
header("Content-Type:text/html;charset=utf-8");
include('../connMysql.php');

if(!isset($_SESSION['aId']) || !isset($_SESSION['Account']) || !isset($_SESSION['Password'])){
	header("location: login.php");
}

?>
<!Doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>荻瑟特</title>
    <link rel="stylesheet" href="general.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
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
            <?php
              $id = 1;
              $sql = "SELECT * FROM contact_content WHERE id = '$id'";
              $result = mysqli_query($db_link, $sql);
              $row = mysqli_fetch_array($result);
            ?>
              <form name = "form" method = "post" action = "update_contact.php">
                <input type = "hidden" name = "id" value = "<?php echo $row['id']; ?>"/>
                <div class="form-group">
                    <label><strong>商店名稱</strong></label>
                    <input type = "text" class="form-control" name ="store" value="<?php echo $row['store']; ?>" placeholder = "Store Name."/></br>
                </div>
                <div class="form-group">
                    <label><strong>電話</strong></label>
                    <input type = "text" class="form-control" name ="tel" value="<?php echo $row['tel']; ?>" placeholder = "Store tel."/></br>
                </div>
                <div class="form-group">
                <label><strong>傳真</strong></label>
                    <input type = "text" class="form-control" name ="fax" value="<?php echo $row['fax']; ?>" placeholder = "Store fax."/></br>
                </div>
                <div class="form-group">
                    <label><strong>地址</strong></label>
                    <input type = "text" class="form-control" name ="location" value="<?php echo $row['location']; ?>" placeholder = "Store location."/></br>
                </div>
                <div class="form-group">
                    <label><strong>營業時間</strong></label>
                    <input type = "text" class="form-control" name ="openingHour" value="<?php echo $row['openingHour']; ?>" placeholder = "Store openingHour."/></br>
                </div>
                <div class="form-group">
                    <input type = "submit" class="form-control" name ="update" value = "Update"/></br>
                </div>
              </form>
            </div>
        </div>
    </main>
    <?php include_once("footer.php"); ?>
</body>

</html>
<style scoped>
    body{
        background-color: whitesmoke;
        color: #566787;
        background: #f5f5f5;
        font-family: 'Varela Round', sans-serif;
        }
    hr.short {
        width: 5%;
        border-top: 2px solid darkgray;
        display: inline-block;
    }
</style>