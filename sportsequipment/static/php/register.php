<?php
    //处理文本
    $phone = test_input($_POST["phone"]);
    $password = test_input($_POST["password"]);
    $re_password = test_input($_POST["re_password"]);
    $user_name = test_input($_POST["user_name"]);
 
function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>

<?php
	header("Content-Type: text/html;charset=utf-8");
	//建立连接
	$conn = mysqli_connect('localhost','low_user','user123');
	if($conn){
		//数据库连接成功
		$select = mysqli_select_db($conn,"misaki_joy");		//选择数据库
		if(isset($_POST["user_reg"])){
			

			if($password == $re_password){
				//两次密码输入一致
				mysqli_set_charset($conn,'utf8');	//设置编码
				
				//sql语句
				$sql_select = "select phone from misaki_joy.user where phone = '$phone'";
				//sql语句执行
				$result = mysqli_query($conn,$sql_select);
				//判断用户名是否已存在
				$num = mysqli_num_rows($result); 
				
				if($num){
					//用户名已存在
					echo"<script type="."\""."text/javascript"."\"".">"."window.alert"."("."\""."用户名已存在！"."\"".")".";"."</script>";
					echo"<script type="."\""."text/javascript"."\"".">"."window.location="."\""."page-singup.html"."\""."</script>";
					exit;
				}else{
					//用户名不存在
					$sql_insert = "insert into misaki_joy.user(name,password,phone,value) values('$user_name','$password','$phone','0')";
					//插入数据
					$ret = mysqli_query($conn,$sql_insert);
					$row = mysqli_fetch_array($ret); 
					//跳转注册成功页面
					echo"<script type="."\""."text/javascript"."\"".">"."window.alert"."("."\""."注册成功！"."\"".")".";"."</script>";
					echo"<script type="."\""."text/javascript"."\"".">"."window.location="."\""."page-singin.html"."\""."</script>";
				}
			}else{
				//两次密码输入不一致
				echo"<script type="."\""."text/javascript"."\"".">"."window.alert"."("."\""."两次密码输入不一致！"."\"".")".";"."</script>";
				echo"<script type="."\""."text/javascript"."\"".">"."window.location="."\""."page-singup.html"."\""."</script>";
				exit;
			}
		}
		//关闭数据库
		mysqli_close($conn);
	}else{
		//连接错误处理
		die('Could not connect:'.mysql_error());
	}
 
?>