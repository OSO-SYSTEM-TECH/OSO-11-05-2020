<!DOCTYPE HTML>
<html lang="en">
<?php
include('includes/function.php');
include('language/language.php'); 
include("includes/head.php");
?>
<!-- Theme JS files -->
<script type="text/javascript" src="assets/js/plugins/forms/styling/uniform.min.js"></script>

<script type="text/javascript" src="assets/js/core/app.js"></script>
<script type="text/javascript" src="assets/js/pages/form_inputs.js"></script>
<!-- /theme JS files -->
<body class="navbar-bottom">

<!-- Main navbar -->
<?php
require_once("thumbnail_images.class.php");
include('includes/header.php');

$qry="SELECT * FROM tbl_status";
      $result=mysqli_query($mysqli,$qry);
      $row=mysqli_fetch_assoc($result);
      
if(isset($_POST['open']))
{
    mysqli_query($mysqli,"UPDATE `tbl_status` SET `status`=('0') WHERE status =('1')");
    
    echo '<script type="text/javascript">

           window.location = "Open_OSO.php"

      </script>';
    exit;
  }
  
  if(isset($_POST['close']))
{
    	mysqli_query($mysqli,"UPDATE `tbl_status` SET `status`=('1') WHERE status =('0')");
    	
    	echo '<script type="text/javascript">

           window.location = "Open_OSO.php"

      </script>';
    exit;
  }

 if(isset($_GET['cat_id']))
  {
       
      $qry="SELECT * FROM tbl_status '".$_GET['status']."'";
      $result=mysqli_query($mysqli,$qry);
      $row=mysqli_fetch_assoc($result);

  }
  
  function get_status()

    {

          global $mysqli;

    		$query1="SELECT * FROM tbl_order_details WHERE tbl_status.status='".$status."'";
	
    		$sql1 = mysqli_query($mysqli,$query2)or die(mysqli_error());

    		$data1 = mysqli_fetch_assoc($sql2);
    		
    		return $data1['status'];

       }

?>
<!-- /main navbar -->


	<!-- Page header -->
	<div class="page-header">
		<div class="page-header-content">
			<div class="heading-elements">
			</div>
		</div>
	</div>
	<!-- /page header -->


	<!-- Page container -->
	<div class="page-container">

		<!-- Page content -->
		<div class="page-content">

			<!-- Main sidebar -->
			
					<?php include("includes/sidebar.php");?>
					<!-- /main sidebar -->


			<!-- Main content -->
			<div class="content-wrapper">

				<!-- Form horizontal -->
				<div class="panel panel-flat">
					
					<div class="panel-body">
						<?php if(isset($_SESSION['msg'])){?>
						<div class="alert alert-success no-border">
							<button type="button" class="close" data-dismiss="alert"><span>&times;</span><span class="sr-only">Close</span></button>
							<span class="text-semibold"><?php echo $client_lang[$_SESSION['msg']] ; ?></span> 
						</div>
						<?php unset($_SESSION['msg']);}?>
						<form class="form-horizontal" action="" name="addeditcategory" method="post" enctype="multipart/form-data">
							<input  type="hidden" name="cat_id" value="<?php echo $_GET['cat_id'];?>" />
							<fieldset class="content-group">
								<legend class="text-bold">Open OSO</legend>

								<div class="form-group">
    									<label class="control-label col-lg-2">Status :- 
    									<?php if ($row['status'] == "0") {
    									echo "open";
    									}
    									else if ($row['status'] == "1") {
    									echo "closed";
    									} 
    									?></label>
								</div>
							</fieldset>
							<div>
							    <button type="submit" name="open" class="btn-open-close btn-primary">Open <i class="icon-arrow-right14 position-right"></i></button>
								<button type="submit" name="close" class="btn-open-close btn-primary">Close <i class="icon-arrow-right14 position-right"></i></button>
							</div>
						</form>
					</div>
				</div>
				<!-- /form horizontal -->

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
