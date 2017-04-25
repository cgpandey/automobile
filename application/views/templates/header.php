<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php if(isset($title)): echo $title; else:?> Projectideasblog Service Center<?php endif?></title>
<meta name="keywords" content="Kashliwal Service Center" />
<meta name="description" content="Service Center Desktop App by PRPWEBS.com" />
<link href="<?=asset_url();?>css/templatemo_style.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="<?=asset_url();?>css/ddsmoothmenu.css" />
<script type="text/javascript" src="<?=asset_url();?>js/jquery.min.js"></script>
<script type="text/javascript" src="<?=asset_url();?>js/ddsmoothmenu.js"></script>
<script type="text/javascript">
ddsmoothmenu.init({
	mainmenuid: "templatemo_menu", //menu DIV id
	orientation: 'h', //Horizontal or vertical menu: Set to "h" or "v"
	classname: 'ddsmoothmenu', //class added to menu's outer DIV
	//customtheme: ["#1c5a80", "#18374a"],
	contentsource: "markup" //"markup" or ["container_id", "path_to_menu_file"]
})
</script>  
<?php 
if(isset($css_files)) { 
foreach($css_files as $file): ?>
    <link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
<?php endforeach; ?>
<?php foreach($js_files as $file): ?>
    <script src="<?php echo $file; ?>"></script>
<?php endforeach; 
}?>
 <?php $atts = array(
              'width'      => '800',
              'height'     => '600',
              'scrollbars' => 'yes',
              'status'     => 'yes',
              'resizable'  => 'yes',
              'screenx'    => '0',
              'screeny'    => '0'
            ); ?>
<style type='text/css'>
body
{
    font-family: Arial;
    font-size: 14px;
}
a {
    color: blue;
    text-decoration: none;
    font-size: 14px;
}
a:hover
{
    text-decoration: underline;
}
</style>
</head>
<body id="home">
<div id="templatemo_outer_wrapper">
    <div id="templatemo_wrapper">
    
        <div id="templatemo_header">
            <div id="site_title"><h1><a href="<?=base_url();?>">ProjectideasBlog.com Service Center</a></h1></div>
          	<div id="templatemo_menu" class="ddsmoothmenu">
                <ul>
                    <li><a href="<?=base_url();?>" class="selected"><span></span>Home</a></li>
                    <li><?php echo anchor('/examples/','Admin'); ?>
                    <ul>
                        <li><?php echo anchor_popup('/examples/products_management/add','Add Products', $atts); ?></li>
                        <li><?php echo anchor('/examples/products_management/','Manage Products'); ?></li>
                        <li><?php echo anchor('/examples/employees_management/', 'Employee'); ?></li>
                        <li><?php echo anchor('/examples/orders_management', 'Add Service'); ?></li>
                        <li><?php echo anchor('/examples/vendors_management','Vendors');  ?></li>
                        <li><?php echo anchor('/examples/purchase_management','Purchase');  ?></li>
                    </ul>
                    </li>
                    <li><?php echo anchor('/examples/invoices_management/','Invoice'); ?>
                        <ul>
                            <li><?php echo anchor('/examples/invoices_management/','Invoice Management'); ?></li>
                            <li><?php echo anchor('/invoice/generate/', 'Generate Invoice'); ?></li>
                            <li><?php echo anchor('/invoice/','Pay Invoice'); ?></li>
                       </ul>
                    </li>
                    <li><?php echo anchor('/examples/jobs_management','Job Card'); ?>
                        <ul>
                            <li><?php echo anchor('/examples/vehicles_management/','Vehicle Management'); ?></li>
                        </ul>
                    </li>
                    <li><?php echo anchor('/auth/', 'User'); ?>
                        <ul>
                            <li><?php echo anchor('/auth/reset_password/', 'Reset Password'); ?></li>
                            <li><?php echo anchor('/auth/change_password/', 'Change Password'); ?></li>
                            <li><?php echo anchor('/auth/change_email/', 'Change Email'); ?></li>
                            <li><?php echo anchor('/auth/unregister/', 'Unregister'); ?></li>
                            <li><?php echo anchor('/auth/logout/', 'Logout'); ?></li>
                        </ul>
                    </li>
                    <li><?php echo anchor('/examples/customers_management','Customers'); ?></li>
                </ul>
                <br style="clear: left" />
            </div> <!-- end of templatemo_menu -->
              
            <div class="cleaner"></div>
        </div> <!-- end of templatemo header -->  