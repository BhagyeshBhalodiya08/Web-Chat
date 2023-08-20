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
<body><?php
	session_start();
	if(!empty($_SESSION)){
		// if(isset($_SESSION['user']))header("Location: homepage.php"); ;
		if(isset($_SESSION['warning_msg'])) echo $_SESSION['warning_msg'];
		if(isset($_SESSION['succes_msg'])) echo $_SESSION['succes_msg'];
	}
	if (isset($_POST['regSubmit'])) {
		$imgContent = "";
		$conn = mysqli_connect("localhost", "bhagyesh", "Bhagyesh@123", "web-chat");
		$username = $_POST['UserName'];
		$userFirstName = $_POST['UserFirstName'];
		$userLastName = $_POST['UserLastName'];
		$userPassword = $_POST['UserPassword'];
		$userEmailAddress = $_POST['UserEmailAddress'];
		$fileName = basename($_FILES["Profile_Photo"]["name"]); 
		$image = $_FILES['Profile_Photo']['tmp_name']; 
		// print_r($_FILES);
		if($_FILES["Profile_Photo"]["error"] == 0){
			$imgContent = addslashes(file_get_contents($image));
		}
		$sql ="INSERT into registered_user (username, user_first_name ,user_last_name,email_address,status,password,profile_photo,created_at) VALUES ('$username','$userFirstName','$userLastName' ,'$userEmailAddress','online','$userPassword','$imgContent', NOW() )";
		$insert = $conn->query($sql);  	
		if($insert){ 
			$_SESSION['user'] = $username; 
			$user_id = getData("user_id",array("username" => $username),"",1); 
			$_SESSION['user_id'] = mysqli_fetch_array($user_id)["user_id"]; 
			$_SESSION['succes_msg'] = "<div class='alert alert-success alert-dismissible fade show success-msg' role='alert'><strong>Welcome ".$username."!</strong><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
			header("Location: homepage.php");
		}else{
			$_SESSION['warning_msg'] = "<div class='alert alert-warning alert-dismissible fade show success-msg' role='alert'><strong>Something Wrong Please Try Again !</strong><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
		}
	}
	?>
	<div class="container-fluid">
		<div class="registration-form ">
			<div class="form-heading">
				<h2>Web-Chat</h2>
			</div>
			<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" id="registrationForm" enctype="multipart/form-data">
				<div class="form-row">
					<div class=" mb-3">
						<label for="validationCustomUsername">User Name:- </label>
						<div class="input-group">
							<div class="input-group-prepend">
								<span class="input-group-text my-2" id="inputGroupPrepend">@</span>
							</div>
							<input type="text" class="form-control my-2" name="UserName" id="registrationUserName" placeholder="User Name" aria-describedby="inputGroupPrepend" >
						</div>
					</div>
					<div class=" mb-3">
						<label for="registrationFirstName">First Name:- </label>
						<input type="text" class="form-control my-2" name="UserFirstName" id="registrationFirstName" placeholder="First Name" >
					</div>
					<div class=" mb-3">
						<label for="registrationLastName">Last Name:- </label>
						<input type="text" class="form-control my-2" name="UserLastName" id="registrationLastName" placeholder="Last Name" >
					</div>
					<div class=" mb-3">
						<label for="registrationEmail">Email:-</label>
						<input type="text" class="form-control my-2" name="UserEmailAddress" id="registrationEmail" placeholder="Email" >
					</div>
					<div class=" mb-3">
						<label for="registrationPassword">Password:-</label>
						<input type="password" class="form-control my-2" name="UserPassword" id="registrationPassword" placeholder="Password" >
					</div>
				</div>
				<div class="form-row">
					<div class="mb-3">
						<label for="validationCustom03">Profile Photo :-</label><br>
						<input type="file" name="Profile_Photo" class="m-2">
					</div>
				</div>
				<div class="form-group">
					<div class="form-check">
						<input class="form-check-input" type="checkbox" value="" id="invalidCheck" >
						<label class="form-check-label" for="invalidCheck">
							Agree to terms and conditions
						</label>
					</div>
				</div>
				<button class="btn btn-primary" type="submit" name="regSubmit" id="regSubmit">Register</button>
			</form>				
		</div>
	</div>
</body>
<script src="bootstrap/js/bootstrap.bundle.js"></script>
<script src="asset/js/jquery.js"></script>
<script src="asset/js/script.js"></script>
</html>