<?php

date_default_timezone_set("Asia/Taipei"); //設定時區為台北時區

require_once('LINEBotTiny.php');

$channelAccessToken = '';
$channelSecret = '';
if (file_exists(__DIR__ . '/config.ini')) {
    $config = parse_ini_file("config.ini", true); //解析配置檔
    if ($config['Channel']['Token'] == null || $config['Channel']['Secret'] == null) {
        error_log("config.ini 配置檔未設定完全！", 0); //輸出錯誤
    } else {
        $channelAccessToken = $config['Channel']['Token'];
        $channelSecret = $config['Channel']['Secret'];
    }
} else {
    $configFile = fopen("config.ini", "w") or die("Unable to open file!");
    $configFileContent = '; Copyright 2020 GoneTone;';
    fwrite($configFile, $configFileContent); //建立文件並寫入
    fclose($configFile); //關閉文件
    error_log("config.ini 配置檔建立成功，請編輯檔案填入資料！", 0); //輸出錯誤
}

$message = null;
$event = null;
$return = null;
$mId = null;

echo '123';
include("../connMysql.php");
$sql_product = "SELECT * FROM `product`";

// 顯示商品目錄
$menu_items = "〈商品目錄〉\n";
$product = mysqli_query($db_link, $sql_product);
while ($item = mysqli_fetch_array($product)) {
    $menu_items = $menu_items . $item['pNo'] . $item['pName'] . "  $" . $item['price'] . "\n";
}
$menu_items = $menu_items . "\n請輸入數字 選擇商品\n輸入「離開」退出預訂\n輸入「結帳」立即結帳";

// 顯示功能目錄
$menu_function = "〈請輸入數字選擇功能〉1. 商品預訂自取  2. 查詢店家資訊";

// 查詢訂購的商品
function orderItems($db_link, $mId)
{
    $sql_order =  "SELECT * FROM `line_order` NATURAL JOIN `product` WHERE `mId`='$mId'";
    $order = mysqli_query($db_link, $sql_order);
    $order_item = "編號 \r 名稱\r\r\r\r\r\r\r\r\r\r\r\r\r\r\r\r\r\r數量 \r\r\r\r 小計\n";
    while ($item = mysqli_fetch_array($order)) {
        $order_item = $order_item . $item['pNo'] . " \r\r\r\r\r\r " . $item['pName'] . "\r\r\r\r\r\r" . $item['amount'] . "\r\r\r\r\r  $" . $item['price'] * $item['amount'] . "\n";
    }
    return $order_item;
}

// 更新帳號狀態
function setStatus($mId, $status)
{
    $sql_status =  "UPDATE `line` SET `status` = '" . $status . "' WHERE `mId`='" . $mId . "' ";
    return $sql_status;
}

