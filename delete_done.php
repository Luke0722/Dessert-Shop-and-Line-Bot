<?php @session_start();
header("Content-Type:text/html;charset=utf-8");
include("connMysql.php"); 

$id = $_POST['id'];

if($_SESSION['email'] != null)
{
        //刪除資料庫資料語法
        $sql = "DELETE FROM member WHERE mId = '$id'";
        if(mysqli_query($db_link, $sql))
        {
                echo '刪除成功!';
                echo '<meta http-equiv=REFRESH CONTENT=2;url=member.php>';
        }
        else
        {
                echo '刪除失敗!';
               
        }
}
else
{
        echo '您無權限觀看此頁面!';

}
?>