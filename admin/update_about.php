<?php @session_start();
	header("Content-Type:text/html;charset=utf-8");
    include('../connMysql.php');

    $title = $_POST['title'];
    $content = $_POST['content'];

	if (isset($_POST['update'])) {

        $sql = "UPDATE about_content SET about_title = '$title', about_article = '$content' WHERE about_id = 1";
        if(mysqli_query($db_link, $sql))
            {
                    echo '<script type = "text/javascript"> alert("修改成功！")　</script>';
                    echo '<meta http-equiv=REFRESH CONTENT=0;url=about.php>';
            }
            else
            {
            echo '<script type = "text/javascript"> alert("修改失敗！")　</script>';
            }
	}
?>