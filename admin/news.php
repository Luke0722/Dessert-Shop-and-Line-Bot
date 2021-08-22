<?php @session_start();
header("Content-Type:text/html;charset=utf-8");
include('update_news.php');

if(!isset($_SESSION['aId']) || !isset($_SESSION['Account']) || !isset($_SESSION['Password'])){
	header("location: login.php");
}

if(isset($_SESSION['msg'])){
    echo '<div class = "msg">';
    echo $_SESSION['msg'];
    unset($_SESSION['msg']);
    echo '</div>';
}

//找到需要被update的資料
if(isset($_GET['edit'])){
    $id = $_GET['edit'];
    $edit_state = true;
    $rec = mysqli_query($db_link, "SELECT * FROM news_content WHERE id = '$id'");
    $record = mysqli_fetch_array($rec);
    $id = $record['id'];
    $category = $record['category'];
    $News = $record['news'];
   
}
else{
    $id = "";
    $category = "";
    $News = ""; 
}
?>

<!DOCTYPE html>
<html lang="en">
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>荻瑟特</title>
    <link type='text/css' rel='stylesheet' href="general.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
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
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="center title">
            <h2 style="text-align: center;">News</h2>
            <hr class="short">
          </div>
        </div>
      </div>
      <div class="row index-content d-flex align-items-center ">
        <div class="col-md-6">
            <?php
                $cate1 = "新品上市";
                $cate2 = "活動訊息";
                $sql = "SELECT * FROM news_content";
                $result = mysqli_query($db_link, $sql);
                while ($row = mysqli_fetch_array($result)){
                    if($row['category'] == $cate1){
                        echo '<label><strong>'.'新品上市'.'</strong></label>';
                        echo '<ul>';
                        echo    '<li>'.$row['news'].'&nbsp;&nbsp;&nbsp;&nbsp;'.'<a href = "news.php?edit='.$row['id'] .'" class="btn btn-success">'.'edit'.'</a>';
                        echo '&nbsp;'.'<a href = "update_news.php?del='.$row['id'] .'" class="btn btn-danger">'.'delete'.'</a>';
                        echo '</li>';
                        echo '</ul>';
                        }
                    elseif($row['category'] == $cate2){
                        echo '<label><strong>'.'活動訊息'.'</strong></label>';
                        echo '<ul>';
                        echo    '<li>'.$row['news'].'&nbsp;&nbsp;&nbsp;&nbsp;'.'<a href = "news.php?edit='.$row['id'] .'" class="btn btn-success">'.'edit'.'</a>';
                        echo '&nbsp;'.'<a href = "update_news.php?del='.$row['id'] .'" class="btn btn-danger">'.'delete'.'</a>';
                        echo '</li>';
                        echo '</ul>';
                        }
                    else{
                        echo '<ul>';
                        echo    '<li>'.$row['news'].'&nbsp;&nbsp;&nbsp;&nbsp;'.'<a href = "news.php?edit='.$row['id'] .'" class="btn btn-success">'.'edit'.'</a>';
                        echo '&nbsp;'.'<a href = "update_news.php?del='.$row['id'] .'" class="btn btn-danger">'.'delete'.'</a>';
                        echo '</li>';
                        echo '</ul>';
                        echo '<script type = "text/javascript"> alert("News分類錯誤！")　</script>';
                    }
                }
              ?>
            </div>
            <div class="col-md-6 align-self-center">    
                <form name = "form" method = "post" action = "update_news.php">
                <input type = "hidden" name = "id" value = "<?php echo $id; ?>"/>
                <div class = "form group">
                    <input type = "text" class="form-control" name ="category"  value = "<?php echo $category; ?>" placeholder = "請輸入「新品上市」or「活動訊息」"/></br>
                </div>
                <div class = "form group">
                    <textarea name = "News" class="form-control" cols = "45" rows = "5" placeholder = "This is the news."><?php echo $News; ?></textarea></br>
                </div>
                <div class = "form group">
                <?php if($edit_state == false){?>
                        <input type = "submit" class="form-control" name ="save" value = "save"/></br><?php } 
                      else{?>
                        <input type = "submit" class="form-control" name ="update" value = "update"/></br>
                    <?php } ?>
                </div>
                </form>
            </div>
        </div>
      </div>
    </div>
</main>
    <?php include_once("footer.php");?>
 
  </body>
</html>
<style scoped>
    body{
        background-color: whitesmoke;
        color: #566787;
        background: #f5f5f5;
        font-family: 'Varela Round', sans-serif;
        }
    .title {
        padding: 2% 0%;
    }

    hr.short {
        width: 100%;
        border-top: 2px solid darkgray;
        display: inline-block;
    }

    .about-us-content {
        height: 400px;
    }
    img{
        width: 100%;
    }
    .msg{
        margin: 30px auto;
        padding: 10px;
        border-radius: 5px;
        color: #3c76cd;
        background: #dff0d8;
        border: 1px solid #3c763d;
        width: 50%;
        text-align: center;
    }
</style>