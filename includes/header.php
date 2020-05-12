<?php include("includes/connection.php");
      include("includes/session_check.php");

      
      //Get file name
      $currentFile = $_SERVER["SCRIPT_NAME"];
      $parts = Explode('/', $currentFile);
      $currentFile = $parts[count($parts) - 1];  
     
      
?>	

<head>
    <script type="text/javascript"> 
function display_c(){
var refresh=1000; // Refresh rate in milli seconds
mytime=setTimeout('display_ct()',refresh)
}

function display_ct() {
var x = new Date()

var days = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
var x1=days[x.getDay()];
x1 = x1 + " - " +  x.getHours( )+ ":" +  x.getMinutes() + ":" +  x.getSeconds();
document.getElementById('ct').innerHTML = x1;
display_c();
 }
</script>
</head>
	
	<div class="navbar navbar-inverse">
		<div class="navbar-header">
			<a class="navbar-brand" href="home.php"><img src="imagess/OSO LONG copy.png" alt="OSO LOGO" height="40" width="106"></a>
			
		</div>
		<div align="center" style="display: inline">
			<body onload=display_ct();>
            <span onload=display_ct(); id='ct' style="text-align:center"></span>
            </div>

		<div>
			<ul class="nav navbar-nav navbar-right">	
				<li class="dropdown dropdown-user">
					<a class="dropdown-toggle" data-toggle="dropdown">
						<img src="imagess/thumbs/OSOLOGO.png" alt="OSO Logo">
						<span><?php echo PROFILE_NAME;?></span>
						<i class="caret"></i>
					</a>
					<ul class="dropdown-menu dropdown-menu-right">
						<li><a href="logout.php"><i class="icon-switch2"></i> Logout</a></li>
						<li class="divider"></li>
						<li><a href="shutdown.php"><i> Shutdown NOW</i></a></li>
					</ul>
				</li>
			</ul>
		</div>
	</div>