<?php @session_start();
	header("Content-Type:text/html;charset=utf-8");
    include('../connMysql.php');

    $store = $_POST['store'];
    $tel = $_POST['tel'];
    $fax = $_POST['fax'];
    $location = $_POST['location'];
    $openingHour = $_POST['openingHour'];

	if (isset($_POST['update'])) {

        $sql = "UPDATE contact_content SET store = '$store', tel = '$tel' , fax = '$fax', location = '$location', openingHour = '$openingHour' WHERE id = 1";
        if(mysqli_query($db_link, $sql))
            {
                    echo '<script type = "text/javascript"> alert("修改成功！")　</script>';
                    echo '<meta http-equiv=REFRESH CONTENT=0;url=contact.php>';
            }
            else
            {
            echo '<script type = "text/javascript"> alert("修改失敗！")　</script>';
            }
	}
?>