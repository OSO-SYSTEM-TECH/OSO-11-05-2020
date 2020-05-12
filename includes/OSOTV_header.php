<?php include("includes/connection.php");
      include("includes/session_check.php");
      
      $currentFile = $_SERVER["SCRIPT_NAME"];
      $parts = Explode('/', $currentFile);
      $currentFile = $parts[count($parts) - 1];  
     
?>	
	
	<div>
		<div>
			<a  style="text-align:center" href="manage_order_list.php"><img src="imagess/OSO LONG copy.png" alt="OSO LOGO" class="center" height="240" width="600" ></a>
		</div>
	</div>