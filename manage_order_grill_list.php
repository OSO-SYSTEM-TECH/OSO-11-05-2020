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

//$data_qry="SELECT * FROM tbl_payment ORDER BY `id` DESC";
$data_qry="SELECT * FROM tbl_order_details ORDER BY `id` DESC";

$result=mysqli_query($mysqli,$data_qry);



 
    if(isset($_GET['order_id']))

    {

    		Delete('tbl_order_details','order_unique_id="'.$_GET['order_id'].'"');

    		Delete('tbl_payment','order_id="'.$_GET['order_id'].'"');
    

    		$_SESSION['msg']="12";

			echo '<script type="text/javascript">

           window.location = "manage_order_grill_list.php"

      </script>';

    		exit;
    }	

       //order status
    if(isset($_GET['status_pending_id']))

    {
       $data = array('status'  =>  $_GET['status_value']);
       $edit_status=Update('tbl_order_details', $data, "WHERE order_unique_id = '".$_GET['status_pending_id']."'");
       //$_SESSION['msg']="14";

	  echo '<script type="text/javascript">
           window.location = "manage_order_grill_list.php"

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

    function get_order_status($order_unique_id)

    {

          global $mysqli;

    

    		//$query1="SELECT * FROM tbl_payment WHERE tbl_payment.order_id='".$order_id."' ORDER BY id DESC";
    		$query2="SELECT * FROM tbl_order_details WHERE tbl_order_details.order_unique_id='".$order_unique_id."' ORDER BY id DESC";

    

    		//$sql1 = mysqli_query($mysqli,$query1)or die(mysqli_error());
    		$sql2 = mysqli_query($mysqli,$query2)or die(mysqli_error());

    

    		//$data1 = mysqli_fetch_assoc($sql1);
    		$data2 = mysqli_fetch_assoc($sql2);

    

    		//return $data1['status'];
    		return $data2['status'];

    

       }

    

	

	

?>

<!-- /main navbar -->



<!-- Page header -->

<div class="page-header">

	<div class="page-header-content">
	

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

						<h3 class="panel-title">Grill</h3>

					</div>

					<?php if(isset($_SESSION['msg'])){?>

						  <div class="alert alert-success no-border">

								<button type="button" class="close" data-dismiss="alert"><span>&times;</span><span class="sr-only">Close</span></button>

								<span class="text-semibold"><?php echo $client_lang[$_SESSION['msg']] ; ?></span> 

						</div>

					<?php unset($_SESSION['msg']);}?>



					<table class="table table-bordered datatable-highlight">

						<thead>
							<tr>
                                <th>Name</th>

                                <th>Order Progress</th>

								<th class="text-center">View Order</th>

							</tr>

						</thead>

						<tbody>

						<?php 

							while($row=mysqli_fetch_array($result))

							{         

							?>

							<tr>

                                <td><?php echo get_user_info($row['user_id'])['name'];?></td>

                                <td>

                                    <div class="btn-group">

                                        <button type="button" class="btn <?php if(get_order_status($row['order_unique_id'])=="Made"){?>btn bg-teal<?php }else if(get_order_status($row['order_unique_id'])=="Completed"){?> btn-primary<?php }else{?>btn-danger<?php }?> dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo get_order_status($row['order_unique_id']);?></button>
                                            <?php if (get_order_status($row['order_unique_id'])=="Pending") {
                                                ?>
                                                <button type="button" class="btn"><a href="manage_order_grill_list.php?status_pending_id=<?php echo $row['order_unique_id'];?>&status_value=Made">Made</a></li></button>
                                                <?php
                                            }
                                            else if (get_order_status($row['order_unique_id']) == "Made") {
                                            ?>
                                                <button type="button" class="btn"><a href="manage_order_grill_list.php?status_pending_id=<?php echo $row['order_unique_id'];?>&status_value=Pending">Pending</a></li></button>
                                            <?php 
                                            }
                                            ?>
                                            

                                    </div>

                                </td>

								<td class="text-center">

									<ul class="icons-list">

                                                <li><a href="manage_order_grill_list_view.php?order_unique_id=<?php echo $row['order_unique_id'];?>"> <i><?php echo $row['menu_name']?></i></a></li>

									</ul>
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

