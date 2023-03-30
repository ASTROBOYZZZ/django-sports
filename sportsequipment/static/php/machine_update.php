<!DOCTYPE html>
<html>
<?php 
    $db_user = $_COOKIE["db_user"];
    $db_pass = $_COOKIE["db_pass"];

    $mac_usable = test_input($_POST["mac_usable"]);
    $name = test_input($_POST["name"]);
    $ser_num = $_POST["ser_num"];
    $mac_area = test_input($_POST["mac_area"]);
    $mac_id = $_POST["mac_id"];
    $repaired = $_POST["rep_update"];

    $conn = mysqli_connect('localhost', $db_user, $db_pass);
    if($conn)
    {
        echo "link start\n";
        // $sql1 = "select *";
        // $sql2 = " from misaki_joy.machine where ";
        // $sql3 = "id = $id";

        //echo $sql1 . $sql2 . $sql3;
        $select = mysqli_select_db($conn, "misaki_joy");
        mysqli_query($conn, 'SET NAMES UTF8');

        $sql_return = mysqli_query($conn,"UPDATE misaki_joy.machine SET usable = '$mac_usable', area = '$mac_area', repaired = '$repaired', ser_num = '$ser_num' WHERE machine.id = '$mac_id'");
        if($sql_return) {
            echo"<script type="."\""."text/javascript"."\"".">"."window.alert"."("."\""."成功！"."\"".")".";"."</script>";
            echo "<script type=" . "\"" . "text/javascript" . "\"" . ">" . "window.location=" . "\"" . "admin_machine_info.php?mac_id=" . "$mac_id" . "\"" . "</script>";
        }
        else 
        {
            echo"<script type="."\""."text/javascript"."\"".">"."window.alert"."("."\""."失败！"."\"".")".";"."</script>"; 
        }
        echo "change success!";
        mysqli_close($conn);
        // echo $loc_tar;
        // header($loc_tar);
        // $res = mysqli_query($conn,$sql1 . $sql2 . $sql3);
        // $row = mysqli_fetch_array($res);

     
    }

    function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

?>

</html>