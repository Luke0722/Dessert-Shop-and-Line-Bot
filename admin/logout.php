<?php @session_start();
header("Content-Type:text/html;charset=utf-8");

//將session清空
unset($_SESSION['aId'] );
unset($_SESSION['Account'] );
unset($_SESSION['Password']);
unset($_SESSION['authority']);
echo '登出中......';
echo '<meta http-equiv=REFRESH CONTENT=1;url=../index.php>';
?>  