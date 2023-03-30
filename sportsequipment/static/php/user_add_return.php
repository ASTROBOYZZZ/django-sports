<!-- 订单详细信息查看 归还订单创建 -->
<!DOCTYPE html>
<html>
    <head>
        <meta charset = "utf-8">
        <title>农机信息</title>
    </head>
<?php 
    $phone = test_input($_COOKIE["userPhone"]);
    $area = test_input($_POST["area"]);
    $usable = test_input($_POST["usable"]);
    $ord_id = test_input($_POST["ord_id"]);
    $mac_id = test_input($_POST["mac_id"]);
    $loc_num = test_input($_POST["loc_num"]);
    $loc_txt = test_input($_POST["loc_txt"]);


    function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
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
            $sql_select = "select * from misaki_joy.order where phone = '$phone' and id = '$ord_id'";
            //set code 
            mysqli_query($conn,'SET NAMES UTF8');
            //take sql sentence 
            $ret = mysqli_query($conn,$sql_select);
            $row = mysqli_fetch_array($ret);

            // echo 
            //true
            if($phone == $row['phone'] && $ord_id == $row['id']){
                //jump
                echo "<script language='JavaScript'>alert('开始上传');</script>";
                $mac_id = $row['mac_id'];
                $date_ret = date('Y-m-d');
                $sql_select = "INSERT INTO `misaki_joy`.`return` ( `ord_id`, `area`, `usable`, `date`, `mac_id`, `accept`, `loc_num`, `loc_txt`) VALUES ( '$ord_id', '$area', '$usable','$date_ret', '$mac_id', '1', '$loc_num', '$loc_txt')";
                $ret = mysqli_query($conn, $sql_select);
                $ret_id = mysqli_insert_id($conn);
                

                $sql_select = "UPDATE misaki_joy.order SET `ret` = 1, `ret_id` = $ret_id WHERE misaki_joy.order.id = $ord_id";
                $ret = mysqli_query($conn, $sql_select);

                if($ret) 
                {
                    mysqli_close($conn);
                    echo "<script type=" . "\"" . "text/javascript" . "\"" . ">" . "window.alert" . "(" . "\"" . "添加订单成功" . "\"" . ")" . ";" . "</script>";
                    echo "<script type=" . "\"" . "text/javascript" . "\"" . ">" . "window.location=" . "\"" . "user_center_main.php" . "\"" . "</script>";
                    exit;
                }
                else 
                {
                    mysqli_close($conn);
                    echo "<script type=" . "\"" . "text/javascript" . "\"" . ">" . "window.alert" . "(" . "\"" . "创建订单失败" . "\"" . ")" . ";" . "</script>";
                    echo "<script type=" . "\"" . "text/javascript" . "\"" . ">" . "window.location=" . "\"" . "user_center_main.php" . "\"" . "</script>";
                    exit;
                }
                

            }
            else{
                //false
                mysqli_close($conn);
                echo "<script type=" . "\"" . "text/javascript" . "\"" . ">" . "window.alert" . "(" . "\"" . "订单数据非法" . "\"" . ")" . ";" . "</script>";
                echo "<script type=" . "\"" . "text/javascript" . "\"" . ">" . "window.location=" . "\"" . "user_center_main.php" . "\"" . "</script>";
                exit;
            }
        }
        else mysqli_close($conn);
    }
    else{
        //connect to error diagnos
        echo "<script type=" . "\"" . "text/javascript" . "\"" . ">" . "window.alert" . "(" . "\"" . "数据库验证失败" . "\"" . ")" . ";" . "</script>";
        echo "<script type=" . "\"" . "text/javascript" . "\"" . ">" . "window.location=" . "\"" . "user_center_main.php" . "\"" . "</script>";
        exit;
    }
?>