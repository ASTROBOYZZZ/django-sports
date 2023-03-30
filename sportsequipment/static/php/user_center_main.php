<!DOCTYPE html>
<html lang="zxx">
   <head>
      <!-- The above 6 meta tags *must* come first in the head; any other head content must come *after* these tags -->
      <meta charset="utf-8">
      <meta http-equiv="x-ua-compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="description" content="">
      <meta name="keyword" content="">
      <meta name="author"  content=""/>
      <!-- Page Title here to disign -->
      <title>用户中心 | Joy Machine Info Manage Center</title>
      <!-- Main CSS -->			
      <link type="text/css" rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.min.css"/>
      <link type="text/css" rel="stylesheet" href="assets/plugins/font-awesome/css/font-awesome.min.css"/>
      <link type="text/css" rel="stylesheet" href="assets/plugins/flag-icon/flag-icon.min.css"/>
      <link type="text/css" rel="stylesheet" href="assets/plugins/simple-line-icons/css/simple-line-icons.css">
      <link type="text/css" rel="stylesheet" href="assets/plugins/ionicons/css/ionicons.css">
      <link type="text/css" rel="stylesheet" href="assets/plugins/toastr/toastr.min.css">
      <link type="text/css" rel="stylesheet" href="assets/plugins/chartist/chartist.css">
      <link type="text/css" rel="stylesheet" href="assets/plugins/apex-chart/apexcharts.css">
      <link type="text/css" rel="stylesheet" href="assets/css/app.min.css"/>
      <link type="text/css" rel="stylesheet" href="assets/css/style.min.css"/>
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
    setrawcookie('userName', $user_name);
    setrawcookie('userPhone', $user_phone);


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
                           <li class="active"><a href="user_center_main.php">概览</a></li>
                           <li><a href="machine_info.php?mac_id=0">农机信息</a></li>
                           <li><a href="user_order_info.php?ord_id=0">订单信息</a></li>
                           <li><a href="user_return_info.php?ret_id=0">还单信息</a></li>

                           
                           
                        </ul>
                     </li>
                     <li>
                        <a href=""><i data-feather="mail"></i>
                        <span>农机工作信息</span><span class="badge badge-warning ft-right">10+</span></a>
                        <ul class="sub-menu">
                           <li><a href="machine_work_center.php">信息中心</a></li>
                           
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
                        <input class="form-control search-input" name="search" placeholder="Type something..." type="text"/>
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
                        <li class="list-inline-item align-middle"><a  href="#" id="search-button"><i class="ion-ios-search-strong tx-20"></i></a></li>
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
                           <a  href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="select-profile">Hi, <?php echo $user_name;?>!</span><img src="assets/images/avatar-placeholder.png"" class="img-fluid wd-35 ht-35 rounded-circle" alt=""></a>
                           <div class="dropdown-menu dropdown-menu-right dropdown-profile shadow-2">
                              <div class="user-profile-area">
                                 <div class="user-profile-heading">
                                    <div class="profile-thumbnail">
                                       <img src="https://via.placeholder.com/100x100" class="img-fluid wd-35 ht-35 rounded-circle" alt="">
                                    </div>
                                    <div class="profile-text">
                                       <h6><?php echo $user_name?></h6>
                                       <span><?php echo $user_phone?></span>
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
                        <h1 class="pd-0 mg-0 tx-20">概览</h1>
                     </div>
                     <div class="breadcrumb pd-0 mg-0">
                        <a class="breadcrumb-item" href="index.html"><i class="icon ion-ios-home-outline"></i> Home</a>
                        <a class="breadcrumb-item" href="">Dashboard</a>
                        <!-- here to design -->
                        <span class="breadcrumb-item active">概览</span>
                     </div>
                  </div>
                  <!--/ Breadcrumb End -->
                  <!--================================-->
                </div>
                <!--/ Main Wrapper End -->
                <!-- 机器概况 Start -->
                     <!--================================--> 
                     <div class="col-sm-12 col-xl-12">
                        <div class="card mg-b-20">
                           <div class="card-header">
                              <h4 class="class-header-title tx-20 tx-sm-18 tx-md-24 mg-b-0 tx-normal tx-rubik tx-dark">
                                 机器概况
                              </h4>
                              <div class="card-header-btn">
                                 <a  href="#" data-toggle="collapse" class="btn card-collapse" data-target="#productSalesDetails1" aria-expanded="true"><i class="ion-ios-arrow-down"></i></a>
                                 <a href="#" data-toggle="refresh" class="btn card-refresh"><i class="ion-android-refresh"></i></a>
                                 <a href="#" data-toggle="expand" class="btn card-expand"><i class="ion-android-expand"></i></a>
                                 <a href="#" data-toggle="remove" class="btn card-remove"><i class="ion-ios-trash-outline"></i></a>
                              </div>
                           </div>
                           <div class="card-body pd-0 collapse show" id="productSalesDetails1">
                              <div>
                                 <div class="table-responsive">
                                    <table class="table table-hover mb-0">
                                       <thead class="tx-dark tx-10 tx-bold">
                                          <tr>
                                             <th class="tx-center tx-14 tx-md-24 tx-dark ">机器名称</th>
                                             <!-- <th class="tx-center tx-md-24 tx-sm-15 tx-dark ">编号</th> -->
                                             <th class="tx-center tx-14 tx-md-24 tx-dark ">功能</th>
                                             <!-- <th class="tx-center tx-md-24 tx-sm-15 tx-dark ">购置日期</th> -->
                                             <th class="tx-center tx-14 tx-md-24 tx-dark ">农机状态</th>
                                          </tr>
                                       </thead>
                                       <tbody>
                                          <?php
                                                //link
                                                $conn = mysqli_connect('localhost','low_user','user123');
                                                if($conn){
                                                    //link success
                                                    echo "<script language='JavaScript'>alert('个人中心');</script>";
                                                    $sql_select = "select * from misaki_joy.machine";
                                                        //set code 
                                                    mysqli_query($conn,'SET NAMES UTF8');
                                            
                                                    //生成农机信息表
                                                    $sql_return = mysqli_query($conn, $sql_select);
                                                    // $row = mysqli_fetch_array($sql_return);
                                                    if($sql_return)
                                                    {
                                                        while($row = mysqli_fetch_array($sql_return))
                                                        {
                                                            $lent1 = $row['lent']?"使用中":($row['repaired']?"修理中":"可租用");
                                                            $lent_col = $row['lent']?"warning":($row['repaired']?"danger":"success");
                                                            $repair1 = $row['repaired']?"修理中":"未修理";
                                                            $loc = "<a href='machine_info.php?mac_id=" . $row['id'] . "'>" . $row['name'] ;
                                                            $loca = "<a href='machine_info.php?mac_id=" . $row['id'] . "'>";
                                                            echo "<tr>\n";
                                                            echo "<td class=\"tx-center tx-14 tx-md-24 tx-dark\">" . $loc . "</a></td>\n";
                                                            // echo "<td class=\"tx-center tx-md-20 tx-sm-15 tx-purple\">" . $row['ser_num'] . "</td>\n";
                                                            echo "<td class=\"tx-center tx-14 tx-md-24 tx-dark\">" . $loca . $row['func'] . "</td>\n";
                                                            // echo "<td class=\"tx-center tx-md-20 tx-sm-15 tx-info\">" . $row['date'] . "</td>\n";
                                                            echo "<td class=\"tx-center tx-14 tx-md-24 tx-dark\"><span class=\" badge  badge-outlined badge-" .$lent_col . "\">" . $lent1 . "</span></td>\n";
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
                     <!--/ Product Sales Details Start -->
                     <!--================================-->

                     <!-- 订单概况 Start -->
                     <!--================================--> 
                     <div class="col-sm-12 col-xl-12">
                        <div class="card mg-b-20">
                           <div class="card-header">
                              <h4 class="card-header-title"><span class=" tx-14 tx-md-24 ">
                                 订单概况
                              </span></h4>
                              <div class="card-header-btn">
                                 <a  href="#" data-toggle="collapse" class="btn card-collapse" data-target="#productSalesDetails2" aria-expanded="true"><i class="ion-ios-arrow-down"></i></a>
                                 <a href="#" data-toggle="refresh" class="btn card-refresh"><i class="ion-android-refresh"></i></a>
                                 <a href="#" data-toggle="expand" class="btn card-expand"><i class="ion-android-expand"></i></a>
                                 <a href="#" data-toggle="remove" class="btn card-remove"><i class="ion-ios-trash-outline"></i></a>
                              </div>
                           </div>
                           <div class="card-body pd-0 collapse show" id="productSalesDetails2">
                              <div>
                                 <div class="table-responsive">
                                    <table class="table table-hover mb-0">
                                       <thead class="tx-dark tx-uppercase tx-10 tx-bold">
                                          <tr>
                                             <th class="tx-center tx-14 tx-md-24">订单序号</th>
                                             <th class="tx-center tx-14 tx-md-24">机器编号</th>
                                             <!-- <th class="tx-center">申请时间</th> -->
                                             <th class="tx-center tx-14 tx-md-24 ">租金</th>
                                             <th class="tx-center tx-14 tx-md-24 ">审批状态</th>
                                             <th class="tx-center tx-14 tx-md-24">归还状态</th>
                                             <th class="tx-center tx-14 tx-md-24">归还单号</th>
                                          </tr>
                                       </thead>
                                       <tbody>
                                          <?php
                                                $cnt = 0;
                                                $return_id_arr = Array();
                                                //link
                                                $conn = mysqli_connect('localhost','low_user','user123');
                                                if($conn){
                                                    //link success
                                                    $sql_select = "select * from misaki_joy.order where misaki_joy.order.phone = $user_phone";
                                                        //set code 
                                                    mysqli_query($conn,'SET NAMES UTF8');
                                            
                                                    //生成农机信息表
                                                    $sql_return = mysqli_query($conn, $sql_select);
                                                    // $row = mysqli_fetch_array($sql_return);
                                                    if($sql_return)
                                                    {
                                                        while($row = mysqli_fetch_array($sql_return))
                                                        {
                                                            $loc_acc = $acc1 = "<a href = 'user_order_info.php?ord_id=". $row['id'] . "'>";// 已通过</a>";
                                                            $acc1 = $acc1 . ($row['accept']?($row['accept']==1?"已通过":"已拒绝"):"未审核") .  "</a>";
                                                            $lent_col = ($row['accept']?($row['accept']==1?"success":"danger"):"warning");
                                                            $ret_col = "warning";
                                                            $ret1 = "-";
                                                            if($row['accept']==1){
                                                               switch($row['ret']){
                                                                  case "1": $ret1 = "还单审核中";break;
                                                                  case "2": $ret1 = "还单已通过";$ret_col="success";break;
                                                                  case "3": $ret1 = "还单被拒绝";$ret_col="danger";break;
                                                                  case "4": $ret1 = "还单已失效";$ret_col="danger";break;
                                                                  default: $ret1 = "-";
                                                              }   
                                                            }
                                                            
                                                            if($row['ret']) {$cnt++;$return_id_arr[$cnt] = $row['ret_id'];}
                                                            echo "<tr>\n";
                                                            
                                                            echo "<td class=\"tx-center tx-14 tx-md-24 \">" . "<a href = 'user_order_info?ord_id=". $row['id'] . "'>" . $row['id'] . "</a></td>";
                                                            echo "<td class=\"tx-center  tx-14 tx-md-24  tx-dark\">" . "<a href = 'machine_info?mac_id=". $row['mac_id'] . "'>" .$row['mac_id'] . "</a></td>";
                                                            // echo "<td class=\"tx-center tx-pink\">" . $row['date'] . "</td>";
                                                            echo "<td class=\"tx-center tx-14 tx-md-24  tx-info\">" . "<span>" . $row['value'] . "</span>" . "</td>";
                                                            echo "<td class=\"tx-center tx-14 tx-md-24 \"><span class=\"badge badge-outlined badge-" .$lent_col . "\">" . $acc1 . "</span></td>\n";
                                                            echo "<td class=\"tx-center tx-14 tx-md-24 \"><span class=\" badge badge-outlined badge-" .$ret_col . "\">" . $ret1 . "</span></td>\n";
                                                            echo "<td class=\"tx-center tx-14 tx-md-24 \">" . ($row['ret']?$row['ret_id']:$ret1) . "</td>";

                                                            
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
                     <!--/ Product Sales Details Start -->
                     <!--================================-->
                     <!-- 还单概况 Start -->
                     <!--================================--> 
                     <div class="col-sm-12 col-xl-12">
                        <div class="card mg-b-20">
                           <div class="card-header">
                              <h4 class="card-header-title ">
                                 <span class="tx-14  tx-md-24 tx-dark">还单概况</span>
                              </h4>
                              <div class="card-header-btn">
                                 <a  href="#" data-toggle="collapse" class="btn card-collapse" data-target="#productSalesDetails3" aria-expanded="false"><i class="ion-ios-arrow-down"></i></a>
                                 <a href="#" data-toggle="refresh" class="btn card-refresh"><i class="ion-android-refresh"></i></a>
                                 <a href="#" data-toggle="expand" class="btn card-expand"><i class="ion-android-expand"></i></a>
                                 <a href="#" data-toggle="remove" class="btn card-remove"><i class="ion-ios-trash-outline"></i></a>
                              </div>
                           </div>
                           <div class="card-body pd-0 collapse show" id="productSalesDetails3">
                              <div>
                                 <div class="table-responsive">
                                    <table class="table table-hover mb-0">
                                       <thead class="tx-dark tx-uppercase tx-10 tx-bold">
                                          <tr>
                                             <th class="tx-center tx-14 tx-md-24 ">还单序号</th>
                                             <th class="tx-center tx-14 tx-md-24 ">关联订单</th>
                                             <th class="tx-center tx-14 tx-md-24 ">关联农机</th>
                                             <th class="tx-center tx-14 tx-md-24 ">申请时间</th>
                                             <th class="tx-center tx-14 tx-md-24 ">工作面积</th>
                                             <th class="tx-center tx-14 tx-md-24 ">审批状态</th>
                                          </tr>
                                       </thead>
                                       <tbody>
                                          <?php
                                                //link
                                                $conn = mysqli_connect('localhost','low_user','user123');
                                                if($conn){
                                                    //link success
                                                    $sql_select = "select * from misaki_joy.return";
                                                        //set code 
                                                    mysqli_query($conn,'SET NAMES UTF8');
                                                   sort($return_id_arr);
                                                   $i = 1;
                                                    //生成农机信息表
                                                    $sql_return = mysqli_query($conn, $sql_select);
                                                    // $row = mysqli_fetch_array($sql_return);
                                                    if($sql_return)
                                                    {
                                                       //echo "446";
                                                        while($cnt && $row = mysqli_fetch_array($sql_return))
                                                        { //echo "i:$cnt\n 448\n row[id]:".$row['id']." return_arr:$return_id_arr[$i];\n";
                                                            if($i < $cnt && $row['id'] != $return_id_arr[$i]) continue;
                                                            $i++;
                                                            $ret1 = "";
                                                            $ret_col = "warning";
                                                            switch($row['accept']){
                                                                case "1": $ret1 = "审核中";break;
                                                                case "2": $ret1 = "已通过";$ret_col="success";break;
                                                                case "3": $ret1 = "被拒绝";$ret_col="danger";break;
                                                                case "4": $ret1 = "已失效";$ret_col="danger";break;
                                                                default: $ret1 = "-";
                                                            }
                                                            echo "<tr>\n";
                                                            
                                                            echo "<td class=\"tx-center tx-14 tx-md-24 tx-dark\">" . "<a href = 'user_return_info?ret_id=". $row['id'] . "'>" . $row['id'] . "</a></td>";
                                                            echo "<td class=\"tx-center tx-14 tx-md-24 \">" . "<a href = 'user_order_info?ord_id=". $row['ord_id'] . "'>" . $row['ord_id'] . "</a></td>";
                                                            echo "<td class=\"tx-center  tx-14 tx-md-24  tx-dark\">" . "<a href = 'machine_info?mac_id=". $row['mac_id'] . "'>" .$row['mac_id'] . "</a></td>";
                                                            echo "<td class=\"tx-center tx-14 tx-md-24 tx-info\">" . $row['date'] . "</td>";
                                                            echo "<td class=\"tx-center tx-14 tx-md-24 \">" . $row['area'] . "</td>";
                                                            echo "<td class=\"tx-center tx-14 tx-md-24 tx-dark \"><span class=\"badge badge-outlined badge-" .$ret_col . "\">" . $ret1 . "</span></td>\n";

                                                            
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
                     <!--/ Product Sales Details Start -->
                     <!--================================-->
                     

            </div>
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