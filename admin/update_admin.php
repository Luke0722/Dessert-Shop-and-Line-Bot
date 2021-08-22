<?php
header("Content-Type:text/html;charset=utf-8");
include('../connMysql.php');
$success = "";

    //初始化
    $id = 0;
    $name = "";
    $password = "";
    $account = "";
    $rName = "";

    //新增資料
    if(isset($_POST['add']))
    {  
        $name  = $_POST['aName'];
        $account = $_POST['aAccount'];
        $password = $_POST['aPassword'];
        $rName = $_POST['rName'];

        $sql = "INSERT INTO admin (aName, aAccount, aPassword, rName) 
        VALUES ('$name', '$account', '$password', '$rName')";
        if (mysqli_query($db_link, $sql))
        {
            echo '<script type = "text/javascript"> alert("新增成功！")　</script>';
            echo '<meta http-equiv=REFRESH CONTENT=0;url=admin.php>';
        }
        else{
            echo "Error: " . $sql . " " . mysqli_error($db_link);
            echo '<script type = "text/javascript"> alert("新增失敗！")　</script>';
            echo '<meta http-equiv=REFRESH CONTENT=5;url=admin.php>';
        }
        mysqli_close($db_link);
    }

    //update
    if(isset($_POST['id'])){
        $id = $_POST['id'];
        $name  = $_POST['aName'];
        $account = $_POST['aAccount'];
        $rName = $_POST["rName"];  

        //修改資料
        $sql = "UPDATE admin SET aName = '$name', aAccount = '$account', rName = '$rName' WHERE aId = '$id'";
        if(mysqli_query($db_link, $sql)){
                echo '<script type = "text/javascript"> alert("修改成功！")　</script>';
                echo '<meta http-equiv=REFRESH CONTENT=5;url=admin.php>';
            }
            else
            {
            echo '<script type = "text/javascript"> alert("修改失敗！")　</script>';
            echo '<meta http-equiv=REFRESH CONTENT=5;url=admin.php>';
            }      
    }

    //刪除資料
    if (isset($_GET['del'])) {
        $id = $_GET['del'];
        if(mysqli_query($db_link, "DELETE FROM admin WHERE aId = '$id'")){
            echo '<script type = "text/javascript"> alert("刪除成功！")　</script>';
            echo '<meta http-equiv=REFRESH CONTENT=0;url=admin.php>';
        }
        else{
            echo '<script type = "text/javascript"> alert("刪除失敗！")　</script>';
            echo '<meta http-equiv=REFRESH CONTENT=5;url=admin.php>';
        }
       
    }

        
?>         