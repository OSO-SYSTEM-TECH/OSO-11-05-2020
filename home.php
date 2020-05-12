<!DOCTYPE html>
<html lang="en">
<?php
require("language/language.php");
require("includes/function.php");
include("includes/head.php");

?>

<script type="text/javascript" src="assets/js/core/app.js"></script>
<script type="text/javascript" src="assets/js/pages/dashboard.js"></script>
<body class="navbar-bottom">

	<!-- Main navbar -->
<?php 
include("includes/header.php");

$qry_cat="SELECT COUNT(*) as num FROM tbl_category";

$total_category= mysqli_fetch_array(mysqli_query($mysqli,$qry_cat));

$total_category = $total_category['num'];


$qry_menu="SELECT COUNT(*) as num FROM tbl_menu_list";

$total_menu= mysqli_fetch_array(mysqli_query($mysqli,$qry_menu));

$total_menu = $total_menu['num'];


$qry_promo="SELECT COUNT(*) as num FROM tbl_promo";

$total_promo= mysqli_fetch_array(mysqli_query($mysqli,$qry_promo));

$total_promo = $total_promo['num'];


$qry_restaurant="SELECT COUNT(*) as num FROM tbl_restaurants";

$total_restaurant = mysqli_fetch_array(mysqli_query($mysqli,$qry_restaurant));

$total_restaurant = $total_restaurant['num'];


$qry_users="SELECT COUNT(*) as num FROM tbl_users";

$total_users = mysqli_fetch_array(mysqli_query($mysqli,$qry_users));

$total_users = $total_users['num'];


$qry_order="SELECT COUNT(*) as num FROM tbl_order_details";

$total_order = mysqli_fetch_array(mysqli_query($mysqli,$qry_order));

$total_order = $total_order['num'];

?>
	<!-- /page header -->
        <head>
            <link href="https://fonts.googleapis.com/css?family=Fugaz+One&display=swap" rel="stylesheet">
        </head>
	<!-- Page container -->
	<div class="page-container">

		<!-- Page content -->
		<div class="page-content">
		    
			<!-- Main content -->
			<div class="content-wrapper">

				<!-- Dashboard content -->
				<div class="row">
					<div class="col-lg-12">

						<!-- Quick stats boxes -->
						<div class="row">
							<div class="col-lg-4">

								<div class="panel bg-teal-400">
								<a href="menu.php" class="text-muted text-size-small">
									<div class="panel-body">
										<div class="heading-elements">
											<span class="heading-text badge bg-teal-800"><?php echo $total_menu;?></span>
										</div>

										<h3 class="no-margin">Menu</h3>
										Menu
										<div class="text-muted text-size-small"> Categories</div>
									</div>

									<div class="container-fluid">
										<div id="members-online"></div>
									</div>
								
								</div>
							</div>

							<div class="col-lg-4">

								<div class="panel bg-teal-400">
								<a href="orders.php" class="text-muted text-size-small">
									<div class="panel-body">
										<div class="heading-elements">
											<span class="heading-text badge bg-teal-800"><?php echo $total_order;?></span>
										</div>

										<h3 class="no-margin">Orders</h3>
										<div class="text-muted text-size-small">Grilled</div>
										<div class="text-muted text-size-small">Shaken</div>
										<div class="text-muted text-size-small">Front</div>
										<div class="text-muted text-size-small">Assembly</div>
										<div class="text-muted text-size-small">All</div>
										<div class="text-muted text-size-small">Completed</div>
										<div class="text-muted text-size-small">Not Completed</div>
									</div>

									<div class="container-fluid">
										<div id="members-online"></div>
									</div>
								</div>
							</div>

							
							
							<div class="col-lg-4">
								<div class="panel bg-teal-400">
								<a href="extras.php" class="text-muted text-size-small">
									<div class="panel-body">
										<div class="heading-elements">
											<span class="heading-text badge bg-teal-800"><?php echo $total_promo;?></span>
										</div>
										<h3 class="no-margin">Extras</h3>
										<div class="text-muted text-size-small">Promo Codes</div>
										<div class="text-muted text-size-small">Notifications</div>
										<div class="text-muted text-size-small">Users</div>
										<div class="text-muted text-size-small">Settings</div>
									</div>
									</a>
								

								</div>
								<!-- /current server load -->

							</div>
						</div>
						</div>
						<!-- /quick stats boxes -->
					</div>

				</div>
				<!-- /dashboard content -->

			</div>
			<!-- /main content -->

		</div>
		<!-- /page content -->

	</div>
	<!-- /page container -->


	<!-- Footer -->
	<?php include("includes/footer.php");?>
	<!-- /footer -->

</body>
</html>
