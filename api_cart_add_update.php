<?php include("includes/connection.php");
 
	include('includes/function.php');

		$file_path = 'http://'.$_SERVER['SERVER_NAME'] . dirname($_SERVER['REQUEST_URI']).'/';

		$qry = "SELECT * FROM tbl_cart WHERE user_id = '".$_GET['user_id']."' AND menu_id = '".$_GET['menu_id']."'"; 
		$result = mysqli_query($mysqli,$qry);
		$rowcount=mysqli_num_rows($result);
		$row = mysqli_fetch_assoc($result);
 	  
		//var_dump($qry);die();
 	 if($rowcount>0)
 	 {		
 	 		$data = array(
  			'menu_qty'  =>  $_GET['menu_qty'] 
			);
		 
			$user_edit=Update('tbl_cart', $data, "WHERE user_id = '".$_GET['user_id']."' AND menu_id = '".$_GET['menu_id']."'");

			$cart_query="SELECT * FROM tbl_cart WHERE user_id = '".$_GET['user_id']."'";
			$cart_sql = mysqli_query($mysqli,$cart_query);
	        $cart_rowcount=mysqli_num_rows($cart_sql);
			
			$set['response']->message = 'Cart Updated';
			$set['response']->code = 200;
			$set['add_cart']=array('cart_items'=>$cart_rowcount,'success'=>'1');	 
 	 }	
 	 else
 	 {
 	 		$data = array(
			'user_id'  =>  $_GET['user_id'],
			'menu_id'  =>  $_GET['menu_id'],
 			'menu_name'  =>  $_GET['menu_name'],
 			'menu_qty'  =>  $_GET['menu_qty'],
 			'menu_price'  =>  $_GET['menu_price']
			);
		 
			$qry = Insert('tbl_cart',$data);

			$cart_query="SELECT * FROM tbl_cart WHERE user_id = '".$_GET['user_id']."'";
			$cart_sql = mysqli_query($mysqli,$cart_query);
	        $cart_rowcount=mysqli_num_rows($cart_sql);
			
			$set['response']->message = 'Item added';
			$set['response']->code = 200;
			$set['add_cart']=array('cart_items'=>$cart_rowcount,'success'=>'1');	
							
 	 } 
		  
    
	header( 'Content-Type: application/json; charset=utf-8' );
	$json = json_encode($set);
	echo $json;
	 exit;
	 
?>