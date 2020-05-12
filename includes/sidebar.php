<?php
      $currentFile = $_SERVER["SCRIPT_NAME"];
      $parts = Explode('/', $currentFile);
      $currentFile = $parts[count($parts) - 1];   
?>
<head>
    <link href="https://fonts.googleapis.com/css?family=Fugaz+One&display=swap" rel="stylesheet">
</head>

<div class="sidebar sidebar-main sidebar-default">
				<div class="sidebar-content">

					<!-- Main navigation -->
					<div class="sidebar-category sidebar-category-visible">
						<div class="category-content no-padding">
							<ul class="navigation navigation-main navigation-accordion">

								<!-- Main -->

								<li class="<?php if($currentFile=="manage_order_list.php" or $currentFile=="manage_order_list_view.php"){echo 'active';}?>"><a href="manage_order_list.php"><i class="icon-cart-add2"></i> <span>Front</span></a></li>
								<li class="<?php if($currentFile=="manage_order_assembly_list.php" or $currentFile=="manage_order_assembly_list_view.php"){echo 'active';}?>"><a href="manage_order_assembly_list.php"><i class="icon-cart-add2"></i> <span>Assembly</span></a></li>
								<li class="<?php if($currentFile=="manage_order_all_list.php" or $currentFile=="manage_order_all_list_view.php"){echo 'active';}?>"><a href="manage_order_all_list.php"><i class="icon-cart-add2"></i><span>All</span></a></li>
								<li class="<?php if($currentFile=="manage_order_grill_list.php" or $currentFile=="manage_order_grill_list_view.php"){echo 'active';}?>"><a href="manage_order_grill_list.php"><i class="icon-cart-add2"></i> <span>Grill</span></a></li>
								<li class="<?php if($currentFile=="manage_order_shakes_list.php" or $currentFile=="manage_order_shakes_list_view.php"){echo 'active';}?>"><a href="manage_order_shakes_list.php"><i class="icon-cart-add2"></i> <span>Shakes</span></a></li>
								<li class="<?php if($currentFile=="manage_order_completed_list.php" or $currentFile=="manage_order_completed_list_view.php"){echo 'active';}?>"><a href="manage_order_completed_list.php"><i class="icon-cart-add2"></i> <span>Completed</span></a></li>
								<li class="<?php if($currentFile=="manage_submenu_list.php" or $currentFile=="add_submenu.php"){echo 'active';}?>"><a href="manage_submenu_list.php"><i class="glyphicon glyphicon-cutlery"></i> <span>Menu</span></a></li>
								<li class="<?php if($currentFile=="manage_category.php" or $currentFile=="add_category.php"){echo 'active';}?>"><a href="manage_category.php"><i class="glyphicon glyphicon-cutlery"></i> <span>Menu Categories</span></a></li>
								<li class="<?php if($currentFile=="view_OSOTV.php"){echo 'active';}?>"><a href="view_OSOTV.php" target="_blank"><i class="glyphicon glyphicon-eye-open"></i> <span>OSO TV</span></a></li>
								<li class="<?php if($currentFile=="manage_bannerad.php" or $currentFile=="add_bannerad.php"){echo 'active';}?>"><a href="manage_bannerad.php"><i class="icon-images2"></i> <span>OSO App Banners</span></a></li>
								<li class="<?php if($currentFile=="Open_OSO.php" or $currentFile=="Open_OSO.php"){echo 'active';}?>"><a href="Open_OSO.php"><i class="glyphicon glyphicon-transfer"></i> <span>Open OSO</span></a></li>
								<li class="<?php if($currentFile=="manage_users.php" or $currentFile=="add_user.php"){echo 'active';}?>"><a href="manage_users.php"><i class="icon-users"></i> <span>Users</span></a></li>
								<li class="<?php if($currentFile=="manage_promo_code_list.php" or $currentFile=="add_promo_code.php"){echo 'active';}?>"><a href="manage_promo_code_list.php"><i class="icon-cash2"></i> <span>Promo Codes</span></a></li>
								<li class="<?php if($currentFile=="manage_tax_value.php" or $currentFile=="add_tex.php"){echo 'active';}?>"><a href="manage_tax_value.php"><i class="icon-percent"></i> <span>Taxes</span></a></li>
								<li class="<?php if($currentFile=="manage_aboutus.php" or $currentFile=="add_aboutus.php"){echo 'active';}?>"><a href="manage_aboutus.php"><i class="icon-pencil7"></i> <span>About Stag Café</span></a></li>
								<li class="<?php if($currentFile=="send_notification.php"){echo 'active';}?>"><a href="send_notification.php"><i class="glyphicon glyphicon-bell"></i><span>Notifications</span></a></li>
								<li class="<?php if($currentFile=="settings.php"){echo 'active';}?>"><a href="settings.php"><i class="icon-cog4"></i> <span>Settings</span></a></li>
								
								<!-- /main -->

							</ul>
						</div>
					</div>
					<!-- /main navigation -->

				</div>
			</div>