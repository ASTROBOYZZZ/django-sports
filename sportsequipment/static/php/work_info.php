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
    <title>作业信息查看 | Joy Machine Info Manage Center</title>
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
$user_name = test_input($_COOKIE["userName"]);
$user_phone = test_input($_COOKIE["userPhone"]);
$work_id = test_input($_GET["work_id"]);
setrawcookie('userName', $user_name);
setrawcookie('userPhone', $user_phone);
// setrawcookie('work_id', $mac_id);

if ($work_id == 0) {
    header('location:machine_info_search.php');
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
                                <li><a href="user_center_main.php">概览</a></li>
                                <li><a href="machine_info.php?mac_id=0">农机信息</a></li>
                                <li><a href="user_order_info.php?ord_id=0">订单信息</a></li>
                                <li><a href="user_return_info.php?ret_id=0">还单信息</a></li>

                                
                            </ul>
                        </li>
                        <li>
                            <a href=""><i data-feather="mail"></i>
                            <span>农机工作信息</span><span class="badge badge-warning ft-right">10+</span></a>
                            <ul class="sub-menu">
                                <li class="active"><a href="machine_work_center.php">信息中心</a></li>
                                
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
                                <a href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="select-profile">Hi, <?php echo $user_name; ?>!</span><img src="assets/images/avatar-placeholder.png"" class=" img-fluid wd-35 ht-35 rounded-circle" alt=""></a>
                                <div class="dropdown-menu dropdown-menu-right dropdown-profile shadow-2">
                                    <div class="user-profile-area">
                                        <div class="user-profile-heading">
                                            <div class="profile-thumbnail">
                                                <img src="https://via.placeholder.com/100x100" class="img-fluid wd-35 ht-35 rounded-circle" alt="">
                                            </div>
                                            <div class="profile-text">
                                                <h6><?php echo $user_name; ?></h6>
                                                <span><?php echo $user_phone; ?></span>
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
                            <h1 class="pd-0 mg-0 tx-20">作业信息</h1>
                        </div>
                        <div class="breadcrumb pd-0 mg-0">
                            <a class="breadcrumb-item" href="index.html"><i class="icon ion-ios-home-outline"></i> Home</a>
                            <a class="breadcrumb-item" href="">农机工作信息</a>
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
                $conn = mysqli_connect('localhost', 'low_user', 'user123');
                if ($conn) {
                    //link success
                    $sql_select = "select * from misaki_joy.machine_work where id = $work_id";
                    //set code 
                    mysqli_query($conn, 'SET NAMES UTF8');

                    //生成农机信息表
                    $sql_return = mysqli_query($conn, $sql_select);

                    if ($sql_return) {
                        $row = mysqli_fetch_array($sql_return);

                        if ($row == NULL) {
                            echo "<script type=" . "\"" . "text/javascript" . "\"" . ">" . "window.alert" . "(" . "\"" . "非法的查询" . "\"" . ")" . ";" . "</script>";
                            echo "<script type=" . "\"" . "text/javascript" . "\"" . ">" . "window.location=" . "\"" . "machine_info_search.html" . "\"" . "</script>";
                            exit;
                        }
                        $mac_id = $row['mac_id'];
                        $loc_num = $row['loc_num'];
                        $loc_txt = $row['loc_txt'];
                        $ret_area = $row['ret_area'];
                        $ret_id = $row['ret_id'];
                        $ord_date = $row['ord_date'];
                        $ret_date = $row['ret_date'];
                        $phone = $row['phone'];
                    }
                }

                ?>





                    <div class="col-sm-12 col-xl-12">
                        <div class="card mg-b-20">
                           <div class="card-header">
                              <h4 class="card-header-title">
                                 作业信息
                              </h4>
                              <div class="card-header-btn">
                                 <a  href="#" data-toggle="collapse" class="btn card-collapse" data-target="#productSalesDetails" aria-expanded="true"><i class="ion-ios-arrow-down"></i></a>
                                 <a href="#" data-toggle="refresh" class="btn card-refresh"><i class="ion-android-refresh"></i></a>
                                 <a href="#" data-toggle="expand" class="btn card-expand"><i class="ion-android-expand"></i></a>
                                 <a href="#" data-toggle="remove" class="btn card-remove"><i class="ion-ios-trash-outline"></i></a>
                              </div>
                           </div>
                           <div class="card-body pd-0 collapse show" id="productSalesDetails">
                              <div>
                                 <div class="table-responsive">
                                    <table class="table table-hover mb-0">
                                       <thead class="tx-dark tx-uppercase tx-10 tx-bold">
                                          <tr>
                                             <th class="tx-center tx-14  tx-md-20 tx-dark">作业序号</th>
                                             <th class="tx-center tx-14  tx-md-20 tx-dark">机器编号</th>
                                             <th class="tx-center tx-14  tx-md-20 tx-dark">开始作业时间</th>
                                             <th class="tx-center tx-14  tx-md-20 tx-dark">结束作业时间</th>
                                             <th class="tx-center tx-14  tx-md-20 tx-dark">作业地点</th>
                                             <th class="tx-center tx-14  tx-md-20 tx-dark">作业面积</th>
                                          </tr>
                                       </thead>
                                       <tbody>
                                          <?php

                                                $loc_work = Array();
                                                $loc_work[1][1] = "";//1 经纬度 2 编号 3日期 4 路径点
                                                $cnt = 0;
                                                $num = Array();
                                                $id = Array();
                                                $map_center = "";
                                                //link
                                                $conn = mysqli_connect('localhost','low_user','user123');
                                                if($conn){
                                                    //link success
                                                    // echo "<script language='JavaScript'>alert('个人中心');</script>";
                                                    $sql_select = "select * from misaki_joy.machine_work where id = $work_id";
                                                        //set code 
                                                    mysqli_query($conn,'SET NAMES UTF8');
                                            
                                                    //生成农机信息表
                                                    $sql_return = mysqli_query($conn, $sql_select);
                                                    // $row = mysqli_fetch_array($sql_return);
                                                    if($sql_return)
                                                    {
                                                        while($row = mysqli_fetch_array($sql_return))
                                                        {
                                                            $cnt++;
                                                            $loc_work[$cnt][1] = "";
                                                            $num[$cnt] = $row['loc_num'];
                                                            $id[$cnt] = $row['id'];
                                                            $s = $row['loc_txt'] . "\r\n";
                                                            $len = strlen($s);
                                                            // echo $len;
                                                            $i = 0;//字符串指针  计数器  loc指针
                                                            $li = 1;
                                                            for(; $i < $len ; $i++) {
                                                                $ti = $cnt_p = 0; // 写入指针 特殊字符计数器
                                                                $k = $i;
                                                                //写入一个 
                                                                $loc_work[$cnt][$li] = "";
                                                               for(; $s[$k] != "\r" && $s[$k] != "\n"; $k++) {
                                                                   $loc_work[$cnt][$li][$ti] = $s[$k];
                                                                   if($s[$k] < "0" || $s[$k] > "9"){
                                                                       $loc_work[$cnt][$li][$ti] = ".";
                                                                       
                                                                       $cnt_p++;
                                                                       if($cnt_p == 2)
                                                                            $loc_work[$cnt][$li][$ti] = "|";
                                                                   }
                                                                   $ti++;
                                                               }
                                                            //    for($w = 1; $w <= $li; $w++)
                                                            //    echo $loc_work[$cnt][$li];
                                                               $li++;
                                                               // loc_work1  4 5 ... n = position
                                                               if($li == 2) {
                                                                   
                                                                   $map_center = $loc_work[$cnt][$li-1];
                                                                   for($w = 0; $w < $ti; $w++) if($map_center[$w] == "|") $map_center[$w] = ",";
                                                                   $li = 4;
                                                                }
                                                               //从k写回i
                                                               $i = $k;
                                                               for(; $i < $len && $s[$i] != "\n"; $i++);
                                                            }
                                                            // $tmp[$i]= 0;
                                                            $loc_work[$cnt][2] = $row['mac_id'];
                                                            $loc_work[$cnt][3] = $row['ord_date'];
                                                            $web_loc = "<a href='work_info.php?work_id=" . $row['id'] . "'>" . $row['id'] ;
                                                            echo "<tr>\n";
                                                            echo "<td class=\"tx-center tx-14  tx-md-24 tx-dark\">" . $web_loc . "</a></td>\n";
                                                            echo "<td class=\"tx-center tx-14  tx-md-24 tx-dark\">" . $loc_work[$cnt][2] . "</td>\n";
                                                            echo "<td class=\"tx-center tx-14  tx-md-24 tx-info\">" . $loc_work[$cnt][3] . "</td>\n";
                                                            echo "<td class=\"tx-center tx-14  tx-md-24 tx-info\">" . $row['ret_date'] . "</td>\n";
                                                            echo "<td class=\"tx-center tx-14  tx-md-24 tx-dark\">" . $loc_work[$cnt][1] . "</span></td>\n";
                                                            echo "<td class=\"tx-center tx-14  tx-md-24 tx-dark\">" . $row['ret_area'] ."</span></td>\n";
                                                            echo "</tr>\n";
                                                        }
                                                    } 
                                                }
                                          ?>
                                          
                                       </tbody>
                                    </table>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                <!--/ Label Alignment Form End -->
                <!--================================-->
                <div class="col-md-12 col-lg-12">
                        <div class="card mg-b-20">
                           <div class="card-header">
                              <h4 class="card-header-title">
                                 工作地点及路径展示
                              </h4>
                              <div class="card-header-btn">
                                 <a href="#" data-toggle="collapse" class="btn card-collapse" data-target="#collapse3" aria-expanded="true"><i class="ion-ios-arrow-down"></i></a>
                                 <a href="#" data-toggle="refresh" class="btn card-refresh"><i class="ion-android-refresh"></i></a>
                                 <a href="#" data-toggle="expand" class="btn card-expand"><i class="ion-android-expand"></i></a>
                                 <a href="#" data-toggle="remove" class="btn card-remove"><i class="ion-android-close"></i></a>
                              </div>
                           </div><?php if($cnt) include 'map.php'; else echo "<h4>该机器暂无工作记录</h4>";?>
                           
                        </div>
                     </div>
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