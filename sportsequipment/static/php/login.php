<!-- userlogin 从page-signin接受注册表单，并以低权限接入数据库。 -->
<?php
    $phone = test_input($_POST["phone"]);
    $password = test_input($_POST["password"]);
 
function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>

<?php
    header("Content-type: text/html;charset=utf-8");
    //link
    $conn = mysqli_connect('localhost','low_user','user123');
    if($conn){
        //link success
        $select = mysqli_select_db($conn, "misaki_joy");
        if($select){
            //select succeed
            $sql_select = "select phone, password, name from misaki_joy.user where phone = '$phone' and password = '$password'";
            //set code 
            mysqli_query($conn,'SET NAMES UTF8');
            //take sql sentence 
            $ret = mysqli_query($conn,$sql_select);
            $row = mysqli_fetch_array($ret);

            // echo 
            //true
            if($phone == $row['phone'] && $password == $row['password']){
                //jump
                setrawcookie("userPhone", $phone);
                setrawcookie("userName", test_input($row['name']));
                echo"<script type="."\""."text/javascript"."\"".">"."window.location="."\""."user_center_main.php"."\""."</script>";
            }
            else{
                //false
                echo"<script type="."\""."text/javascript"."\"".">"."window.alert"."("."\""."内容输入有误！"."\"".")".";"."</script>";
                echo"<script type="."\""."text/javascript"."\"".">"."window.location="."\""."page-singin.html"."\""."</script>";
            }
        }
        mysqli_close($conn);
    }
    else{
        //connect to error diagnos
        die('Could not nonnect:'.mysql_error());
    }
?>
