<?php @session_start();
header("Content-Type:text/html;charset=utf-8");
include("connMysql.php"); 

if($_SESSION['id'] != null)
{
        echo "<form name=\"form\" method=\"post\" action=\"delete_done.php\">";
        echo "要刪除的會員 ID：<input type=\"text\" name=\"id\" /> <br>";
        echo "<input type=\"submit\" name=\"button\" value=\"刪除\" />";
        echo "</form>";
}
else
{
        echo '您無權限觀看此頁面!';
}
?>