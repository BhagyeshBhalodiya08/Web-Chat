<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require("function.php");
?>
<!DOCTYPE html>
<html lang='en'>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Web-Chat</title>
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="asset/css/style.css">
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
	<script src="bootstrap/js/bootstrap.min.js"></script>
</head>
<body><?php session_start(); 
	if(isset($_SESSION["user"]))header("Location:homepage.php");
	if(isset($_SESSION['warning_msg'])) echo $_SESSION['warning_msg'];
	if(isset($_POST["logSubmit"])){
		$response = getData("*",array("username"=> $_POST["UserName"] ,"password"=>$_POST["UserPassword"]),0);
		if(mysqli_num_rows($response)){
			$_SESSION["user"] = mysqli_fetch_array($response)["username"] ;
			$_SESSION["user_id"] = mysqli_fetch_array($response)["user_id"];
			header("Location:homepage.php");
		}else{
			$_SESSION['warning_msg'] = "User IS Not Exist !";
		}
	}
?>
	<div class="container-fluid">
		<div class="registration-form ">
			<div class="form-heading">
				<h2>Login Form</h2>
			</div>
			<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" id="loginForm" enctype="multipart/form-data">
				<div class="form-row">
					<div class=" mb-3">
						<label for="validationCustomUsername">User Name:- </label>
						<div class="input-group">
							<div class="input-group-prepend">
								<span class="input-group-text my-2" id="inputGroupPrependtwo">@</span>
							</div>
							<input type="text" class="form-control my-2" name="UserName" id="loginUserName" placeholder="User Name" aria-describedby="inputGroupPrependtwo" >
						</div>
					</div>
					<div class=" mb-3">
						<label for="loginEmail">Password:-</label>
						<input type="text" class="form-control my-2" name="UserPassword" id="loginEmail" placeholder="Password" >
					</div>
				</div>
				<button class="btn btn-primary m-2" type="submit" name="logSubmit" id="logSubmit">Log In</button>
			</form>				
		</div>
	</div>
</body>
<script src="bootstrap/js/bootstrap.bundle.js"></script>
<script src="asset/js/jquery.js"></script>
<script src="asset/js/script.js"></script>
</html>