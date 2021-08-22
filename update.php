<?php @session_start();
header("Content-Type:text/html;charset=utf-8");
include("connMysql.php"); 

if(isset($_SESSION['id']))
{
        //將$_SESSION['email']丟給$email
        //這樣在下SQL語法時才可以給搜尋的值
        $email = $_SESSION['email'];
        $pw = $_SESSION['Password1'];
        $id = $_SESSION['id'];

        //尋找資料
        $sql = "SELECT * FROM member WHERE mId = '$id'";
        $result = mysqli_query($db_link, $sql);
        $row = mysqli_fetch_row($result);
    
        echo "<form name=\"form\" method=\"post\" action=\"update_done.php\">";
        echo "會員ID：<input type=\"text\" disabled=\"disabled\" name=\"id\" value=\"$row[0]\" /> (此項目無法修改) <br>";
        echo "姓名：<input type=\"text\" name=\"name\" value=\"$row[1]\" /><br>";
        echo "email：<input type=\"text\" name=\"email\" value=\"$row[2]\" /><br>";
        echo "登入密碼：<input type=\"password\" name=\"Password1\" value=\"$row[6]\" /> <br>";
        echo "再一次輸入登入密碼：<input type=\"password\" name=\"Password2\" value=\"$row[6]\" /> <br>";
        echo "手機號碼：<input type=\"text\" name=\"phone\" value=\"$row[3]\" /> <br>";
        echo "地址：<input type=\"text\" name=\"address\" value=\"$row[4]\" /> <br>";
        echo "銀行帳號：<input type=\"text\" name=\"account\" value=\"$row[5]\" /> <br>";
        echo "會員等級：$row[7] (此項目無法修改) <br>";
        echo "<input type=\"submit\" name=\"button\" value=\"確定\" />";
        echo "</form>";
}
else
{
        echo '尚無權限！';
        echo '<meta http-equiv=REFRESH CONTENT=2;url=index.php>';
}
?>