<?php 
    @session_start();
	header("Content-Type:text/html;charset=utf-8");
    include('../connMysql.php');

    //初始化
    $id = 0;
    $category = "";
    $News = "";
    $edit_state = false;
    
    //新增資料
    if(isset($_POST['save'])){
        $category = $_POST['category'];
        $News = $_POST['News'];

        $query = "INSERT INTO news_content(category, news) VALUES ('$category', '$News')";
        mysqli_query($db_link, $query);
        $_SESSION['msg'] = "成功新增資料";
        header('location: news.php');

    }

    //更新資料
	if (isset($_POST['update'])) {
        $id = $_POST['id'];
        $category = $_POST['category'];
        $News = $_POST['News'];

        $sql = "UPDATE news_content SET category = '$category', news = '$News' WHERE id = '$id'";
        if(mysqli_query($db_link, $sql))
            {
                    echo '<script type = "text/javascript"> alert("文字修改成功！")　</script>';
                    header('location: news.php');
            }
            else
            {
            echo '<script type = "text/javascript"> alert("文字修改失敗！")　</script>';
            }      
    }

    //刪除資料
    if (isset($_GET['del'])) {
        $id = $_GET['del'];
        mysqli_query($db_link, "DELETE FROM news_content WHERE id = $id");
        $_SESSION['msg'] = "資料刪除";
        header('location: news.php');
    }

    //回傳資料
    $results = mysqli_query($db_link, "SELECT * FROM news_content");
?>