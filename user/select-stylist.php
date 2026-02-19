<?php
session_start();
include("../config/db.php");

if (!isset($_SESSION['selected_services']) || empty($_SESSION['selected_services'])) {
    header("Location: select-services.php");
    exit();
}

$service_ids = $_SESSION['selected_services'];

// Convert array to comma separated string
$id_list = implode(",", $service_ids);

// Fetch selected services details
$services_query = mysqli_query($conn, 
    "SELECT * FROM services WHERE id IN ($id_list)"
);

$total_price = 0;
$total_duration = 0;
$selected_services = [];

while ($service = mysqli_fetch_assoc($services_query)) {
    $selected_services[] = $service;     //storing a row one by one in form of array into $selected_services[] 
    $total_price += $service['price'];             
    $total_duration += $service['duration'];
}

// Fetch barbers
$barbers = mysqli_query($conn, "SELECT * FROM stylists");

// When barber selected
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $_SESSION['selected_stylist'] = $_POST['barber_id'];
    header("Location: select-time&date.php");
    exit();
}
?>



<!DOCTYPE html>
<html>
<head>
    <title>Select Barber</title>
    <link rel="stylesheet" href="../assets/css/select-stylist.css">
</head>
<body>

<div class="container">

    <h2>Select Your Barber</h2>

   <div class="summary-box">
    <h3>Booking Summary</h3>

    <?php foreach($selected_services as $service) { ?>
        <p>
            <?php echo $service['service_name']; ?> 
            - ₹<?php echo $service['price']; ?> 
            (<?php echo $service['duration']; ?> min)
        </p>
    <?php } ?>

    <hr>

    <p><strong>Total Price:</strong> ₹<?php echo $total_price; ?></p>
    <p><strong>Total Duration:</strong> <?php echo $total_duration; ?> minutes</p>
</div>


    <form method="POST">

        <?php while($barber = mysqli_fetch_assoc($barbers)) { ?>

            <div class="barber-card">

                <div class="barber-left">
                    <!-- <img src="uploads/<?php echo $barber['photo']; ?>" alt="Barber"> -->
                     <img src="" alt="">

                    <div class="barber-info">
                        <h4><?php echo $barber['name']; ?></h4>
                        <!-- <p><?php echo $barber['experience']; ?> years experience</p>
                        <p><?php echo $barber['speciality']; ?></p>  -->
                    </div>
                </div>

                <div class="select-btn">
                    <input type="radio" name="barber_id"
                           value="<?php echo $barber['id']; ?>" required>
                </div>

            </div>

        <?php } ?>

        <button type="submit" class="continue-btn">
            Continue to Date & Time
        </button>

    </form>

</div>

</body>
</html>

<!-- $selected_services = [

   [
      'id' => 2,
      'name' => 'Haircut',
      'price' => 300,
      'duration' => 30
   ],

   [
      'id' => 4,
      'name' => 'Beard Trim',
      'price' => 150,
      'duration' => 15
   ]

]; -->
