<!DOCTYPE html>
<html lang="zxx">

<head>
    <!-- The above 6 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="keyword" content="">
    <meta name="author" content="" />
    <!-- Page Title here to disign -->
    <title>农机信息查看 | Joy Machine Info Manage Center</title>
    <!-- Main CSS -->
    <link type="text/css" rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.min.css" />
    <link type="text/css" rel="stylesheet" href="assets/plugins/font-awesome/css/font-awesome.min.css" />
    <link type="text/css" rel="stylesheet" href="assets/plugins/flag-icon/flag-icon.min.css" />
    <link type="text/css" rel="stylesheet" href="assets/plugins/simple-line-icons/css/simple-line-icons.css">
    <link type="text/css" rel="stylesheet" href="assets/plugins/ionicons/css/ionicons.css">
    <link type="text/css" rel="stylesheet" href="assets/plugins/toastr/toastr.min.css">
    <link type="text/css" rel="stylesheet" href="assets/plugins/chartist/chartist.css">
    <link type="text/css" rel="stylesheet" href="assets/plugins/apex-chart/apexcharts.css">
    <link type="text/css" rel="stylesheet" href="assets/css/app.min.css" />
    <link type="text/css" rel="stylesheet" href="assets/css/style.min.css" />
    <!-- Favicon -->
    <link rel="icon" href="assets/images/favicon.ico" type="image/x-icon">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn"t work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="http://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="http://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
      <![endif]-->
</head>
<?php
$admin_name = $_COOKIE["admin_name"];
$admin_pass = $_COOKIE["admin_pass"];
setrawcookie("admin_name", $admin_name);
setrawcookie("admin_pass", $admin_pass);
$db_user = $_COOKIE["db_user"];
$db_pass = $_COOKIE["db_pass"];
$ord_id = $_GET["ord_id"];
$acc = -1;
setrawcookie("db_user", $db_user);
setrawcookie("db_pass", $db_pass);

if ($ord_id == 0) {
    header('location:admin_order_info_search.php');
    exit;
}

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>

