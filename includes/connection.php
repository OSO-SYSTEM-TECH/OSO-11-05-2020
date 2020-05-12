<?php
    error_reporting(0);
 		 ob_start();
    session_start();
 
 	header("Content-Type: text/html;charset=UTF-8");
	
	
		if($_SERVER['HTTP_HOST']=="localhost" or $_SERVER['HTTP_HOST']=="192.168.1.125" or $_SERVER['HTTP_HOST']=="192.168.1.22" or $_SERVER['HTTP_HOST']=="150.129.150.83")
		{	
			//local  

				 DEFINE ('DB_USER', 'root');
				 DEFINE ('DB_PASSWORD', '');
				 DEFINE ('DB_HOST', 'localhost');  
				 DEFINE ('DB_NAME', 'restorder');
		}
		else
		{
			//local live 

 			 DEFINE ('DB_USER', 'oso_oso');
			 DEFINE ('DB_PASSWORD', 'OSO_CLUSTER_system2019!');
			 DEFINE ('DB_HOST', 'localhost'); //host name depends on server
			 DEFINE ('DB_NAME', 'oso_oso');
		 	  
			  
		}

	
	$mysqli =mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);

	if ($mysqli->connect_errno) 
	{
    	echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
	}

	mysqli_query($mysqli,"SET NAMES 'utf8'");	 



	//Settings
	$setting_qry="SELECT * FROM tbl_settings where id='1'";
    $setting_result=mysqli_query($mysqli,$setting_qry);
    $settings_details=mysqli_fetch_assoc($setting_result);

	define("ONESIGNAL_APP_ID",$settings_details['onesignal_app_id']);
    define("ONESIGNAL_REST_KEY",$settings_details['onesignal_rest_key']);

    define("APP_NAME",$settings_details['app_name']);
    define("APP_LOGO",$settings_details['app_logo']);

    define("API_LATEST_LIMIT",$settings_details['api_latest_limit']);
    define("API_CAT_ORDER_BY",$settings_details['api_cat_order_by']);
    define("API_CAT_POST_ORDER_BY",$settings_details['api_cat_post_order_by']);
    define("API_ALL_VIDEO_ORDER_BY",$settings_details['api_all_order_by']);
    
    define("APP_FROM_EMAIL",$settings_details['app_from_email']);
    define("APP_ADMIN_EMAIL",$settings_details['app_admin_email']);

    //Profile
    if(isset($_SESSION['id']))
    {
    	$profile_qry="SELECT * FROM tbl_admin where id='".$_SESSION['id']."'";
	    $profile_result=mysqli_query($mysqli,$profile_qry);
	    $profile_details=mysqli_fetch_assoc($profile_result);

	    define("PROFILE_IMG",$profile_details['image']);
	    define("PROFILE_NAME",$profile_details['full_name']);
	    define("PROFILE_EMAIL",$profile_details['email']);
    }
    
	
function get_month_sell($month_name)
{
  global $mysqli;

  $start_month = date('Y-m-d H:i:s', strtotime('first day of '.$month_name.''));
  $finish_month = date('Y-m-d H:i:s', strtotime('last day of '.$month_name.''));

  $qry_sell="SELECT COUNT(*) as num FROM tbl_user_purchase WHERE purchase_date BETWEEN '$start_month' AND '$finish_month'";
  $total_sell = mysqli_fetch_array(mysqli_query($mysqli,$qry_sell));
  $total_sell = $total_sell['num']; 

  return $total_sell;
}

function get_total_daily_sell($item)
{
  global $mysqli;

  $today_date = date('Y-m-d H:i:s');
   

  $qry_sell="SELECT COUNT(*) as num FROM tbl_user_purchase WHERE item_type='$item' AND DATE_FORMAT(purchase_date,'%Y%c%d')=DATE_FORMAT(now(),'%Y%c%d')";

  $total_sell = mysqli_fetch_array(mysqli_query($mysqli,$qry_sell));
  $total_sell = $total_sell['num']; 

  return $total_sell;
}

?> 
	 
 