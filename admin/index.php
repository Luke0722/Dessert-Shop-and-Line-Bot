<?php @session_start();
header("Content-Type:text/html;charset=utf-8");
include('../connMysql.php');

if(!isset($_SESSION['aId']) || !isset($_SESSION['Account']) || !isset($_SESSION['Password'])){
	header("location: login.php");
}

$id = 1;
$sql = "SELECT * FROM index_content WHERE ID = '$id'";
$result = mysqli_query($db_link, $sql);
$row = mysqli_fetch_row($result);

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
            <h2 style="text-align: center;">Home</h2>
            <hr class="short">
          </div>
        </div>
      </div>
      <div class="row index-content d-flex align-items-center ">
        <div class="col-md-6">
        <form name = "form" method = "post" enctype="multipart/form-data" action = "update_index.php">
            <img src="../assets/<?php echo $row[4];?>" width = "100px" height = "350px"></img>
            <input type = "file" class = "image_edit" id = "edit_index_image" name = "edit_index_image" value = "<?php echo $row[4];?>"></input>
        </div>
        <div class="col-md-6 align-self-center">     
            <input type = "hidden" name = "id" value = "<?php echo $row[0]; ?>"/>
            <input type = "text" name ="title" value="<?php echo $row[1];?>" placeholder = "This is the title."/></br>
            <textarea name = "content" cols = "45" rows = "5" placeholder = "This is the content."><?php echo $row[2];?> </textarea>
            <input type = "text" name ="slogan" value = "<?php echo $row[3];?>" placeholder = "This is the slogan."/></br>
            <input type = "submit" name ="update" value = "Update"/></br>
      </form>
        </div>
      </div>
    </div>
  </main>
  <?php include("footer.php"); ?>
</body>
</html>
<style scoped>
    .title {
        padding: 2% 0%;
    }

    hr.short {
        width: 100%;
        border-top: 2px solid darkgray;
        display: inline-block;
    }

    .index-content {
        height: 450px;
    }
    img{
        width:100%;
        margin: 10px 0px 15px 10px;  
    }
    .image_edit{
        margin: 0px 0px 5px 10px;   
        height: 40px;   
    }
</style>