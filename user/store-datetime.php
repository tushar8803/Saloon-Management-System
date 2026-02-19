
<?php
session_start();

if(isset($_POST['date']) && isset($_POST['time'])){

    $_SESSION['appointment_date'] = $_POST['date'];
    $_SESSION['start_time'] = $_POST['time'];

    if(isset($_SESSION['total_duration'])){
        $duration = intval($_SESSION['total_duration']);
        $start = strtotime($_POST['time']);
        $end = date("H:i:s", strtotime("+$duration minutes", $start));
        $_SESSION['end_time'] = $end;
    } else {
        // optional: set end_time to start if duration unknown
        $_SESSION['end_time'] = $_POST['time'];
    }

    echo "success";
    exit;
}

// if we reach here with no POST, return helpful debug text (remove in production)
echo "no-post-data";
?>

