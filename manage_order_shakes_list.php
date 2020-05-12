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
    $data_qry="SELECT * FROM tbl_order_details ORDER BY `id` DESC";
    $result=mysqli_query($mysqli,$data_qry);
    
    $data_qry_order = "SELECT * FROM tbl_order_details WHERE tbl_order_details.order_unique_id='".$_GET['order_id']."'ORDER BY tbl_order_details.id DESC";
    $result_order=mysqli_query($mysqli,$data_qry_order);

$user_data_qry="SELECT * FROM tbl_order_details WHERE tbl_order_details.order_unique_id='".$_GET['order_id']."' GROUP BY(order_unique_id) ORDER BY tbl_order_details.id DESC"; 

$user_result=mysqli_query($mysqli,$user_data_qry);

$user_row=mysqli_fetch_assoc($user_result);

    if(isset($_GET['order_id']))

    {
    		Delete('tbl_order_details','order_unique_id="'.$_GET['order_id'].'"');
    		Delete('tbl_payment','order_id="'.$_GET['order_id'].'"');
    		$_SESSION['msg']="12";
			echo '<script type="text/javascript">
            window.location = "manage_order_shakes_list.php"

      </script>';

    		exit;
    }	

    if(isset($_GET['status_pending_id']))

    {
       $data = array('status'  =>  $_GET['status_value']);
       $edit_status=Update('tbl_payment', $data, "WHERE order_id = '".$_GET['status_pending_id']."'");
       $_SESSION['msg']="14";

	  echo '<script type="text/javascript">
           window.location = "manage_order_shakes_list.php"
      </script>';
      
       exit;

     }

    function get_user_info($user_id)

    {
        global $mysqli;
        $query1="SELECT * FROM tbl_users WHERE tbl_users.id='".$user_id."'";
    	$sql1 = mysqli_query($mysqli,$query1)or die(mysqli_error());
    	$data1 = mysqli_fetch_assoc($sql1);
    	return $data1;
    }

	  function get_payment_type($payment_type)

    {
          global $mysqli;
    		$query1="SELECT * FROM tbl_payment WHERE tbl_payment.user_id='".$payment_type."' ORDER BY id DESC";
    		$sql1 = mysqli_query($mysqli,$query1)or die(mysqli_error());
    		$data1 = mysqli_fetch_assoc($sql1);
    		return $data1;
    }

	 function get_order_price($total_price)

    {
          global $mysqli;
    		$query1="SELECT * FROM tbl_order_details WHERE tbl_order_details.total_price='".$total_price."'";
    		$sql1 = mysqli_query($mysqli,$query1)or die(mysqli_error());
    		$data1 = mysqli_fetch_assoc($sql1);
    		return $data1;
    }

    function get_order_status($order_id)

    {
          global $mysqli;
    		$query1="SELECT * FROM tbl_payment WHERE tbl_payment.order_id='".$order_id."' ORDER BY id DESC";
    		$sql1 = mysqli_query($mysqli,$query1)or die(mysqli_error());
    		$data1 = mysqli_fetch_assoc($sql1);
    		return $data1['status'];
    }
    
    function get_order_info($order_id)
    {
        global $mysqli;
        $query1="SELECT * FROM tbl_order_details WHERE tbl_order_details.order_unique_id='".$_GET['order_id']."'";
        $sql1 = mysqli_query($mysqli,$query1)or die(mysqli_error());
        $data1 = mysqli_fetch_assoc($sql1);
        return $data1;
    }
?>

<!-- /main navbar -->
<!-- Page header -->

<div class="page-header">
	<div class="page-header-content">
		<div class="page-title">
			<h4><span class="text-semibold">Orders - Shakes</span></h4>
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
			    <button onclick="history.go(-1);">Back </button>


				<!-- Highlighting rows and columns -->

				<div class="panel panel-flat">

					<div class="panel-heading">

						<h5 class="panel-title">Orders - Shakes</h5>

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

                                <th>Name</th>

                                <th>Progress</th>

								<th class="text-center">Dish</th>

							</tr>

						</thead>

						<tbody>

						<?php 

							while($row=mysqli_fetch_array($result))

							{         

							?>

							<tr>
							    <?php
							        if (get_order_status($row['order_id'])=="Pending")
							            {
							    ?>

                                <td><?php echo get_user_info($row['user_id'])['name'];?></td>

                                <td>

                                    <div class="btn-group">

                                        <button type="button" class="btn <?php if(get_order_status($row['order_id'])=="Made"){?>btn bg-teal<?php }else{?>btn-danger<?php }?> dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo get_order_status($row['order_id']);?></button>
                                        <div class="dropdown-menu" x-placement="top-start">
                                            <li><a class="dropdown" href="manage_order_shakes_list.php?status_pending_id=<?php echo $row['order_id'];?>&status_value=Pending">Pending</a></li>
                                            <li><a class="dropdown" href="manage_order_shakes_list.php?status_pending_id=<?php echo $row['order_id'];?>&status_value=Made">Made</a></li>
                                        </div>
                                    </div>
                                </td>
								<td class="text-center">
									

						<!--//	while($row=mysqli_fetch_array($result_order))

						//	{         

						//	
						//		<td class="text-center"> -->

									<ul class="icons-list">
									    <?php
									        $row_order=mysqli_fetch_array($result_order)
									        ?>
							
                                               <li><a><?php echo $row_order['menu_name'];?></a><li>
                                    </ul>
								
								</td>
							</tr>

							<?php
                         //           }
								}
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

