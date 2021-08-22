<?php  @session_start();
	header("Content-Type:text/html;charset=utf-8");
    include('../connMysql.php');

    $title = $_POST['title'];
    $content = $_POST['content'];
    $slogan = $_POST['slogan'];
    $filename = $_FILES["edit_index_image"]["name"];
    $filesize = $_FILES["edit_index_image"]["size"];
    $filetype = $_FILES["edit_index_image"]["type"];
    $filetmp_name = $_FILES["edit_index_image"]["tmp_name"];

	if (isset($_POST['update'])) {

        if ($filesize > 0 ) {   
            $file=explode(".",$filename);//分割檔名
            //echo $file[0];/*主檔名*/
            //echo $file[1];/*副檔名*/
            date_default_timezone_set('Asia/Taipei');
            $new_name=$file[0].".".$file[1];
            $fileroute="../assets/".$new_name;
            move_uploaded_file($filetmp_name,$fileroute);
            $index_image = "UPDATE index_content SET image = '$new_name' WHERE ID = 1";

            if(mysqli_query($db_link, $index_image)){
                echo '<script type = "text/javascript"> alert("圖片修改成功！")　</script>';
            }
            else{
                echo '<script type = "text/javascript"> alert("圖片修改失敗！")　</script>';
            }
        }

        $sql = "UPDATE index_content SET title = '$title', content = '$content', slogan = '$slogan' WHERE ID = 1";
        if(mysqli_query($db_link, $sql))
            {
                    echo '<script type = "text/javascript"> alert("文字修改成功！")　</script>';
                    echo '<meta http-equiv=REFRESH CONTENT=0;url=index.php>';
            }
            else
            {
            echo '<script type = "text/javascript"> alert("文字修改失敗！")　</script>';
            }
	}
?>