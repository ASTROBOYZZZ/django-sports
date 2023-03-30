<!-- userlogin 从page-signin接受注册表单，并以低权限接入数据库。 -->
<?php
    $phone = test_input($_POST["phone"]);
    $password = test_input($_POST["password"]);
    $db_user = test_input($_POST["db_user"]);
    $db_pass = test_input($_POST["db_pass"]);
 
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
    $conn = mysqli_connect('localhost',$db_user,$db_pass);
    if($conn){
        //link success
        $select = mysqli_select_db($conn, "misaki_joy");
        if($select){
            //select succeed
            $sql_select = "select phone, password, name from misaki_joy.admin where phone = '$phone' and password = '$password'";
            //set code 
            mysqli_query($conn,'SET NAMES UTF8');
            //take sql sentence 
            $ret = mysqli_query($conn,$sql_select);
            $row = mysqli_fetch_array($ret);

            // echo 
            //true
            if($phone == $row['phone'] && $password == $row['password']){
                //jump
                setrawcookie("admin_name", $phone);
                setrawcookie("admin_pass", $password);
                setrawcookie("db_user", $db_user);
                setrawcookie("db_pass", $db_pass);
                echo"<script type="."\""."text/javascript"."\"".">"."window.location="."\""."admin_center_main.php"."\""."</script>";
            }
            else{
                //false
                echo"<script type="."\""."text/javascript"."\"".">"."window.alert"."("."\""."内容输入有误！"."\"".")".";"."</script>";
                echo"<script type="."\""."text/javascript"."\"".">"."window.location="."\""."admin_login_frame.html"."\""."</script>";
            }
        }
        mysqli_close($conn);
    }
    else{
        //connect to error diagnos
        die('Could not nonnect:'.mysql_error());
    }
?>
