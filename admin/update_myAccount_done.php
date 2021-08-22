<?php @session_start();
header("Content-Type:text/html;charset=utf-8");
include("../connMysql.php"); 

$name = $_POST['name'];
$account = $_POST['account'];
$pw = $_POST['Password1'];
$pw2 = $_POST['Password2'];
$authority = $_POST['rName'];

//紅色字體為判斷密碼是否填寫正確
if(isset($_SESSION['aId']) && $name != null && $account != null && $pw != null && $pw2 != null && $authority != null && $pw == $pw2)
{
    $id = $_SESSION['aId'];
    //更新資料庫資料語法
    $sql = "UPDATE admin SET aPassword = '$pw', aName = '$name',  aAccount = '$account', rName = '$authority' WHERE aId = '$id'";
    if(mysqli_query($db_link, $sql))
    {
            echo '<script type = "text/javascript"> alert("修改成功！")　</script>';
            //將寫入session，方便驗證身份
            $_SESSION['authority'] = $authority;
            header("Location: myAccount.php");
    }
    else
    {
            echo '<script type = "text/javascript"> alert("修改失敗！")　</script>';
            echo '<meta http-equiv=REFRESH CONTENT=2;url=myAccount.php>';
    }
}
else
{
        echo '尚無權限！';
        echo '<meta http-equiv=REFRESH CONTENT=2;url=index.php>';
}
?>