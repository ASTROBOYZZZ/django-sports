<!-- 订单更新页面 -->
<!DOCTYPE html>
<html>
<?php 
    $db_user = $_COOKIE["db_user"];
    $db_password = $_COOKIE["db_pass"];
    $id = $_POST["ord_id"];
    $mac_id = $_POST["mac_id"];
    $acc_update = $_POST["acc_update"];
?>

<!-- 验证账户状态 -->
<?php
    header("Content-type: text/html;charset=utf-8");
    //link
    $conn = mysqli_connect('localhost',$db_user,$db_password);
    if($conn){
        //link success
        $select = mysqli_select_db($conn, "misaki_joy");
        if($select){
            //select succeed
            // $sql_select = "select phone, password, name from misaki_joy.admin where phone = '$phone' and password = '$password'";
            // $sql_select = "select * from misaki_joy.order where id = $ord_id";
            $sql_select = "select * from misaki_joy.machine where misaki_joy.machine.id = $mac_id";
            //set code 
            // mysqli_query($conn, 'SET NAMES UTF8');

            //获取订单信息表
            $sql_return = mysqli_query($conn, $sql_select);
            $row = mysqli_fetch_array($sql_return);

            if(($row['lent'] == 1 || $row['repaired']) && $acc_update == 1)
            {
                echo "<script type=" . "\"" . "text/javascript" . "\"" . ">" . "window.alert" . "(" . "\"" . "当前机器不可租用" . "\"" . ")" . ";" . "</script>";
                echo "<script type=" . "\"" . "text/javascript" . "\"" . ">" . "window.location=" . "\"" . "admin_order_info.php?ord_id=$id" . "\"" . "</script>";
                die('');
            }

            $sql_select = "UPDATE misaki_joy.order SET accept = $acc_update WHERE order.id = '$id'";
            //set code 
            mysqli_query($conn,'SET NAMES UTF8');
            //take sql sentence 
            $res = mysqli_query($conn,$sql_select);
            // $row = mysqli_fetch_array($ret);

            // echo 
            //true
            if($res ){
                //jump
                if($acc_update==1)
                {
                    $sql_select = "UPDATE misaki_joy.machine SET lent = 1, ord_id = $id WHERE machine.id = '$mac_id'";
                    mysqli_query($conn,$sql_select);
                    mysqli_close($conn);
                }
                echo "<script type=" . "\"" . "text/javascript" . "\"" . ">" . "window.alert" . "(" . "\"" . "审批完成" . "\"" . ")" . ";" . "</script>";
                            echo "<script type=" . "\"" . "text/javascript" . "\"" . ">" . "window.location=" . "\"" . "admin_order_info.php?ord_id=$id" . "\"" . "</script>";
                die('');
            }
            else{
                //false
                mysqli_close($conn);
                die('修改订单失败，请返回48');
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