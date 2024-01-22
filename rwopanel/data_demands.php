<?php

include '../components/connect.php';

session_start();

$unique_id = $_SESSION['unique_id'];

if(!isset($unique_id)){
   header('location:admin_login.php');
}

$show_data = $conn->prepare("SELECT * FROM `demand_list`");
$show_data->execute();
while($row = $show_data->fetch(PDO::FETCH_ASSOC))
{
    $data[] = $row;
}

    if(!empty($data)){
        echo json_encode($data);
    }


?>