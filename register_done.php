<?php @session_start();
header("Content-Type:text/html;charset=utf-8");
include("connMysql.php"); 

$name = $_POST['name'];
$phone = $_POST['phone'];
$address = $_POST['address'];
$email = $_POST['email'];
$pw = $_POST['Password1'];
$pw2 = $_POST['Password2'];
$account = $_POST['account'];

//判斷帳號密碼是否為空值
//確認密碼輸入的正確性
if($name != null && $phone != null && $address != null && $email != null && $account != null && $pw != null && $pw2 != null && $pw == $pw2)
{
    //check email
    if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/", $_POST["email"])) 
    { echo "<script> alert('錯誤的Email格式'); parent.location.href = 'register.php ' ;</script>";}
    
    else{
        //新增資料進資料庫語法
        $sql = "INSERT INTO member (name, email, phone, address, account, password, totalAmount) 
        VALUES ('$name', '$email', '$phone', '$address', '$account', '$pw', 0)";

        if(mysqli_query($db_link, $sql))
        {
            //搜尋資料庫資料
            $find = "SELECT * FROM member WHERE email = '$email' AND password = '$pw'";
            $result = mysqli_query($db_link, $find);
            $row = mysqli_fetch_row($result);

            $_SESSION['email'] = $email;
            $_SESSION['Password1'] = $pw;
            $_SESSION['id'] = $row[0];

            $newcart = "INSERT INTO `cart` (mId) VALUES (".$_SESSION['id'] .")";
            mysqli_query($db_link,$newcart);
            echo "<script> alert('註冊成功'); parent.location.href = 'index.php ';</script>";
        }
        else
        {
            echo "Error: " . $sql . "" . mysqli_error($db_link);
        }
    }
    mysqli_close($db_link);
}
else if($pw != $pw2){
    echo "<script> alert('兩次密碼不相符'); parent.location.href = 'register.php ' ;</script>";
}
else{
    echo '請檢查填寫資料';
    echo '<meta http-equiv=REFRESH CONTENT=2;url=index.php>';
}
?>