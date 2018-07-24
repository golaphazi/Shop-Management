<!DOCTYPE html>
<?php
$comp = $this->shop->company_info();

 $logo = 'logo.png';
 $name = 'Shop Management';
 if(is_array($comp)){ 
	 $logo = $comp['COMPANY_LOGO']; 
	 $name = $comp['COMPANY_NAME'];
}
$userInfo = $this->shop->user_info();
$userName = 'User';
$userEmail = '';
if(is_array($userInfo)){
	$userName = $userInfo['USER_NAME'];
	$userEmail = $userInfo['USER_EMAIL'];
}
 ?>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <meta name="description" content="">
  <meta name="author" content="">
 
  <link rel="icon" href="<?= base_url();?>assets/images/<?= $logo;?>">
  <title><?= $name; ?></title>

  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.min.css');?>">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo base_url('assets/css/ionicons.min.css'); ?>">
  <!-- DataTables -->
    <link rel="stylesheet" href="<?php echo base_url('assets/css/dataTables.bootstrap.css');?>">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url('assets/css/AdminLTE.min.css');?>">
 
    <link rel="stylesheet" href="<?php echo base_url('assets/css/skins/skin-black-light.min.css');?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/skins/skin-black-light.css');?>">
   
    <link rel="stylesheet" href="<?php echo base_url('assets/css/custom.css');?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/select/sol.css');?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/css/buttons.dataTables.min.css'); ?>">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/daterangepicker.css'); ?>" />

<script src="<?php echo base_url('assets/js/jquery.min.js'); ?>"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?php echo base_url('assets/js/jquery-ui.min.js'); ?>"></script>
<script>
var url = '<?= base_url();?>';
//alert(url);
</script>
  </head>
    <body class="hold-transition skin-black-light sidebar-collapse" data-base-url="<?php echo base_url(); ?>">
        <div class="wrapper">
			
          <header class="main-header">
            <a href="<?php echo base_url(); ?>" class="logo">
            
              <!-- mini logo for sidebar mini 50x50 pixels -->
              <span class="logo-mini"><img src="<?php echo base_url().'assets/images/'.$logo; ?>" alt="<?=  $name;?>" id="logo"></span>
              <!-- logo for regular state and mobile devices -->
              <span class="logo-lg"><img src="<?php echo base_url().'assets/images/'.$logo; ?>" alt="<?=  $name;?>"  id="logo"></span>
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top">
            <!-- Sidebar toggle button-->
                <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                </a>
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <!-- Control Sidebar Toggle Button -->
						  <li> 
								<a href="<?php echo base_url('dashboard');?>"> <i class="fa fa-dashboard"></i></a>
						</li>
						 <?php $this->load->view("include/menu_header");?> 
                       
                        <li class="dropdown user user-menu">
                          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                               <?php 
								 $profile_pic =  'user.png';
								?>
                              <img src="<?php echo base_url().'assets/images/'.$profile_pic;?>"  class="user-image" alt="User Image">
                            <span class="hidden-xs"><?= $userName;?></span>
                          </a>
                          <ul class="dropdown-menu" role="menu" style="width: 164px;">
                              <li><a href="<?php echo base_url('dashboard/myaccount');?>"><i class="fa fa-user mr10"></i>My Account</a></li>
                              <li class="divider"></li>
                              <li><a href="<?php echo base_url('login/logout');?>"><i class="fa fa-power-off mr10"></i> Sign Out</a></li>
                          </ul>
                        </li>
                    </ul>
                </div>
            </nav>
          </header>
          <!-- Left side column. contains the logo and sidebar -->
		  
		  <aside class="main-sidebar">
            <!-- sidebar: style can be found in sidebar.less -->
            <section class="sidebar">
              <h4 class="company_name"><?= $name;?></h4>
              <ul class="sidebar-menu">
                <li class="header"><!-- MAIN NAVIGATION --></li>
                
                <li class="<?=($this->router->method==="dashboard")?"active":"not-active"?>"> 
					<a href="<?php echo base_url('dashboard');?>"> <i class="fa fa-dashboard"></i> <span>Dashboard</span></a>
                </li>                
                <?php $this->load->view("include/menu");?> 
              </ul>
            </section>
            <!-- /.sidebar -->
          </aside>  
         
<style>
.progress-main-div1 {
    padding-top: 10px;
    background-color: rgb(232, 82, 15);
    position: fixed;
    bottom: 21px;
    z-index: 50;
    width: 50%;
    padding-bottom: 10px;
    color: white;
    text-align: center;
    margin-left: 34%;
    margin-bottom: 19px;
}
.progress-main-div1 a{
    color:#04046e;;
}
</style>      
