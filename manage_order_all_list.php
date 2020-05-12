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

include("includes/function_notification.php");


//$data_qry="SELECT * FROM tbl_payment ORDER BY `id` DESC";
$data_qry="SELECT * FROM tbl_order_details ORDER BY `id` DESC";

$result=mysqli_query($mysqli,$data_qry);


 
    if(isset($_GET['order_id']))

    {

    		Delete('tbl_order_details','order_unique_id="'.$_GET['order_id'].'"');

    		Delete('tbl_payment','order_id="'.$_GET['order_id'].'"');
    

    		$_SESSION['msg']="12";

			echo '<script type="text/javascript">

           window.location = "manage_order_all_list.php"

      </script>';

    		exit;
    }	

       //order status
    if(isset($_GET['status_pending_id']))

    {
       $data = array('status'  =>  $_GET['status_value']);
       //$edit_status=Update('tbl_payment', $data, "WHERE order_id = '".$_GET['status_pending_id']."'");
       $edit_status=Update('tbl_order_details', $data, "WHERE order_unique_id = '".$_GET['status_pending_id']."'");
       $_SESSION['msg']="14";

	  echo '<script type="text/javascript">
           window.location = "manage_order_all_list.php"

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
       
function get_notification_status($order_unique_id)

    {

          global $mysqli;

    		$query1="SELECT 'notified' FROM 'tbl_order_details' WHERE ='".$order_unique_id."'";

    		$sql1 = mysqli_query($mysqli,$query1)or die(mysqli_error());
    
    		$data1 = mysqli_fetch_assoc($sql1);

    		return $data1;

    }
       

function check_all()
{
    global $mysqli;
    $query="SELECT order_unique_id FROM tbl_order_details.order_unique_id WHERE notified = 0";		
	$sql = mysqli_query($mysqli,$query);
	$ouid = mysqli_fetch_assoc($sql);

$query2 = "SELECT * FROM 'tbl_order_details' WHERE 'tbl_order_details.order_unique_id'='".$ouid."'";

$uid = $mysqli->query("SELECT 'id' FROM 'tbl_order_details' WHERE 'tbl_order_details.order_unique_id'='".$ouid."'");

$status = get_order_status($ouid);

$onesignalID = get_onesignalID($uid);

$sendToWhoo = "983a515e-5d5f-49cc-8faf-77928ce4348a";

if(get_order_status($ouid) == "Ready For Pickup")
{
    send_orderCompleted_notification($sendToWhoo);
    mysqli_query("UPDATE 'tbl_order_details' SET 'notified'=('1') WHERE 'order_unique_id'='".$ouid."'");
}

}
?>

<!-- /main navbar -->



<!-- Page header -->

<div class="page-header">

	<div class="page-header-content">

		<div class="page-title">

			<h4><span class="text-semibold">Orders</span></h4>

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

						<h5 class="panel-title">Orders</h5>

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

								<th>Order ID</th>

                                <th>Name</th>

                                <th>Total $</th>
                                
                                <th>Order Progress</th>
                                
								<th class="text-center">View Order</th>

							</tr>

						</thead>

						<tbody>

						<?php 

							while($row=mysqli_fetch_array($result))

							{     
                                //check_all();
							?>

							<tr>

								<td><a href="manage_order_list_all_view.php?order_unique_id=<?php echo $row['order_unique_id'];?>" title="View Order"><?php echo $row['order_unique_id'];?></a></td>

                                <td><?php echo get_user_info($row['user_id'])['name'];?></td>

                                <td><?php echo get_order_price($row['total_price'])['total_price'];?></td>

                                <td>
                                    <div class="btn-group">

                                        <button type="button" class="btn <?php if(get_order_status($row['order_unique_id'])=="Ready For Pickup"){?>btn bg-teal<?php }else if(get_order_status($row['order_unique_id'])=="Completed"){?> btn-primary<?php }else{?>btn-danger<?php }?> dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo get_order_status($row['order_unique_id']);?></button>
                                        <div class="dropdown-menu" x-placement="top-start">
                                            <li><a class="dropdown" href="manage_order_all_list.php?status_pending_id=<?php echo $row['order_unique_id'];?>&status_value=Pending">Pending</a></li>
                                            <li><a class="dropdown" href="manage_order_all_list.php?status_pending_id=<?php echo $row['order_unique_id'];?>&status_value=Made">Made</a></li>
                                            <li><a class="dropdown" href="manage_order_all_list.php?status_pending_id=<?php echo $row['order_unique_id'];?>&status_value=Ready For Pickup" >Ready For Pickup</a></li>
                                            <li><a class="dropdown" href="manage_order_all_list.php?status_pending_id=<?php echo $row['order_unique_id'];?>&status_value=Not Completed">Not Completed</a></li>
                                            <li><a class="dropdown" href="manage_order_all_list.php?status_pending_id=<?php echo $row['order_unique_id'];?>&status_value=Completed">Completed</a></li>
                                            
                                        </div>
                                    </div>

                                </td>
                                
                               

								<td class="text-center">

									<ul class="icons-list">

									

                                                <li><a href="manage_order_all_list_view.php?order_unique_id=<?php echo $row['order_unique_id'];?>"> <i class="icon-eye2"></i></a></li>
									</ul>

								</td>
							</tr>

							<?php
                                    check_all();
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