$client = new LINEBotTiny($channelAccessToken, $channelSecret);
foreach ($client->parseEvents() as $event) {
    switch ($event['type']) {
        case 'message': //訊息觸發
            $message = $event['message'];
            $userMessage = $message['text']; //使用者訊息
            $userId = $event['source']['userId']; //使用者id
            switch ($message['type']) {
                case 'text': //訊息為文字
                    //先看是否有在裡面
                    $sql_lineId = "SELECT * FROM `line` WHERE lineId='" . $userId . "'";
                    $query_lineId = mysqli_query($db_link, $sql_lineId);
                    //沒有line帳號資料
                    if (mysqli_num_rows($query_lineId) == 0) {
                        //查詢輸入的是否為email
                        $sql_email = "SELECT * FROM `member` WHERE email='" . $userMessage . "'";
                        $query_email = mysqli_query($db_link, $sql_email);
                        //輸入錯誤
                        if (mysqli_num_rows($query_email) == 0) {
                            $return = "帳號未註冊或是email格式錯誤，請重新輸入";
                            break;
                        }
                        //輸入正確，新增資料，等待密碼
                        else {
                            $return = "請輸入密碼";

                            $mId = mysqli_fetch_array($query_email)['mId'];
                            $sql_status_check = "INSERT INTO `line`(`lineId`,`mId`,`status`) VALUES('$userId','$mId','check')";
                            mysqli_query($db_link, $sql_status_check);
                            break;
                        }
                    }
                    //已經有資料了
                    else {
                        $result = mysqli_fetch_array($query_lineId);
                        $mId = $result['mId'];
                        //正在登入[密碼]
                        if ($result['status'] == "check") {
                            $sql_pw = "SELECT * FROM `member` 
                                            NATURAL JOIN `line`
                                            WHERE member.password='" . $userMessage . "'";
                            $query_pw = mysqli_query($db_link, $sql_pw);
                            //密碼錯誤
                            if (mysqli_num_rows($query_pw) == 0) {
                                $return = "密碼錯誤，請重新輸入email帳號";
                            }
                            //密碼正確
                            else {
                                $return = "登入成功 \n" . $menu_function;
                                $mId = mysqli_fetch_array($query_pw)['mId'];
                                mysqli_query($db_link,  setStatus($mId, 'login'));
                            }
                            break;
                        }
                        //[登入後]
                        if ($result['status'] == "login") {
                            switch ($userMessage) {
                                case 1:
                                    mysqli_query($db_link,  setStatus($mId, 'shopping'));
                                    $return = $menu_items;
                                    break;
                                case 2:
                                    $return = "〈荻瑟特手工甜點〉\n電話：07 - 0000000\n地址：804高雄市鼓山區蓮海路70號\n營運時間：周一〜周日 11:00~22:00\n\n請選擇功能 1. 商品預訂自取  2. 查詢店家資訊";
                                    break;
                                default:
                                    $return = "無效的選項，請重新輸入";
                                    break;
                            }
                        }
                        //[訂購商品]
                        if ($result['status'] == "shopping") {
                            switch ($userMessage) {
                                case in_array($userMessage, range(1, 7)):
                                    $sql_buy =  "UPDATE `line`
                                                SET `pNo`='$userMessage' 
                                                WHERE `mId`='" . $mId . "'";
                                    mysqli_query($db_link,  $sql_buy);
                                    mysqli_query($db_link,  setStatus($mId, 'amount'));
                                    $return = "請輸入數量\n輸入「刪除」刪除預訂\n輸入「離開」取消預訂";
                                    break;

                                case "離開":
                                    mysqli_query($db_link,  setStatus($mId, 'login'));
                                    $return = $menu_function;
                                    break;
                                case "結帳":
                                    $sql_member = "SELECT * FROM `member` WHERE `mId`='$mId'";
                                    $member =  mysqli_fetch_array(mysqli_query($db_link,  $sql_member));

                                    $return = "訂購人：" . $member['name'] . "\n電話：" . $member['phone'] . "\n預訂商品：\n" . orderItems($db_link, $mId) . "\n輸入「確定」完成訂單\n輸入「離開」繼續預訂";
                                    mysqli_query($db_link,  setStatus($mId, 'transaction'));
                                    break;
                                default:
                                    $return = "無效的選項2，請重新輸入";
                                    break;
                            }
                        }
                        //[訂購數量]
                        if ($result['status'] == "amount") {
                            switch ($userMessage) {
                                case in_array($userMessage, range(1, 101)):
                                    //搜尋選擇商品
                                    $sql_pNo =  "SELECT pNo FROM `line` WHERE `mId`='$mId' ";
                                    $pNo = mysqli_fetch_array(mysqli_query($db_link,  $sql_pNo))['pNo'];
                                    $sql_order_select = "SELECT * FROM `line_order`  WHERE `mId`='$mId' AND `pNo`='$pNo '";
                                    //新增訂單
                                    if (mysqli_num_rows(mysqli_query($db_link,  $sql_order_select)) == 0)
                                        $sql_order =  "INSERT INTO `line_order`(`mId`,`pNo`,`amount`) VALUES('$mId','$pNo','$userMessage')";
                                    //更新訂單
                                    else
                                        $sql_order =  "UPDATE `line_order` SET `amount`= `amount`+'$userMessage' WHERE `mId`='$mId' AND `pNo`='$pNo '";
                                    mysqli_query($db_link,  $sql_order);
                                    mysqli_query($db_link,  setStatus($mId, 'shopping'));
                                    //顯示訂購商品
                                    $return = "〈已預訂商品〉\n" . orderItems($db_link, $mId) . "\n請輸入數字 繼續選購\n輸入「離開」退出預訂\n輸入「結帳」立即結帳";
                                    break;

                                case "刪除":
                                    $sql_pNo =  "SELECT * FROM `line_order` WHERE `pNo` IN ( SELECT `pNo` FROM `line` WHERE `mId`='$mId') ";
                                    //沒有資料
                                    if (mysqli_num_rows(mysqli_query($db_link,  $sql_pNo)) == 0) {
                                        $return = "您未預訂該商品，請重新選擇商品";
                                    } else {
                                        $sql_delete =  "DELETE  FROM `line_order` WHERE `pNo` IN ( SELECT `pNo` FROM `line` WHERE `mId`='$mId') ";
                                        mysqli_query($db_link, $sql_delete);
                                        $return = "已刪除該商品預訂\n" . $menu_items;
                                    }
                                    mysqli_query($db_link,  setStatus($mId, 'shopping'));
                                    break;
                                case "離開":
                                    mysqli_query($db_link,  setStatus($mId, 'shopping'));
                                    $return = $menu_items;
                                    break;

                                default:
                                    $return = "無效的選項，請重新輸入";
                                    break;
                            }
                        }
                        //[確認交易]
                        if ($result['status'] == "transaction") {
                            if ($userMessage == "確定") {
                                $sql_member = "SELECT * FROM `member` WHERE `mId`='$mId'";
                                $bankAccount =  mysqli_fetch_array(mysqli_query($db_link,  $sql_member))['account'];
                                $sql_total = "SELECT SUM(price * amount) AS total 
                                            FROM `line_order` 
                                            NATURAL JOIN `product`
                                            WHERE `mId`='$mId' 
                                            GROUP BY `mId`";
                                $total = mysqli_fetch_array(mysqli_query($db_link,  $sql_total))['total'];
                                $sql_transaction = "INSERT INTO `transaction` (`transMid`,`method`,`bankAccount`,`total`) 
                                                    VALUES ('$mId','現金(來店取貨)','$bankAccount','$total')";
                                mysqli_query($db_link, $sql_transaction);
                                $sql_tNo = "SELECT LAST_INSERT_ID() ";
                                $tNo = mysqli_fetch_array(mysqli_query($db_link,  $sql_tNo))[0];
                                $sql_order =  "SELECT * FROM `line_order` NATURAL JOIN `product` WHERE `mId`='$mId'";
                                $order = mysqli_query($db_link, $sql_order);

                                while ($item = mysqli_fetch_array($order)) {
                                    $pNo = $item['pNo'];
                                    $amount = $item['amount'];
                                    $salesPrice = $item['price'];
                                    $sql5 = "INSERT INTO `record` (`tNo`,`pNo`,`amount`,`salesPrice`) 
                                        VALUES ('$tNo','$pNo','$amount','$salesPrice')";
                                    mysqli_query($db_link, $sql5);
                                }
                                mysqli_query($db_link,  setStatus($mId, 'login'));
                                $sql_order_delete =  "DELETE  FROM `line_order` WHERE `mId`='$mId'";
                                mysqli_query($db_link, $sql_order_delete);
                                $return = "訂購完成\n請於明日營業時間內到店取貨\n" . $menu_function;
                            } else if ($userMessage == "離開") {
                                mysqli_query($db_link,  setStatus($mId, 'shopping'));
                                $return = $menu_items;
                            } else {
                                $return = "無效的選項，請重新輸入";
                            }
                        }
                    }
                    break;
                default:
                    //error_log("Unsupporeted message type: " . $message['type']);
                    break;
            }
            break;
        case 'postback': //postback 觸發
            //require_once('postback.php'); //postback
            break;
        case 'follow': //加為好友觸發
            $return = "您好，歡迎加入荻瑟特客服\n請先登入會員 \n \n 請輸入Email帳號";
            break;
        case 'join': //加入群組觸發
            $return = "您好，請先登入會員 \n \n 請輸入Email帳號";
            break;
        default:
            //error_log("Unsupporeted event type: " . $event['type']);
            break;
    }

    $client->replyMessage(array(
        'replyToken' => $event['replyToken'],
        'messages' => array(
            array(
                'type' => 'text', //訊息類型 (文字)
                'text' => $return //回覆訊息
            )
        )
    ));
}
