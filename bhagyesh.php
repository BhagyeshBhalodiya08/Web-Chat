<?php 

echo "bhagyes";
$conn = mysqli_connect("localhost","bhagyesh","Bhagyes@123","web-chat");
if(isset($_POST["reciver"]) && isset($_POST["sender"]) ){
        // $data = array ("reciver_id" => $_POST["reciver_id"],"sender_id" => $_POST["sender_id"]);
        // $msg = getData("*","",$data);
        // $html = "";
        // while($row2 = mysqli_fetch_array($msg)){
        //     if($row2["sender_id"] == $_POST["sender_id"]){
        //         $html .='<div class="chat outgoing"><!-- <img src="" alt=""> --><div class="details">'.$row2["message"].'</div></div>';	
        //     }
        //     if($row2["sender_id"] == $_POST["reciver_id"]){
        //         $html .= '<div class="chat incoming"><div class="details">'.$row2["message"].'</div></div>';	
        //     }
        // }
        return $html = "bhagyesh";
}