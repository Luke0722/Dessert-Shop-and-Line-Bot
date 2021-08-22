<?php @session_start();
header("Content-Type:text/html;charset=utf-8");
include("../connMysql.php"); 

$aId = $_POST['aId'];
$account = $_POST['Account'];
$pw = $_POST['Password'];

//搜尋資料庫資料
$sql = "SELECT * FROM admin WHERE aId = '$aId' AND aAccount = '$account' AND aPassword = '$pw'";
$result = mysqli_query($db_link, $sql);
$row = mysqli_fetch_row($result);


//判斷帳號與密碼是否為空白
//以及MySQL資料庫裡是否有這個會員
if($aId != null && $account != null && $pw != null && $row[0] == $aId && $row[2] == $account && $row[3] == $pw)
{
        //將帳號寫入session，方便驗證使用者身份
        $_SESSION['aId'] = $aId;
        $_SESSION['Account'] = $account;
        $_SESSION['Password'] = $pw;
        $_SESSION['authority'] = $row[4];
        echo '<script type = "text/javascript"> alert("登入成功！")　</script>';
        header("location: index.php");
}
else
{
        echo "<script> alert('登入失敗') </script>";
        echo '<meta http-equiv=REFRESH CONTENT=0;url=login.php>';
}
?>