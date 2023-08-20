<?php 
$conn = mysqli_connect("localhost","bhagyesh","Bhagyes@123","web-chat");
if(isset($_POST["search"])){
    $searchCriteria = $_POST["search"];
    $second_sql = "SELECT * FROM `registered_user` WHERE (`username` LIKE '%$searchCriteria%' OR `status` LIKE '%$searchCriteria%' OR `user_first_name` LIKE '%$searchCriteria%' OR `user_last_name` LIKE '%$searchCriteria%' OR `profile_photo` LIKE '%$searchCriteria%' OR `email_address` LIKE '%$searchCriteria%') "; 
    $second_sql_result = mysqli_query($conn, $second_sql);
    $respose = "<tbody>";
    while ($second_row = mysqli_fetch_array($second_sql_result)) {
        $respose .= "<tr class='user-profile'>";
        // echo '<td><img src="data:image/jpeg;base64,' . base64_encode($second_row['profile_photo']) . '"/></td>';
        $respose .= '<td> <div class="user-name">'.$second_row['username']."</div><div class='user-fullname'>".$second_row['user_first_name']." ".$second_row['user_last_name'].'</div></td>';
        $respose .= '<td><div>'.$second_row['status'].'</div></td></tr>';
    }
    $respose .= "<tbody>";
    echo $respose;
}