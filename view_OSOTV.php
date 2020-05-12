<!DOCTYPE html>

<html lang="en">
<head>
    <link href="https://fonts.googleapis.com/css?family=Fugaz+One&display=swap" rel="stylesheet">
</head>
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

<meta http-equiv="refresh" content="10" > 

<!-- Main navbar -->

<?php 

include("includes/OSOTV_header.php");

$data_qry="SELECT * FROM tbl_order_details ORDER BY `id` DESC";
$result=mysqli_query($mysqli,$data_qry);


    if (null)
    {
        echo oops;
    }
    
    

    function get_user_info($user_id)
    {
        global $mysqli;
        $query1="SELECT * FROM tbl_users WHERE tbl_users.id='".$user_id."'";
    	$sql1 = mysqli_query($mysqli,$query1)or die(mysqli_error());
    	$data1 = mysqli_fetch_assoc($sql1);
    	return $data1;
    }


    function get_order_status($order_unique_id)

    {

          global $mysqli;
          
    		$query1="SELECT * FROM tbl_order_details WHERE tbl_order_details.order_unique_id='".$order_unique_id."' ORDER BY id DESC";
    		$sql1 = mysqli_query($mysqli,$query1)or die(mysqli_error());
    		$data1 = mysqli_fetch_assoc($sql1);
    		return $data1['status'];
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

	<!-- Page container -->

				<!-- Highlighting rows and columns -->

				<div class="osotvdiv">

					<?php if(isset($_SESSION['msg'])){?>

						  <div class="alert alert-success no-border">

								<button type="button" class="close" data-dismiss="alert"><span>&times;</span><span class="sr-only">Close</span></button>

								<span class="text-semibold"><?php echo $client_lang[$_SESSION['msg']] ; ?></span> 
								
						</div>

					<?php unset($_SESSION['msg']);}?>



					<table class="osotvtable" cellspacing="20" style="text-align:center;">

						<thead>
                            <tr>
                                <th class="osotvth" style="font-size:30px">Name</th>
                                <th class="osotvth" style="font-size:30px">Order Progress</th>
                            </tr>
						</thead>

						<tbody>

						<?php 

							while($row=mysqli_fetch_array($result))

							{         

							?>

							<tr>
                                <td style="font-size:25px">
                                    <?php
                                if(get_order_status($row['order_unique_id']) == "Ready For Pickup")
                                    echo get_user_info($row['user_id'])['name']; 
                                ?>
                               </td>
                                
								<td>
								    <?php
								    if(get_order_status($row['order_unique_id']) == "Ready For Pickup")
                                    echo "Pickup"; 
                                    ?>
                                </td>

							</tr>

							<?php
								}
								?> 

						</tbody>

					</table>
                <div>
		        <img src="/imagess/extra/oso-stagcafe.comQR.png" width="250" height="250" margin-top: 10px;>
                </div>
				<!-- /highlighting rows and columns -->

			

			<!-- /main content -->

		

		<!-- /page content -->

	</div>

	<!-- /page container -->



	<!-- Footer -->

	<?php include("includes/footer.php");?>

	<!-- /footer -->



</body>

</html>

