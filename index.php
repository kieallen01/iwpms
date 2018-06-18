<?php
	session_start();
	include ('includes/connection.php');

	if(isset($_SESSION['login'])){
		if($_SESSION['login']==true) {
			if($_SESSION['user_level']=="Administrator"){
				header("location: php/ADM/index.php");
			}elseif ($_SESSION['user_level']=="MTO"){
				header("location: php/MTO/index.php");
			}elseif($_SESSION['user_level']=="MTC"){
				header("location: php/MTC/index.php");
			}elseif($_SESSION['user_level']=="MPO"){
				header("location: php/MPO/index.php");
			}elseif($_SESSION['user_level']=="MHO"){
				header("location: php/MHO/index.php");
			}
		}
	}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>IWP Management System</title>
		<link rel = "icon" type = "image/ico" href ="includes/img/seal.png">
		<link rel="stylesheet" type="text/css" href="plugins/bootstrap/dist/css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="plugins/custom.css">
		<link rel="stylesheet" type="text/css" href="plugins/font-awesome/css/font-awesome.min.css">
		<link rel="stylesheet" type="text/css" href="plugins/jqueryui/jquery-ui.css">
		<link rel="stylesheet" type="text/css" href="plugins/toastr/build/toastr.css">
		<link rel="stylesheet" type="text/css" href="plugins/fakeLoader/fakeLoader.css">
	</head>
	<div id="fakeLoader"></div>
	<body>
		<div class="container">
			<div class="row" style="padding-top: 100px;">
				<div class="col"></div>
				<div class="col">		
					<div class="row" id="title">
						<center>
							<div class="col">
								<img src="includes/img/seal.png" width="80" height="80">
								IWPMS
							</div>
						</center>
					</div>
				</div>
				<div class="col"></div>
			</div>
			<div class="row" style="margin-top: 20px;">
				<div class="col"></div>
					<div class="col">
						<form id = "frmLogin">
						<!-- <form action="php/query-auth.php?query=LOGIN" method="post"> -->
							<div class="card login">
								<div class="card-header"><span class="fa fa-pencil"></span> Sign in to start</div>
								<div class="card-body">

								    <div class="input-group input-group-sm mb-2">
										<input class="form-control form-control-sm" type = "text" name = "username" id = "username" placeholder = "Username" autofocus required>
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1"><i class="fa fa-user"></i></span>
                                        </div>
                                    </div>

                                   <div class="input-group input-group-sm mb-3">
										<input class="form-control form-control-sm" type = "password" name = "password" id = "password" placeholder = "Password" required>
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1"><i class="fa fa-lock"></i></span>
                                        </div>
                                    </div>

									<button class= "btn btn-sm btn-secondary" id="btnLogin" style="width:100%;" type = "submit" name = "btnLogin" id = "btnLogin"><small><span class="fa fa-sign-in"></span> </small> Login</button>
								</div>
							</div>	
						</form>
						<br>
					</div>
				<div class="col"></div>		
			</div>
		</div>
		<div class="row">
			<footer class="footer">
				<center><small>Copyright &copy; 2018. Individual Working Permit Management System for the Local Government of Bauang La Union . All rights reserved. </small></center>
			</footer>
		</div>
		<script type="text/javascript" src="plugins/jquery/jquery-3.2.1.js"></script>
		<script type="text/javascript">
	   		$(document).ready(function(){
	   			window.serverdir = 'http://'+'<?php echo gethostbyname(getHostName())?>'+'/iwpms';
	   		});	
	   	</script>
		<script type="text/javascript" src="plugins/jqueryui/jquery-ui.js"></script>
		<script type="text/javascript" src="plugins/bootstrap/dist/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="plugins/popperjs/popper.min.js"></script>
		<script type="text/javascript" src="plugins/nanobar/nanobar.min.js"></script>
		<script type="text/javascript" src="plugins/toastr/build/toastr.min.js"></script>
		<script type="text/javascript" src="plugins/fakeLoader/fakeLoader.min.js"></script>
		<script type="text/javascript" src="ajax/Auth.js"></script>
	</body>
</html>