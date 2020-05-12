<?php include("includes/connection.php");
 
	include('includes/function.php');

	   $file_path = 'https://'.$_SERVER['SERVER_NAME'] . dirname($_SERVER['REQUEST_URI']).'/';
	 	  
		$qry = "SELECT * FROM tbl_users WHERE email = '".$_POST['email']."'"; 
		$result = mysqli_query($mysqli,$qry);
		$row = mysqli_fetch_assoc($result);
		
		if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) 
		{
				$set['response']->message = 'Invalid email format';
				$set['response']->code = 404;
			
		}
		else if($row['email']!="")
		{
			$set['response']->message = 'Email already exists';
				$set['response']->code = 409;
			
		}
		else
		{ 
 				$data = array(
 					'user_type'=>'Normal',
					'id'  => $_POST['id'],					
				    'name'  => $_POST['name'],				    
					'email'  =>  $_POST['email'],
					'password'  =>  $_POST['password'],
					'phone'  =>  $_POST['phone'], 
					'onesignal' => $_POST['onesignal'],
					'status'  =>  '1'
					);		
 			 
			$qry = Insert('tbl_users',$data);									 
			
			$user_id=mysqli_insert_id($mysqli);									 
			
			$qry1 = "SELECT * FROM tbl_users WHERE id = '".$user_id."'"; 
		    $result1 = mysqli_query($mysqli,$qry1);
		    $row1 = mysqli_fetch_assoc($result1);
			
			$set['response']->message = 'You Have Registered';
			$set['response']->code = 200;
			$set['register_detail']=array('user_id' => $row1['id'],
			'name'=>$row1['name'],
			'email'=>$row1['email'],
			'phone'=>$row1['phone'],
			'onesignal'=>$row1['onesignal'],
			'success'=>'1');
			
		}

	  
 	 header( 'Content-Type: application/json; charset=utf-8');
     $json = json_encode($set);				
	 echo $json;
	 exit;
	 
?>
