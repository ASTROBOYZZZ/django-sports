<!-- adduser 从machine_center接受注册表单，并以接入数据库。 -->
<?php
    header("Content-Type: text/html;charset=utf-8");
    //link
    $conn = mysqli_connect('localhost',$_COOKIE["db_user"],$_COOKIE["db_pass"]);
    if($conn){
        //link start
        echo  "link start!";
        $select = mysqli_select_db($conn,"misaki_joy");
        $mc_name = $_POST["name"];
        $mc_func = $_POST["func"];
        $mc_date = $_POST["date"];
        $mc_cost = $_POST["cost"];
        $owner = $_POST["owner"];
        $mc_ser_num = $_POST["ser_num"];

        //设置编码
        mysqli_set_charset($conn,'utf8');


        $sql_insert = "insert into `misaki_joy`.`machine` (`id`, `name`, `ser_num`, `lent`, `ord_id`, `repaired`, `rep_id`, `func`, `date`, `cost`, `usable`, `area`, `rep_time`, `lent_time`, `owner`) values(NULL, '$mc_name', '$mc_ser_num', 0, NULL, 0, NULL, '$mc_func', '$mc_date', '$mc_cost', 100, 0, 0, 0, '$owner')";
        $ret = mysqli_query($conn, $sql_insert);
        //$row = mysqli_fetch_array($ret);
        //

        //mysqli_close($conn);
        if($ret)
            die('添加成功');
        else
            die('添加失败');
        }
    
    else {
        //link error 
        die('Coule not connect:'.mysql_error());
    }
?>