<body>
    <!--================================-->
    <!-- Page Container Start -->
    <!--================================-->
    <div class="page-container">
        <!--================================-->
        <!-- Page Sidebar Start -->
        <!--================================-->
        <div class="page-sidebar">
            <div class="logo">
                <a class="logo-img" href="index.html">
                    <img class="desktop-logo" src="assets/images/logo-white.png" alt="">
                    <img class="small-logo" src="assets/images/small-logo.png" alt="">
                </a>
                <i class="ion-ios-close-empty" id="sidebar-toggle-button-close"></i>
            </div>
            <!--================================-->
            <!-- Sidebar Menu Start -->
            <!--================================-->
            <div class="page-sidebar-inner">
                <div class="page-sidebar-menu">
                    <ul class="accordion-menu">
                        <li class="open active">
                            <a href=""><i data-feather="home"></i>
                                <span>Dashboard</span><i class="accordion-icon fa fa-angle-left"></i></a>
                            <ul class="sub-menu" style="display: block;">
                                <!-- Active Page here to design-->
                                <li><a href="admin_center_main.php">概览</a></li>
                                <li><a href="admin_machine_info.php?mac_id=0">农机信息</a></li>
                                <li class="active"><a href="admin_order_info.php?ord_id=0">订单信息</a></li>
                                <li><a href="admin_return_info.php?ret_id=0">还单信息</a></li>

                            </ul>
                        </li>
                        <li>
                            <a href=""><i data-feather="mail"></i>
                            <span>农机工作信息</span><span class="badge badge-warning ft-right">10+</span></a>
                            <ul class="sub-menu">
                                <li><a href="admin_machine_work_center.php">信息中心</a></li>
                                <li class><a href="admin_machine_work_center.php">农机工作信息</a></li>
                                <li class><a href="admin_machine_work_center.php">工作信息</a></li>
                            </ul>
                        </li>
                        <!-- del left -->

                        <!-- del left -->
                    </ul>
                </div>
            </div>
            <!--/ Sidebar Menu End -->
            <!--================================-->
            <!-- Sidebar Footer Start -->
            <!--================================-->
            <div class="sidebar-footer">
                <a class="pull-left" href="page-profile.html" data-toggle="tooltip" data-placement="top" data-original-title="Profile">
                    <i data-feather="user" class="ht-15"></i></a>
                <a class="pull-left " href="mailbox.html" data-toggle="tooltip" data-placement="top" data-original-title="Mailbox">
                    <i data-feather="mail" class="ht-15"></i></a>
                <a class="pull-left" href="page-unlock.html" data-toggle="tooltip" data-placement="top" data-original-title="Lockscreen">
                    <i data-feather="lock" class="ht-15"></i></a>
                <a class="pull-left" href="page-singin.html" data-toggle="tooltip" data-placement="top" data-original-title="Sing Out">
                    <i data-feather="log-out" class="ht-15"></i></a>
            </div>
            <!--/ Sidebar Footer End -->
        </div>
        <!--/ Page Sidebar End -->
        <!--================================-->
        <!-- Page Content Start -->
        <!--================================-->
        <div class="page-content">
            <!--================================-->
            <!-- Page Header Start -->
            <!--================================-->
            <div class="page-header">
                <div class="search-form">
                    <form action="#" method="GET">
                        <div class="input-group">
                            <input class="form-control search-input" name="search" placeholder="Type something..." type="text" />
                            <span class="input-group-btn">
                                <span id="close-search"><i class="ion-ios-close-empty"></i></span>
                            </span>
                        </div>
                    </form>
                </div>
                <!--================================-->
                <!-- Page Header  Start -->
                <!--================================-->
                <nav class="navbar navbar-expand-lg">
                    <ul class="list-inline list-unstyled mg-r-20">
                        <!-- Mobile Toggle and Logo -->
                        <li class="list-inline-item align-text-top"><a class="hidden-md hidden-lg" href="#" id="sidebar-toggle-button"><i class="ion-navicon tx-20"></i></a></li>
                        <!-- PC Toggle and Logo -->
                        <li class="list-inline-item align-text-top"><a class="hidden-xs hidden-sm" href="#" id="collapsed-sidebar-toggle-button"><i class="ion-navicon tx-20"></i></a></li>
                    </ul>
                    <!--================================-->
                    <!-- Mega Menu Start -->
                    <!--================================-->
                    <div class="collapse navbar-collapse">
                        <ul class="navbar-nav mr-auto">

                        </ul>
                    </div>
                    <!--/ Mega Menu End-->
                    <!--/ Brand and Logo End -->
                    <!--================================-->
                    <!-- Header Right Start -->
                    <!--================================-->
                    <div class="header-right pull-right">
                        <ul class="list-inline justify-content-end">
                            <li class="list-inline-item align-middle"><a href="#" id="search-button"><i class="ion-ios-search-strong tx-20"></i></a></li>
                            <!--================================-->
                            <!-- Languages Dropdown Start -->
                            <!--================================-->

                            <!--/ Languages Dropdown End -->
                            <!--================================-->
                            <!-- Notifications Dropdown Start -->
                            <!--================================-->

                            <!--/ Notifications Dropdown End -->
                            <!--================================-->
                            <!-- Messages Dropdown Start -->
                            <!--================================-->

                            <!--/ Messages Dropdown End -->
                            <!--================================-->
                            <!-- Profile Dropdown Start -->
                            <!--================================-->
                            <li class="list-inline-item dropdown">
                                <a href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="select-profile">Hi, <?php echo $admin_name; ?>!</span><img src="assets/images/avatar-placeholder.png"" class=" img-fluid wd-35 ht-35 rounded-circle" alt=""></a>
                                <div class="dropdown-menu dropdown-menu-right dropdown-profile shadow-2">
                                    <div class="user-profile-area">
                                        <div class="user-profile-heading">
                                            <div class="profile-thumbnail">
                                                <img src="https://via.placeholder.com/100x100" class="img-fluid wd-35 ht-35 rounded-circle" alt="">
                                            </div>
                                            <div class="profile-text">
                                                <h6><?php echo $admin_name; ?></h6>
                                                <span><?php echo $admin_name; ?></span>
                                            </div>
                                        </div>
                                        <a href="" class="dropdown-item"><i class="icon-user" aria-hidden="true"></i> My profile</a>
                                        <a href="page-singin.html" class="dropdown-item"><i class="icon-power" aria-hidden="true"></i> Sign-out</a>
                                    </div>
                                </div>
                            </li>
                            <!-- Profile Dropdown End -->
                            <!--================================-->
                            <!-- Setting Sidebar Start -->
                            <!--================================-->
                            <li class="list-inline-item dropdown hidden-xs">
                                <a class="settings-icon" id="settingSidebarTrigger" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="icon-settings tx-16"></i>
                                </a>
                            </li>
                            <!--/ Setting Sidebar End -->
                        </ul>
                    </div>
                    <!--/ Header Right End -->
                </nav>
            </div>
            <!--/ Page Header End -->
            <!--================================-->
            <!-- Page Inner Start -->
            <!--================================-->
            <div class="page-inner">
                <!-- Main Wrapper -->
                <div id="main-wrapper">
                    <!--================================-->
                    <!-- Breadcrumb Start -->
                    <!--================================-->
                    <!-- here to design -->
                    <div class="pageheader pd-t-25 pd-b-35">
                        <div class="pd-t-5 pd-b-5">
                            <h1 class="pd-0 mg-0 tx-20">订单详细信息</h1>
                        </div>
                        <div class="breadcrumb pd-0 mg-0">
                            <a class="breadcrumb-item" href="index.html"><i class="icon ion-ios-home-outline"></i> Home</a>
                            <a class="breadcrumb-item" href="">Dashboard</a>
                            <!-- here to design -->
                            <span class="breadcrumb-item active">详细信息</span>
                        </div>
                    </div>
                    <!--/ Breadcrumb End -->
                    <!--================================-->
                </div>
                <!--/ Main Wrapper End -->


                <!-- Label Alignment Form Start -->
                <!--================================-->
                <?php
                //link start 
                $conn = mysqli_connect('localhost', $db_user, $db_pass);
                if ($conn) {
                    //link success
                    $sql_select = "select * from misaki_joy.order where misaki_joy.order.id = $ord_id";
                    //set code 
                    mysqli_query($conn, 'SET NAMES UTF8');

                    //获取订单信息表
                    $sql_return = mysqli_query($conn, $sql_select);

                    if ($sql_return) {
                        $row = mysqli_fetch_array($sql_return);

                        if ($row == NULL || $ord_id != $row["id"]) {
                            echo "<script type=" . "\"" . "text/javascript" . "\"" . ">" . "window.alert" . "(" . "\"" . "非法的查询" . "\"" . ")" . ";" . "</script>";
                            echo "<script type=" . "\"" . "text/javascript" . "\"" . ">" . "window.location=" . "\"" . "admin_order_info_search.html" . "\"" . "</script>";
                            exit;
                        }
                        $mac_id = $row['mac_id'];
                        
                        $date = $row['date'];


                        $phone = $row['phone'];
                        $user_name = $row['user_name'];
                        

                        $acc1 = $row['accept'];
                        $user_ret = ($acc1==2||$acc1==0)?("-"):($row['ret']?"已归还":"未归还");
                        $acc2 = $col1 = $title1 = $title2 = $form_c = $col2 = "";
                        switch ($acc1){
                            case "0":$acc2="未审批";$col1="danger";$title1="未审批";$title2="未审批";$form_c="readonly";break;
                            case "1":$acc2="已通过";$col1="success";$title1="已通过";$title2="已通过";$form_c="required";break;
                            case "2":$acc2="未通过";$col1="danger";$title1="已拒绝";$title2="已拒绝";$form_c="readonly";break;
                            default:$acc2 = $title1 = $title2 = "非法操作";$col1="danger";$form_c="disabled";
                        }
                        
                        $ret = $row['ret'];//?干嘛的这行

                        switch ($ret){
                            case "2":$acc2="请前往还单中心查看详细信息";$col1="success";$title1="订单已结束";$title2="请前往还单中心查看详细信息";$form_c="readonly";break;
                            default : $col2 = "danger";
                        }


                        $ret_id = $row['ret']?$row['ret_id']:"";
                        $value = $row['value'];
                        $ord_date = $row['date'];
                        $sql_select = "select * from misaki_joy.machine where misaki_joy.machine.id = $mac_id";
                        $sql_return = mysqli_query($conn, $sql_select);
                        $row = mysqli_fetch_array($sql_return);
                        $func = $row['func'];

                        $acc_mc = 1;
                        if(!$acc1){
                            //save the value
                            $sql_select = "select * from misaki_joy.machine where id = $mac_id";
                            //set code 
                            // mysqli_query($conn,'SET NAMES UTF8');
                            //take sql sentence 
                            $sql_res = mysqli_query($conn,$sql_select);
                            $row = mysqli_fetch_array($sql_res);
                            $acc_mc = $row['lent'];
                            if($acc_mc)
                                echo "<h3>机器使用中</h3>";        
                        }

                    }
                }

                ?>





                <div class="col-md-12 col-lg-12">
                    <div class="card mg-b-20">
                        <div class="card-header">
                            <h4 class="card-header-title">
                        <span class="tx-14 tx-md-24 tx-dark">订单详细信息</span>
                            </h4>
                            <div class="card-header-btn">
                                <a href="" data-toggle="collapse" class="btn card-collapse" data-target="#collapse4" aria-expanded="true"><i class="ion-ios-arrow-down"></i></a>
                                <a href="" data-toggle="refresh" class="btn card-refresh"><i class="ion-android-refresh"></i></a>
                                <a href="" data-toggle="expand" class="btn card-expand"><i class="ion-android-expand"></i></a>
                                <a href="" data-toggle="remove" class="btn card-remove"><i class="ion-android-close"></i></a>
                            </div>
                        </div>
                        <form action=<?php echo ((!$acc_mc)&&!$acc1)?"admin_order_update.php":"";?> method="post" id="1">
                            <div class="card-body collapse show" id="collapse4">
                                <div class="row">
                                    <div class="col-xl-6">
                                        <div class="form-layout form-layout-4">
                                            <h4 class="tx-gray-800 tx-uppercase tx-bold tx-14 tx-md-24 tx-dark mg-b-10 "><?php echo $title1;?></h4>
                                            <p class="mg-b-30 tx-gray-600">订单参数.</p>
                                            <div class="row">
                                                <label class="col-sm-4 form-control-label tx-14 tx-md-24 tx-dark">订单序号: <span class="tx-danger">*</span></label>
                                                <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                                    <input type="text" formid="1" class="tx-14 tx-md-24 tx-dark" name="ord_id" value="<?php echo $ord_id ?>" readonly>
                                                </div>
                                            </div>
                                            <!-- row -->
                                            <div class="row mg-t-20">
                                                <label class="col-sm-4 form-control-label tx-14 tx-md-24 tx-dark">机器编号: <span class="tx-danger">*</span></label>
                                                <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                                    <input type="text" formid="1" class="tx-14 tx-md-24 tx-dark" name="mac_id" value="<?php echo $mac_id; ?>" readonly>
                                                </div>
                                            </div>
                                            <div class="row mg-t-20">
                                                <label class="col-sm-4 form-control-label tx-14 tx-md-24 tx-dark">机器功能: <span class="tx-danger">*</span></label>
                                                <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                                    <input type="text" formid="1" class="tx-14 tx-md-24 tx-dark" value="<?php echo $func; ?>" readonly>
                                                </div>
                                            </div>
                                            <div class="row mg-t-20">
                                                <label class="col-sm-4 form-control-label tx-14 tx-md-24 tx-dark">下单日期: <span class="tx-danger">*</span></label>
                                                <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                                    <input type="date" formid="1" class="tx-14 tx-md-24 tx-dark" value="<?php echo $ord_date; ?>" readonly>
                                                </div>
                                            </div>
                                            <div class="row mg-t-20">
                                                <label class="col-sm-4 form-control-label tx-14 tx-md-24 tx-dark">租金: <span class="tx-danger">*</span></label>
                                                <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                                    <input type="text" formid="1" class="tx-14 tx-md-24 tx-dark" value="<?php echo $value; ?>" readonly>
                                                </div>
                                            </div>
                                            <?php 
                                            if(!$acc1){
                                                
                                            echo "<div class=\"row mg-t-20\">\n";
                                            echo "<label class=\"col-sm-4 form-control-label tx-14 tx-md-24 tx-dark\">机器状态: <span class=\"tx-danger\"></span></label>";
                                            echo "<div class=\"col-sm-8 mg-t-10 mg-sm-t-0\">";
                                            echo "<input type=\"text\" class=\"tx-14 tx-md-24 tx-dark\" value=\"" .  ($row['lent'] ? "工作中" :($row['repaired']?"修理中":"未工作")) ."\" readonly>";
                                            echo "</div></div>";}
                                            ?>
                                            <!-- form-layout-footer -->
                                        </div>
                                        <!-- form-layout -->

                                    </div>
                                    <!-- col-6 -->
                                    <div class="col-xl-6 mg-t-20 mg-xl-t-0">
                                        <div class="form-layout form-layout-5">
                                            <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 tx-md-24 tx-dark mg-b-10"><?php echo $title2;?></h6>
                                            <p class="mg-b-30 tx-gray-600">审核参数.</p>
                                            
                                            <div class="row">
                                                <label class="col-sm-4 form-control-label tx-14 tx-md-24 tx-dark"><span class=" tx-<?php echo $col1;?>">*</span> 审批状态:</label>
                                                <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                                    <input type="text" formid="1" class="tx-14 tx-md-24 tx-<?php echo $col1;?>" value="<?php echo $acc2; ?>" readonly>
                                                </div>
                                            </div>
                                            <div class="row mg-t-20">
                                                <label class="col-sm-4 form-control-label tx-14 tx-md-24 tx-dark"><span class=" tx-<?php echo $col1;?>">*</span> 租户名</label>
                                                <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                                    <input type="text" formid="1" class="tx-14 tx-md-24 tx-dark  value="<?php echo $user_name;?>" readonly>
                                                </div>
                                            </div>

                                            <div class="row mg-t-20">
                                                <label class="col-sm-4 form-control-label tx-14 tx-md-24 tx-dark"><span class=" tx-<?php echo $col1;?>">*</span> 租户手机号:</label>
                                                <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                                    <input type="text" formid="1" class="tx-14 tx-md-24 tx-dark" value="<?php echo $phone;?>" readonly>
                                                </div>
                                            </div>
                                                <div class="row mg-t-20">
                                                    <label class="col-sm-4 form-control-label tx-14 tx-md-24 tx-dark"><span class=" tx-<?php echo $col1;?>">*</span> 审批结果:</label>
                                                        <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                                            <select name="acc_update" class="tx-14 tx-md-24 tx-dark" required>
                                                                <?php if($acc1) {echo "<option>";echo $acc1==1?"已通过":"已拒绝"; echo "</option>";}
                                                                    else  
                                                                    {   echo "<option value=1 " ;echo ($acc1==1)?"selected=\"selected\"":""; echo ">通过</option>\n";
                                                                      echo "<option value=2 "  ;echo ($acc1==2)?"selected=\"selected\"":""; echo ">拒绝</option>\n";
                                                                      echo "<option value=0 "  ;echo ($acc1==0)?"selected=\"selected\"":""; echo ">未审核</option>" ;
                                                                    }?>
                                                            </select>
                                                         </div>
                                                </div>

                                                
                                                                

                                            <div class="row mg-t-20">
                                                <label class="col-sm-4 form-control-label tx-14 tx-md-24 tx-dark"><span class=" tx-<?php echo $col2;?>">*</span> 归还状态:</label>
                                                <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                                    <input type="text" formid="1" class="tx-14 tx-md-24 tx-<?php echo $col2;?>" name="user_ret" value="<?php echo $user_ret;?>" <?php echo (!$acc1)?"":"readonly"?>>
                                                </div>
                                            </div>
                                            <div class="row mg-t-20">
                                                <label class="col-sm-4 form-control-label tx-14 tx-md-24 tx-dark"><span class=" tx-<?php echo $col2;?>">*</span> 归还订单:</label>
                                                <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                                    <input type="text" formid="1" class="tx-14 tx-md-24 tx-<?php echo $col2;?>" value="<?php echo $ret_id; ?>" readonly>
                                                </div>
                                            </div>


                                            <!-- <?php if(!$acc_mc && !$acc) echo "<p><input type = \"submit\" value = \"上传审批结果\" name = \"admin_sub_order\"></p>"; ?> -->
                                            <!-- row -->
                                            <div class="row mg-t-30">
                                                <div class="col-sm-8 mg-l-auto">
                                                    <div class="form-layout-footer">
                                                        <?php 
                                                        if(!$acc1 && !$acc_mc &&!$row['repaired'])
                                                        echo "<input type=\"submit\" formid=\"1\" class=\"btn btn-custom-primary\" name=\"admin_sub_order\" value=\"上传审批结果\">\n
                                                        <button class=\"btn btn-secondary\">Cancel</button>\n";?>
                                                    </div>
                                                    <!-- form-layout-footer -->
                                                </div>
                                                <!-- col-8 -->
                                            </div>
                                        </div>
                                        <!-- form-layout -->
                                    </div>
                                    <!-- col-6 -->
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!--/ Label Alignment Form End -->
                <!--================================-->
            </div>
            <!--================================-->

            <!--/ Page Inner End -->



            <!--================================-->
            <!--================================-->
            <!-- Page Footer Start -->
            <!--================================-->
            <footer class="page-footer">
                <div class="pd-t-4 pd-b-0 pd-x-20">
                    <div class="tx-10 tx-uppercase">
                        <p class="pd-y-10 mb-0">Copyright&copy; 2019 | All rights reserved. | Created By <a href="http://www.bootstrapmb.com/" target="_blank">ColorlibCode</a></p>
                    </div>
                </div>
            </footer>
            <!--/ Page Footer End -->
        </div>
        <!--/ Page Content End -->
    </div>
    <!--/ Page Container End -->
    <!--================================-->

    <!--================================-->
    <!-- Footer Script -->
    <!--================================-->
    <script src="assets/plugins/jquery/jquery.min.js"></script>
    <script src="assets/plugins/jquery-ui/jquery-ui.js"></script>
    <script src="assets/plugins/popper/popper.js"></script>
    <script src="assets/plugins/feather-icon/feather.min.js"></script>
    <script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/plugins/pace/pace.min.js"></script>
    <script src="assets/plugins/toastr/toastr.min.js"></script>
    <script src="assets/plugins/countup/counterup.min.js"></script>
    <script src="assets/plugins/waypoints/waypoints.min.js"></script>
    <script src="assets/plugins/chartjs/chartjs.js"></script>
    <script src="assets/plugins/apex-chart/apexcharts.min.js"></script>
    <script src="assets/plugins/apex-chart/irregular-data-series.js"></script>
    <script src="assets/plugins/simpler-sidebar/jquery.simpler-sidebar.min.js"></script>
    <script src="assets/js/dashboard/sales-dashboard-init.js"></script>
    <script src="assets/js/jquery.slimscroll.min.js"></script>
    <script src="assets/js/highlight.min.js"></script>
    <script src="assets/js/app.js"></script>
    <script src="assets/js/custom.js"></script>
</body>

</html>