<?php  @session_start();
header("Content-Type:text/html;charset=utf-8");
include('../connMysql.php');
$success = "";

    //初始化
    $id = 0;
    $name = "";
    $email = "";
    $phone = "";
    $address = "";
    $account = "";
    $totalAmount = "";

    //新增資料
    if(isset($_POST['add']))
    {  
        $name  = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];
        $account = $_POST['account'];
        $password = $_POST['password'];
        $totalAmount = $_POST['totalAmount'];

        $sql = "INSERT INTO member (name, email, phone, address, account, password, totalAmount) 
        VALUES ('$name', '$email', '$phone', '$address', '$account', '$password', '$totalAmount')";
        if (mysqli_query($db_link, $sql))
        {
            echo '<script type = "text/javascript"> alert("新增成功！")　</script>';
            echo '<meta http-equiv=REFRESH CONTENT=0;url=member.php>';
        }
        else{
            echo "Error: " . $sql . " " . mysqli_error($db_link);
            echo '<script type = "text/javascript"> alert("新增失敗！")　</script>';
            echo '<meta http-equiv=REFRESH CONTENT=0;url=member.php>';
        }
        mysqli_close($db_link);
    }

    //update
    if(isset($_POST['id'])){
        $id = $_POST['id'];
        $name  = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];
        $account = $_POST['account'];;
        $totalAmount = $_POST['totalAmount'];

        //修改資料
        $sql = "UPDATE member SET name = '$name', email = '$email', phone = '$phone', address = '$address', account = '$account', totalAmount = '$totalAmount' WHERE mId = '$id'";
        if(mysqli_query($db_link, $sql)){
                echo '<script type = "text/javascript"> alert("修改成功！")　</script>';
                echo '<meta http-equiv=REFRESH CONTENT=0;url=member.php>';
            }
            else
            {
            echo '<script type = "text/javascript"> alert("修改失敗！")　</script>';
            }      
    }

    //刪除資料
    if (isset($_GET['del'])) {
        $id = $_GET['del'];
        if(mysqli_query($db_link, "DELETE FROM member WHERE mId = '$id'")){
            echo '<script type = "text/javascript"> alert("刪除成功！")　</script>';
            echo '<meta http-equiv=REFRESH CONTENT=0;url=member.php>';
        }
        else{
            echo '<script type = "text/javascript"> alert("刪除失敗！")　</script>';
            echo '<meta http-equiv=REFRESH CONTENT=0;url=member.php>';
        }
       
    }

        
?>         