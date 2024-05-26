<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require("function.php");
session_start();
?>
<!DOCTYPE html>
<html lang='en'>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Chat</title>
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="asset/css/style.css">
	<script src="asset/js/jquery.js"></script>
	<script src="asset/js/script.js"></script>
</head>
<body>
	<?php
	print_r($_SESSION);
	exit;
	if(!isset($_SESSION['user']) || !isset($_GET["user"])) {header("Location:login.php");}
	if(isset($_POST["conversion"])){
		$respose = InsertData("sender_id,reciver_id,message,created_at",$_SESSION["user_id"].','.$_POST['reciver_id'].',"'.$_POST["conversion"].'"',0);	
	}
	if(isset($_GET["user"])){
		$user_data = getData("*",array("user_id"=>$_GET["user"]),"",1);
		$row = mysqli_fetch_array($user_data);
		// print_r($row);
		// exit;
		if(!$row){
			$_SESSION['warning_msg'] = "User IS Not Exist !";
			header("Location:homepage.php");
		}
	?>
<div class="container-fluid">
		<div class="registration-form ">
			<div class="chat-box d-flex">
			<section class="chat-area">
				<header class="d-flex">
					<input type="hidden" name="sender_id" id ="sender_id" value="<?php echo $_SESSION["user_id"];?>" >
					<button name="backbtn" type="button"id="backbtn" > <- </button>
					<?php if(!empty($row['profile_photo'])){
						echo "<img src='data:image/jpeg;base64,".base64_encode($row['profile_photo'])."'/>";
					}?>
					<div class="d-flex chat-name">
						<div class="flex-column">
							<span><?php echo $row["username"]; ?></span>
							<p><?php echo $row['status']; ?></p>
						</div>
					</div>
				</header>
				<div class="chat-history">
					<?php
					if(!$_GET["user"] == $_SESSION['user']) header("Location:homepage.php");
					$data = array ("reciver_id" => $_GET["user"],"sender_id" => $_SESSION['user_id']);
					$msg = getData("*","",$data);
					while($row2 = mysqli_fetch_array($msg)){
						if($row2["sender_id"] == $_SESSION["user_id"]){
							echo '<div class="chat outgoing"><!-- <img src="" alt=""> --><div class="details">'.$row2["message"].'</div></div>';	
						}
						if($row2["sender_id"] == $_GET["user"]){
							echo '<div class="chat incoming"><div class="details">'.$row2["message"].'</div></div>';	
						}
					}
					?>
				</div>
				<!-- msg sender -->
				<div class="d-flex">
					<input type="text" name="textmsg" id="chatText"><button id="sendBtn" type="button"  value="<?php if(isset($_GET["user"])) echo $_GET["user"]; ?>" class="btn btn-success">Send</button>
				</div>
			</section>
		</div>
	</div>
</div>
<?php
}
?>
</html>