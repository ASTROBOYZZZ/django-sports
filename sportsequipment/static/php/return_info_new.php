<!-- 订单详细页面 -->
<!DOCTYPE html>
<html>
    <head>
        <meta charset = "utf-8">
        <title>还单详情</title>
    </head>
<?php 
    $db_user = $_COOKIE["db_user"];
    $db_password = $_COOKIE["db_pass"];
    $id = $_GET["ret_id"];
    $acc = -1;
    $is_user = False;
    $user_id = "";
    if($db_user == "low_user") {
        $is_user = TRUE;
        $user_id = $_COOKIE["userCookie"];
    }
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
            $sql_select = "select * from misaki_joy.return where id = $id";
            //set code 
            mysqli_query($conn,'SET NAMES UTF8');
            //take sql sentence 
            $res = mysqli_query($conn,$sql_select);
            // $row = mysqli_fetch_array($ret);

            // echo 
            //true
            if($res){
                //jump
                echo "<script language='JavaScript'>alert('还单详单查看');</script>";
                $row = mysqli_fetch_array($res);
                
                $ord_id = $row['ord_id'];
                $usable = $row['usable'];
                $area = $row['area'];
                $mac_id = $row['mac_id'];
                $date_ret = $row['date'];
                $acc = $row['accept'];
                
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

<?php 
    $ret_flag = 0;
    $ret_char = "";
    //判定定订单是否过期
    // if($acc != 1) {
        //save the value
        

        //取得机器相关信息
        $sql_select = "select usable, lent_time, area from misaki_joy.machine where id = $mac_id";
        $sql_res = mysqli_query($conn,$sql_select);
        $row = mysqli_fetch_array($sql_res);
        $mac_area = intval($row['area']);
        $ret_time = intval($row['lent_time']);
        $mac_usable = $row['usable'];

        //set code 
        // mysqli_query($conn,'SET NAMES UTF8');
        $sql_select = "select * from misaki_joy.order where id = $ord_id";
        //take sql sentence 
        $sql_res = mysqli_query($conn,$sql_select);
        $row = mysqli_fetch_array($sql_res);
        $acc_ord = $row['ret'];
        $cor_ret = $row['ret_id'];
        if($is_user)
        {
            if($row['phone'] != $user_id) die('无权访问该还单');
        }
        

        if($acc == 1 && $row['ret'] == 2) //详单状态需要判定
        {
            // 该详单未通过对应详单已通过
            //直接修改
            $sql_select = "UPDATE misaki_joy.return SET accept = 4 WHERE misaki_joy.return.id = '$id'";
            $sql_res = mysqli_query($conn,$sql_select);
            
            if($sql_res){//修改成功
                $loc_tar = "location:return_info.php?ret_id=$id";
                header($loc_tar);
            }
            else die('订单已过期');
        }
        else if($acc == 2){
            $ret_flag = 1;
            $ret_char = "订单已通过";
        }
        else if($acc == 3){
            $ret_flag = 2;
            $ret_char = "订单已拒绝";
        }
        else if($acc == 4){
            $ret_flag = 3;
            $ret_char = "订单已过期";
        }
        echo "<h3>" . $ret_char . "</h3>";        
    // }
?>

    <body>
        <form action = <?php echo (($acc==1&&!$is_user)?"return_update.php":"");?> method = "post">
            <fieldset>
                <legend>详单详情</legend>
                订单序号：<input type="text" name="ord_id" value="<?php echo $row["id"];?>" readonly>
                <br>机器序号：<input type="text" name="mac_id" value="<?php echo $row["mac_id"];?>" readonly>
                <br>订单日期: <input type="date" name="ord_date" value="<?php echo $row["date"];?>" readonly>
                <br>租金：<input type="text" name="value" value="<?php echo $row["value"];?>" readonly>
                <br>租户名: <input type="text" name="mc_func" value="<?php echo $row["user_name"];?>" readonly>
                <br>租户手机号: <input type="text" name="phone" value="<?php echo $row["phone"];?>" readonly>
                <br>订单归还单号: <input type="text" name="oret_id" value="<?php echo $row['ret']==2?$row["ret_id"]:"未归还";?>" readonly>
                <br>当前还单号：<input type="text" name="ret_id" value="<?php echo $id;?>" readonly >
                <br>农机租借时可用度: <input type="text" name="mac_usable" value="<?php echo $mac_usable;?>" readonly>
                <br>农机返还时可用度: <input type="text" name="usable" value="<?php echo $usable;?>" readonly>
                <br>农机租借时工作面积: <input type="text" name="mac_area" value="<?php echo $mac_area;?>" readonly>
                <br>本次工作面积: <input type="text" name="area" value="<?php echo $area;?>" readonly>
                <br>还单创建日期：<input type="date" name="ret_date" value="<?php echo $date_ret;?>" readonly>
                <br>审批结果:
                    <select name="acc_update">
                        <?php if($acc!=1 || $is_user) {echo "<option>" . $ret_char . "</option>";}
                        else  
                        {   echo "<option value=2 " ;echo ($acc==2)?"selected=\"selected\"":""; echo ">通过</option>\n";
                            echo "<option value=3 "  ;echo ($acc==3)?"selected=\"selected\"":""; echo ">拒绝</option>\n";
                            echo "<option value=1 "  ;echo ($acc==1)?"selected=\"selected\"":""; echo ">未审核</option>\n";
                            echo "<option value=1 "  ;echo ($acc==4)?"selected=\"selected\"":""; echo ">已过期</option>" ;
                        }?>
                    </select>
                <?php if( $acc==1 && !$ret_flag && !$is_user) echo "<p><input type = \"submit\" value = \"上传审批结果\" name = \"admin_sub_ret\"></p>"; ?>
        </form>
    </body>
</html>