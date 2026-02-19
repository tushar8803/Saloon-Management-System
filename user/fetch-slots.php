<?php
include("../config/db.php");

$date = $_POST['date'];
$duration = $_POST['duration'];  //getting data send by ajax request
$staff_id = $_POST['staff_id'];

$opening_time = "09:00:00";    //saloon working hours
$closing_time = "20:00:00";

$available_slots = [];   //empty array to store free time slots

/* Get already booked appointments */
$booked_query = mysqli_query($conn,      //fetching already booked timeslots of the selected stylist on selected date
    "SELECT start_time, end_time 
     FROM appointments
     WHERE stylist_id = '$staff_id'
     AND appointment_date = '$date'
     AND status = 'booked'"
);

$booked_slots = [];    //empty array for storing fetched rows $booked_query

while($row = mysqli_fetch_assoc($booked_query)){
    $booked_slots[] = $row;      // storing fetched rows in array as an element of type array one by one through while in 
                                 //$booked_slots[]                               
}

/* Generate all possible slots */
$start = strtotime($opening_time);   //converting time into seconds format for easily calculations
$end = strtotime($closing_time);

//while loop is creating all possible time slots of the selected date
while($start < $end){    // keep running the loop until saloon openingtime<closing time

    $slot_start = date("H:i:s", $start);      //converting $start time of slot which is in(seconds) into human readable h:i:s format
    $slot_end = date("H:i:s",
                strtotime("+$duration minutes", $start));   //adding 45min into start time of slot

    if(strtotime($slot_end) > strtotime($closing_time)){   //if slot_end > saloon closing time then break;
        break;
    }

    $is_available = true;
/*foreach loop-checking overlapping
Now we check:Does this new slot overlap with any booked slot which is stored in array $booked_slots[] ?*/
    foreach($booked_slots as $booked){   

        if(
           $slot_start < $booked['end_time'] &&   //from the first possible slot: the slot starting time needs to be less than
           $slot_end > $booked['start_time']       //existing booked slot end timing  & new slot end timing needs to be greater
        ){                                       //  existing booked slot start time refer to example at the end of this file
            $is_available = false;              // if the if condition is true then set $is_available=false to make the slot 
            break;                               //unusable for future
        }                                       //break is overlapping happens before full traversal of $booked_slots array
    }

    if($is_available){                          // if $is_available value is true then store the $slot_start time into array
        $available_slots[] = $slot_start;
    }

    $start = strtotime("+30 minutes", $start);       //increasing start by 30 minutes
}

/* Divide into Morning, Afternoon, Evening */

$morning = [];
$afternoon = [];
$evening = [];

foreach($available_slots as $slot){

    $hour = date("H", strtotime($slot));

    if($hour < 12){
        $morning[] = $slot;
    }
    elseif($hour < 17){
        $afternoon[] = $slot;
    }
    else{
        $evening[] = $slot;
    }
}

/* Display Slots */

function printSlots($title, $slots){
    if(!empty($slots)){
        echo "<h3>$title</h3>";
        foreach($slots as $slot){
            echo "<button class='time-btn' 
        data-time='$slot'>
        ".date("h:i A", strtotime($slot))."
      </button>";

        }
    }
}

printSlots("Morning", $morning);
printSlots("Afternoon", $afternoon);
printSlots("Evening", $evening);

if(empty($available_slots)){
    echo "<p>No available slots for this date.</p>";
}
?>

<!-- Example 1 (Overlap)

Booked: 10:00 - 10:45
New Slot: 10:30 - 11:15

Check:

10:30 < 10:45 ✔
11:15 > 10:00 ✔


So overlap → not available.   -->