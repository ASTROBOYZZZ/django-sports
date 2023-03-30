<!-- 订单更新页面 -->
<!DOCTYPE html>
<html>
<?php 
    $mac_id = $_COOKIE["mac_id"];
    $phone = $_COOKIE["userPhone"];
    setrawcookie("userCookie",$phone);
    $ord_value = $_POST["ord_value"];
    $mac_usable = $_POST["mac_usable"];
    $mac_area = $_POST["mac_area"];
    $acc = 0;
?>

<!-- 验证账户状态 -->
<?php
    header("Content-type: text/html;charset=utf-8");
    //link
    $conn = mysqli_connect('localhost','low_user','user123');
    if($conn){
        //link success
        $select = mysqli_select_db($conn, "misaki_joy");
        if($select){
            //select succeed
            // $sql_select = "select phone, password, name from misaki_joy.admin where phone = '$phone' and password = '$password'";
            // $sql_select = "select * from misaki_joy.order where id = $ord_id";
            $date_t = date('Y-m-d');
            $sql_select = "INSERT INTO `misaki_joy`.`order` ( `mac_id`, `date`, `accept`, `value`, `phone`,`mac_usable`, `mac_area`) VALUES ( '$mac_id', '$date_t', '0','$ord_value', '$phone', '$mac_usable', '$mac_area')";
            //set code 
            mysqli_query($conn,'SET NAMES UTF8');
            //take sql sentence 
            $res = mysqli_query($conn,$sql_select);
            // $row = mysqli_fetch_array($ret);

            // echo 
            //true
            if($res){
                //jump
                echo"<script type="."\""."text/javascript"."\"".">"."window.alert"."("."\""."订单创建成功！"."\"".")".";"."</script>";
                echo"<script type="."\""."text/javascript"."\"".">"."window.location="."\""."user_center_main.php"."\""."</script>";
            }
            else{
                //false
                mysqli_close($conn);
                die('创建订单失败，请返回');
            }
        }
        else mysqli_close($conn);
    }
    else{
        //connect to error diagnos
        die('数据库验证失败，请返回');
    }
?>

</html>