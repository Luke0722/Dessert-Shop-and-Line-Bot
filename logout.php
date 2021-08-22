<?php @session_start();
header("Content-Type:text/html;charset=utf-8");

//將session清空
unset($_SESSION['email'] );
unset($_SESSION['Password1'] );
unset($_SESSION['id']);
echo '登出中......';
echo '<meta http-equiv=REFRESH CONTENT=1;url=index.php>';
?>  