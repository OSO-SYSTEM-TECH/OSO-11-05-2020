<?php include("includes/connection.php");
 
	include('includes/function.php');

		$host = $_SERVER['HTTP_HOST'];
		preg_match("/[^\.\/]+\.[^\.\/]+$/", $host, $matches);
        $domain_name=$matches[0];
         
	 	 
		$qry = "SELECT * FROM tbl_users WHERE email = '".$_POST['email']."'"; 
		$result = mysqli_query($mysqli,$qry);
		$row = mysqli_fetch_assoc($result);
		
		if($row['email']!="")
		{
 
			$to = $_POST['email'];
			// subject
			$subject = 'Your Password';
 			
			$message='<div style="background-color: #0;" align="center"><br />
					  <table style="font-family: OpenSans,sans-serif; color: #0;" border="0" width="600" cellspacing="0" cellpadding="0" align="center" bgcolor="#0">
					    <tbody>
					      <tr>
					        <td colspan="2" bgcolor="#1f" align="center"><img src="kitchen.oso-stagcafe.com/imagess/thumbs/OSOLOGO.png" alt="header" /></td>
					      </tr>
					      <tr>
					        <td width="600" valign="top" bgcolor="#0"><br>
					          <table style="font-family:OpenSans,sans-serif; color: #0; font-size: 10px; padding: 15px;" border="0" width="100%" cellspacing="0" cellpadding="0" align="left">
					            <tbody>
					              <tr>
					                <td valign="top"><table border="0" align="left" cellpadding="0" cellspacing="0" style="font-family:OpenSans,sans-serif; color: #00000; font-size: 10px; width:100%;">
					                    <tbody>
					                      <tr>
					                        <td><p style="color: #; font-size: 28px; margin-top:0px;"><strong>Dear '.$row['name'].'</strong></p>
					                          <p style="color:#0; font-size:20px; line-height:32px;font-weight:500;">Thank you for using OSO,<br>
					                            Your password is: '.$row['password'].'</p>
					                          <p style="color:#0; font-size:20px; line-height:32px;font-weight:500;margin-bottom:30px;">Sincerely,<br />
					                            OSO.</p></td>
					                      </tr>
					                    </tbody>
					                  </table></td>
					              </tr>
					            </tbody>
					          </table></td>
					      </tr>
					      <tr>
					        <td style="color: #0; padding: 20px 0; font-size: 20px; border-top:5px solid #EDA958;" colspan="2" align="center" bgcolor="#ffffff">OSO</td>
					      </tr>
					    </tbody>
					  </table>
					</div>';
			 
			 
			$headers = 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			$headers .= 'From: '.APP_NAME.' <'.APP_FROM_EMAIL.'>' . "\r\n";
			// Mail it
			@mail($to, $subject, $message, $headers);
		  	$set['response']->message = 'Password Reset';
			$set['response']->code = 200;    	  
			$set['forget_password']=array('success'=>'1');
			//$set['forget_password'][]=array('msg' => "Your Password Has Been Sent To Your Email",'success'=>'1');
		}
		else
		{  	 
			$set['response']->message = 'Email Does Not Exist';
			$set['response']->code = 404; 	
			//$set['forget_password']=array('msg' => "Email Not Found In OSO Database",'success'=>'0');
			//$set['forget_password'][]=array('msg' => "Email Not Found In OSO Database",'success'=>'0');
					
		}

	  
 	 header( 'Content-Type: application/json; charset=utf-8');
     $json = json_encode($set);
				
	 echo $json;
	 exit;
	 
?>