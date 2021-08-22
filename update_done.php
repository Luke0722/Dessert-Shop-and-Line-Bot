<?php @session_start();
header("Content-Type:text/html;charset=utf-8");
include("connMysql.php"); 

$name = $_POST['name'];
$phone = $_POST['phone'];
$address = $_POST['address'];
$email = $_POST['email'];
$pw = $_POST['Password1'];
$pw2 = $_POST['Password2'];
$account = $_POST['account'];

//紅色字體為判斷密碼是否填寫正確
if(isset($_SESSION['id']) && $name != null && $phone != null && $address != null && $email != null && $account != null && $pw != null && $pw2 != null && $pw == $pw2)
{
    $id = $_SESSION['id'];
    //更新資料庫資料語法
    $sql = "UPDATE member SET password = '$pw', phone = '$phone', address = '$address', name = '$name',  account = '$account', email = '$email' WHERE mId = '$id'";
    if(mysqli_query($db_link, $sql))
    {
            echo '修改成功!';
            header("Location: index.php");
    }
    else
    {
            echo '修改失敗!';
            echo '<meta http-equiv=REFRESH CONTENT=2;url=member.php>';
    }
}
else
{
        echo '尚無權限！';
        echo '<meta http-equiv=REFRESH CONTENT=2;url=index.php>';
}
?>