<?php
include("connMysql.php");                        
$pNo = $_POST['pNo'];
$amount = $_POST['amount'];
$mId = $_POST['mId'];
$exist = false;

$sql = "SELECT order.pNo AS pNo ,amount,cart.cartTime AS cartTime
        FROM  `cart`
        LEFT JOIN `order` on cart.mId = order.mId AND cart.cartTime = order.cartTime
        WHERE cart.cartTime IN(
            SELECT t.cartTime FROM  (
                SELECT * FROM cart WHERE cart.mId= '$mId '
                ORDER BY cartTime 
                DESC 
                LIMIT 1)
            as t)";
$result = mysqli_query($db_link, $sql);
$cartTime = mysqli_fetch_array($result)['cartTime'];
$result->data_seek(0); //將記錄指標移到第一筆
//檢查商品是否已在購物車中
while ($item = mysqli_fetch_array($result)) {
    if ($item['pNo'] === $pNo) {
        $amount = $amount + $item['amount'];
        $exist = true;
        break;
    }
}
//若商品已存在購物車中，則更新購買數量
if ($exist === true) {
    $sql_update = "UPDATE `order`
                    SET `amount`= $amount
                    WHERE `mId` = '$mId' AND `cartTime`='$cartTime' AND `pNo`= '$pNo'";
    mysqli_query($db_link, $sql_update);

} 
//若商品不在購物車中，則新增該商品及購買數量至order資料表
else {
    $sql_insert = "INSERT INTO `order` (`mId`,`pNo`,`amount`,`cartTime`) 
                   VALUES ('$mId','$pNo','$amount','$cartTime')";
    mysqli_query($db_link, $sql_insert);

}
