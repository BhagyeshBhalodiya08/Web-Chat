<?php
declare(strict_types=1);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="asset/css/style.css">
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
    <script src="asset/js/jquery.js"></script>
    <script src="asset/js/script.js"></script>
	<script src="bootstrap/js/bootstrap.min.js"></script>
</head>
<body>
<script type='text/javascript'>
  var succes_msg = "<?php if(isset($_SESSION['succes_msg']))echo $_SESSION['succes_msg']; ?>"; 
  var warning_msg = "<?php if(isset($_SESSION['warning_msg']))echo $_SESSION['warning_msg']; ?>"; 
    $(document).ready(function(){   
        $("body").append(succes_msg)
        $("body").append(warning_msg)
        $(".close").on("click",function(){
            $(".alert-dismissible").remove()
            console.info("Asa")
            <?php unset($_SESSION['warning_msg']); ?>
            <?php unset($_SESSION['succes_msg']); ?>
        })
        $(".user-info-btn").on("click",function(){
            $("#user-info-options").toggle();
            if($(".arrow").hasClass("down")){
                $(".arrow").removeClass("down");
                $(".arrow").addClass("up");
            }else{
                $(".arrow").removeClass("up");
                $(".arrow").addClass("down");
            }
        })
        var delayTimer; 
        $("#searchusername").on("input",function(){
            clearTimeout(delayTimer);
            var searchCriteria =  $("#searchusername").val().trim();
            var searchCriterialength =  $("#searchusername").val().trim().length;
            if(searchCriteria !== null && searchCriterialength != 0){
                delayTimer = setTimeout(function() {
                    $.ajax({
                        method:"POST",
                        data:{search:searchCriteria},
                        url: "search.php",
                    beforeSend: function( xhr ) {
                        // $("#users-list").append("<img src='image/preloader.gif'/>") ;
                    }})
                    .done(function( data ) {
                        $("#users-list").find("tbody").remove();
                        $("#users-list").append(data);
                    });
                }, 500); 
            }
        })
    })
</script>
    <?php
    $conn = mysqli_connect("localhost","bhagyesh","Bhagyesh@123","web-chat");
    try {
        if(!isset($_SESSION['user'])){header("location:index.php");}
        if(isset($_SESSION['user']) && !isset($_POST["search"])){
        $first_sql = "SELECT * FROM registered_user ORDER BY user_id DESC"; 
        $first_sql_result = mysqli_query($conn, $first_sql);
        ?>
        <!--User Info -->
        <div class="user-info">
            <div class="user-info-name">
                Welcome,<?php echo isset($_SESSION['user']) ? $_SESSION['user']:"" ;?>
                <button class="btn user-info-btn" type="button">
                    <i class="arrow down"></i>
                </button>
            </div>
            <div id="user-info-options">
                <ul>
                    <li>View Profile</li>
                    <li >Log Out</li>
                </ul>
            </div>
        </div>
        <!-- Page -->
        <div class="container homepage">
            <div class="content">
                <div class="box">
                    <div id="search-box">
                        <div class=" mb-3">
                                <label for="validationCustomUsername">User Name:- </label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text my-2" id="searchchatpartner">@</span>
                                    </div>
                                    <input type="text" class="form-control my-2" id="searchusername" placeholder="User Name" aria-describedby="searchchatpartner" >
                                </div>
                            </div>
                    </div>
                    <div id="list-box"><?php 
                        echo "<table id='users-list'>";
                        while ($row = mysqli_fetch_array($first_sql_result)) {
                            // echo '<td><img src="data:image/jpeg;base64,' . base64_encode($row['profile_photo']) . '"/></td>';
                            echo "<tr class='user-profile clickable-row' data-href='chat.php?user=".$row['user_id']."'><td> <div class='user-name'>".$row['username'].'</div><div class="user-fullname">'.$row["user_first_name"].' '.$row["user_last_name"]."</div></td><td><div>".$row["status"]."</div></td></tr>";
                        }
                        echo "</table>";?>
                    </div>
                </div>
            </div>
        </div>
    </body>
    <?php
        }    
    }
    catch(Exception $e) {
        echo 'Message: ' .$e->getMessage();
    }
    
?>
</html>