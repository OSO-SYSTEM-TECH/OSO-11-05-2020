<!DOCTYPE html>
<html lang="en">
<?php
require("language/language.php");
require("includes/function.php");
include("includes/head.php");

?>
<!-- Theme JS files -->
<script type="text/javascript" src="assets/js/plugins/tables/datatables/datatables.min.js"></script>
<script type="text/javascript" src="assets/js/plugins/forms/selects/select2.min.js"></script>

<script type="text/javascript" src="assets/js/core/app.js"></script>
<script type="text/javascript" src="assets/js/pages/datatables_advanced.js"></script>
<!-- /theme JS files -->
<body class="navbar-bottom">

<!-- Main navbar -->
<?php 
include("includes/header.php");

$quotes_qry="SELECT * FROM tbl_aboutus ORDER BY tbl_aboutus.id"; 
$result=mysqli_query($mysqli,$quotes_qry);
    
 
	if(isset($_GET['cat_id']))
	{

		$cat_res=mysqli_query($mysqli,'SELECT * FROM tbl_aboutus WHERE id=\''.$_GET['cat_id'].'\'');

		$cat_res_row=mysqli_fetch_assoc($cat_res);

		if($cat_res_row['project_image']!="")
		{
		   unlink('imagess/projectimage/'.$cat_res_row['project_image']);
		}

			Delete('tbl_aboutus','id='.$_GET['cat_id'].'');

			$_SESSION['msg']="12";

			header( "Location:manage_aboutus.php");
			
echo '<script type="text/javascript">

           window.location = "manage_aboutus.php"

      </script>';
			exit;
	}	
	

?>
<!-- /main navbar -->

<!-- Page header -->
<div class="page-header">
	<div class="page-header-content">
		<div class="page-title">
			<h4><span class="text-semibold">About Stag Café</span></h4>
		</div>
	</div>
</div>
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

				<!-- Highlighting rows and columns -->
				<div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">About Stag Café</h5>
						
					</div>
					<?php if(isset($_SESSION['msg'])){?>
						  <div class="alert alert-success no-border">
								<button type="button" class="close" data-dismiss="alert"><span>&times;</span><span class="sr-only">Close</span></button>
								<span class="text-semibold"><?php echo $client_lang[$_SESSION['msg']] ; ?></span> 
						</div>
					<?php unset($_SESSION['msg']);}?>

					<table class="table table-bordered table-hover datatable-highlight">
						<thead>
							<tr>
								<th>ID</th>
                                <th>Description</th> 
								
								<th class="text-center">Edit</th>
							</tr>
						</thead>
						<tbody>
						<?php 
							while($row=mysqli_fetch_array($result))
							{         
							?>
							<tr>
								<td><?php echo $row['id'];?></td>
							   <td><?php echo $row['about_desc'];?></td>
								
								<td class="text-center">
								    <a href="add_aboutus.php">test</a>
								    <a href="?cat_id=<?php echo $row['id'];?>" title="Delete" onclick="return confirm('Are you sure you want to delete this description?');"><i class="glyphicon glyphicon-trash"></i></a>
								</td>
							</tr>
							<?php
								}

								?> 
						</tbody>
					</table>
				</div>
				<!-- /highlighting rows and columns -->
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
