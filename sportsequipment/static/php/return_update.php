<!-- 还单更新  -->
<!-- 更新机器 mac_id: usable area lent_time lent value -->
<!-- 更新订单 ord_id: ret ret_id  -->
<!-- 更新还单 ret_id: accept -->
<!-- 插入作业信息 -->
<!DOCTYPE html>
<html>
    <head>
        <meta charset = "utf-8">
        <title>还单详情</title>
    </head>
<?php 
    $db_user = $_COOKIE["db_user"];
    $db_password = $_COOKIE["db_pass"];
    $mac_id = $_POST["mac_id"];
    $usable_new = $_POST["usable"];
    $area_new = intval($_POST["mac_area"]) + intval($_POST["area"]);
    $lent_time = "";
    $value = $_POST["value"];

    $loc_num = $_POST["loc_num"];
    $phone = $_POST["phone"];
    $loc_txt = $_POST["loc_txt"];
    $ord_id = $_POST["ord_id"];
    $ret_id = $_POST["ret_id"];
    $ord_date = $_POST["ord_date"];
    $ret_date = $_POST["ret_date"];
    $acc = $_POST["acc_update"];
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
            //先改还单
            $sql_select = "select * from misaki_joy.return where id = $ret_id";
            //set code 
            mysqli_query($conn,'SET NAMES UTF8');
            //take sql sentence 
            $res = mysqli_query($conn,$sql_select);
            // $row = mysqli_fetch_array($ret);

            // echo 
            //true
            if($res){
                //jump
                echo "<script language='JavaScript'>alert('还单修改');</script>";
                $row = mysqli_fetch_array($res);
                
                // 一步验证
                if($phone == $phone)
                {
                    $sql_select = "UPDATE misaki_joy.return SET accept = $acc WHERE misaki_joy.return.id = '$ret_id'";
                    $res = mysqli_query($conn,$sql_select);

                    if($res){
                        if($acc != 4) // 有信息可更新
                        {
                            // 更新 acc==2||acc==3 时对应订单信息
                            $sql_select = "select * from misaki_joy.order where id = '$ord_id'";
                            $res = mysqli_query($conn,$sql_select);
                            $row = mysqli_fetch_array($res);
                            if($row['ret'] == 2) 
                            {//订单已锁定
                                //设置还单为失效还单
                                $sql_select = "UPDATE misaki_joy.return SET ret = 4 WHERE misaki_joy.return.id = '$ret_id'";
                                $res = mysqli_query($conn,$sql_select);
                                die('修改订单已锁定');
                            }

                            $sql_select = "UPDATE misaki_joy.order SET ret = $acc, ret_id = $ret_id WHERE misaki_joy.order.id = '$ord_id'";
                            $res = mysqli_query($conn,$sql_select);
                            if(!$res) die('修改订单时发生错误');
                            

                            $sql_select = "select * from misaki_joy.machine where id = '$mac_id'";
                            $res = mysqli_query($conn,$sql_select);
                            $row = mysqli_fetch_array($res);
                            if(!$res) die('修改机器时发生错误');
                            if(!$row["lent"] || $row["repaired"] || ($row["lent"]&& ($row["ord_id"]!=$ord_id)))
                            {//农机状态不匹配
                                //设置还单为失效还单
                                $sql_select = "UPDATE misaki_joy.return SET accept = 4 WHERE misaki_joy.return.id = '$ret_id'";
                                $res = mysqli_query($conn,$sql_select);
                                $sql_select = "UPDATE misaki_joy.ord SET accept = 4 WHERE misaki_joy.order.id = '$ord_id'";
                                $res = mysqli_query($conn,$sql_select);
                                die('农机状态不匹配');
                            }
                            if($acc == 2)
                            {//修改机器信息
                                $lent_time = intval($row['lent_time']) + 1;
                                $sql_select = "UPDATE misaki_joy.machine SET lent = 0, area = $area_new, usable = $usable_new, lent_time = $lent_time WHERE misaki_joy.machine.id = '$mac_id'";
                                $res = mysqli_query($conn,$sql_select);
                                if(!$res) die('修改机器状态失败');
                                //添加作业信息至作业表
                                $work_area = $_POST["area"];
                                $sql_select = "INSERT INTO `misaki_joy`.`machine_work` ( `mac_id`, `ret_date`, `ord_date`, `ret_area`, `loc_num`, `loc_txt`, `phone`, `ret_id`) VALUES ( '$mac_id', '$ret_date', '$ord_date', '$work_area', '$loc_num', '$loc_txt', '$phone', '$ret_id')";
                                $res = mysqli_query($conn, $sql_select);
                            }

                        }
                        echo "<script type=" . "\"" . "text/javascript" . "\"" . ">" . "window.alert" . "(" . "\"" . "还单审批成功" . "\"" . ")" . ";" . "</script>";
                        echo "<script type=" . "\"" . "text/javascript" . "\"" . ">" . "window.location=" . "\"" . "admin_return_info.php?ret_id=$ret_id" . "\"" . "</script>";
                    }
                    else die('修改还单失败');
                }
                
            }
            else{
                //false
                mysqli_close($conn);
                die('访问订单失败');
            }
        }
        else mysqli_close($conn);
    }
    else{
        //connect to error diagnos
        die('数据库验证失败，请返回');
    }
?>
