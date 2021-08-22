<?php @session_start();
header("Content-Type:text/html;charset=utf-8");
include("connMysql.php"); 

$email = $_POST['email'];
$pw = $_POST['Password1'];

//搜尋資料庫資料
$sql = "SELECT * FROM member WHERE email = '$email' AND password = '$pw'";
$result = mysqli_query($db_link, $sql);
$row = mysqli_fetch_row($result);


//判斷帳號與密碼是否為空白
//以及MySQL資料庫裡是否有這個會員
if($email != null && $pw != null && $row[2] == $email && $row[6] == $pw)
{
        //將帳號寫入session，方便驗證使用者身份
        $_SESSION['email'] = $email;
        $_SESSION['Password1'] = $pw;
        $_SESSION['id'] = $row[0];
        echo "<script> alert('登入成功') ; parent.location.href = 'index.php ' ; </script>";
}
else
{
        echo "<script> alert('登入失敗') </script>";
        echo '<meta http-equiv=REFRESH CONTENT=0;url=login.php>';
}
?>