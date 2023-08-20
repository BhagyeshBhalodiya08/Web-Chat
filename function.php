<?php
$conn = mysqli_connect("localhost", "bhagyesh", "Bhagyesh@123", "web-chat");
function InsertData($field,$value,$table){
    global $conn;
    if($table){
        $insert = $conn->query("INSERT into registered_user ($field) VALUES ($value ,NOW())"); 
    }else{
        $insert = $conn->query("INSERT into messages ($field) VALUES ($value ,NOW())"); 
    }
    return $insert ? true :false; 
}
function getData($field,$fieldname,$where,$table = 0){
    global $conn;
    $string = "";
    $count = 1;
    if(is_array($fieldname)){
        $tbl = $table ? "registered_user":"messages";
        foreach ($fieldname as $key => $value) {
            if($count == 1){
                $string .= $key." = '". $value."'";
            }else{
                $string .= " && ".$key."='". $value."'";
            }
            $count++;
        }
        $sql = "SELECT ".$field." from ".$tbl." WHERE ".$string .";";
        return $conn->query($sql); 
    }
    if(is_array($where)){
        return $conn->query("SELECT ".$field." from messages"); 
    }
    if($fieldname){
        
        return $conn->query("SELECT ".$field." from messages WHERE ".$fieldname ."='". $where."'"); 
    }
}