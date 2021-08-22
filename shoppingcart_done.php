<?php
@session_start();
include("connMysql.php");                       //連線資料庫、選擇資料庫    
$pNo = $_POST['pNo'];
$amount = $_POST['amount'];
$mId = $_POST['mId'];
$cartTime = $_POST['cartTime'];
$action = $_POST['action'];
if ($action == "sub") {
        $sql_sub = "UPDATE `order`
                SET `amount`= $amount-1
                WHERE `mId` = '$mId' AND `cartTime`='$cartTime' AND `pNo`= '$pNo'";
        mysqli_query($db_link, $sql_sub);

        echo $amount - 1;
}
else if($action == "plus"){
        $sql_sub = "UPDATE `order`
        SET `amount`= $amount+1
        WHERE `mId` = '$mId' AND `cartTime`='$cartTime' AND `pNo`= '$pNo'";
        mysqli_query($db_link, $sql_sub);

        echo $amount + 1;
}
else if($action == "delete"){
        $sql_sub = "DELETE FROM `order`
        WHERE `mId` = '$mId' AND `cartTime`='$cartTime' AND `pNo`= '$pNo'";
        mysqli_query($db_link, $sql_sub);
}

?>
