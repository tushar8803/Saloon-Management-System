<?php
session_start();
include("../config/db.php");

if(!isset($_SESSION['selected_services']) || 
   !isset($_SESSION['selected_stylist'])){
    header("Location: select-services.php");
    exit();
}

$service_ids = $_SESSION['selected_services'];   //storing selected staff id & services id's from previous pages
$staff_id = $_SESSION['selected_stylist'];

$id_list = implode(",", $service_ids);  //converted array($service_ids ) into comma seperated string

$result = mysqli_query($conn,
    "SELECT * FROM services WHERE id IN ($id_list)"  //fetching selected services rows 
);

$total_price = 0;
$total_duration = 0;
$selected_services = [];

while ($service = mysqli_fetch_assoc($result)) {
    $selected_services[] = $service;     //storing a row one by one in form of array into $selected_services[] 
    $total_price += $service['price'];             
    $total_duration += $service['duration'];
}
$_SESSION['total_duration'] = $total_duration;    //to calculate end time in store-datetime.php


// Fetch barbers
$barbers = mysqli_query($conn, "SELECT * FROM stylists");

?>

<!DOCTYPE html>
<html>
<head>
    <title>Select Date & Time</title>
</head>
<body>

<h2>Select Appointment Date</h2>

<input type="date" id="appointment_date" 
       min="<?= date('Y-m-d') ?>">

<input type="hidden" id="total_duration" 
       value="<?= $total_duration ?>">

<input type="hidden" id="staff_id" 
       value="<?= $staff_id ?>">

<div id="time_slots"></div>

<script src="../assets/js/ajax-request.js"></script>
<script src="../assets/js/select-datetime.js"></script>


</body>
</html>
