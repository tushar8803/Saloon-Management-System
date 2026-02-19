<?php
// 1️⃣ PHP SECTION (LOGIC PART)
session_start();
include("../config/db.php");

// Fetch services
$result = mysqli_query($conn, "SELECT * FROM services");

// check If form submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $_SESSION['selected_services'] = $_POST['services'];
    header("Location: select-stylist.php");
    exit();
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Select Services</title>
    <!-- <link rel="stylesheet" href="../assets/css/select-service.css"> -->

    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fjalla+One&display=swap" rel="stylesheet">
    <style>
          body {
        font-family: Arial;
        background: #ffe5cc;
        font-family: 'Montserrat', sans-serif;
    }


    .main-header {
        background: #ffb266;
        padding: 15px 50px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        position: sticky;
        top: 0;
        z-index: 1000;
        width: 100%;
        font-family: "Fjalla One", sans-serif;
        font-weight: 500;
        font-style: normal;
    }

    .header-content {
        display: flex;
        justify-content: space-between;
        align-items: center;
        max-width: 1200px;
        margin: 0 auto;
    }

    .logo {
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .logo img {
        height: 50px;
        width: auto;
    }

    .logo h1 {
        font-size: 1.5rem;
        color: black;
        margin: 0;
        font-family: 'Montserrat', sans-serif;
        font-size: 30px;
    }

    .page-title h2 {
        margin: 0;
        font-size: 1.2rem;
        color: black;
        text-transform: uppercase;
        letter-spacing: 2px;
        font-size: 40px;
    }

    .header-right {
        font-weight: bold;
        color: black;
        font-size: 30px;
    }

    /* Adjust your container margin since we added a header */
    .container {
        margin-top: 30px;
        /* Reduced from 250px to make it look tighter */
    }

    /* Adjust your container margin since we added a header */
    .container {
        margin-top: 30px;
        /* Reduced from 250px to make it look tighter */
    }

    .container {
        display: flex;
        gap: 100px;
        padding: 40px;
        margin-left: 250px;
    }

    .services-list {
        width: 40%;
    }

    .service-card {
        background: #ffcc99;
        padding: 15px;
        margin-bottom: 15px;
        border-radius: 8px;
        cursor: pointer;
    }

    .service-card label {
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .service-card:hover {
        background: #ffb266;
        ;
        transform: translateY(-2px);
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.09);
    }

    /* Container to align items */
    .highlight-container {
        display: flex;
        align-items: center;
        /* Vertically centers the dot with the badges */
        gap: 10px;
        margin-top: 10px;
    }

    /* Your 'Explore Category' style badges */
    .price-badge,
    .duration-badge {
        background-color: #ff9933;
        color: white;
        padding: 5px 14px;
        border-radius: 4px;
        font-size: 0.8rem;
        font-weight: bold;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    /* Styling the separator dot */


    /* Optional: Make the duration badge a different color to help it stand out */
    .duration-badge {
        background-color: #444;
    }

    .summary {
        width: 25%;
        background: #ffcc99;
        padding: 20px;
        border-radius: 8px;
        height: fit-content;
        margin-top: 4px;
    }

    .next-btn {
        width: 100%;
        padding: 12px;
        background: #ffb266;
        color: Black;
        border: none;
        margin-top: 20px;
        cursor: pointer;
        border-radius: 8px;

    }

    .next-btn:hover {
        background-color: #ff9933;
    }

    .service-img {
        width: 100px;
        height: 100px;
        object-fit: cover;
        border-radius: 10px;
        flex-shrink: 0;
    }

    .service-info {
        flex-grow: 1;
        width: 100%;

    }
    </style>


    
    
</head>

<body>

    <header class="main-header">
        <div class="header-content">
            <div class="logo">
                <img src="../assets/logo.png" alt="Saloon Logo">
                <h1>The Gent's Place</h1>
            </div>

            <div class="page-title">
                <h2>Select Services</h2>
            </div>

            <div class="header-right">
                <span>Contact: +91 98765 43210</span>
            </div>
        </div>
    </header>

    <form method="POST">
        <div class="container">
            <div class="services-list">
                <?php while($row = mysqli_fetch_assoc($result)) { ?>
                <div class="service-card">
                    <label class="card-layout">
                        <input type="checkbox" name="services[]" value="<?php echo $row['id']; ?>"
                            data-name="<?php echo $row['service_name']; ?>" data-price="<?php echo $row['price']; ?>"
                            data-duration="<?php echo $row['duration']; ?>" class="service-checkbox">

                        <img src="data:image/jpeg;base64,<?php echo base64_encode($row['image']); ?>"
                            class="service-img" alt="service">

                        <div class="service-info">
                            <h3><?php echo $row['service_name']; ?></h3>
                            <div class="highlight-container">
                                <span class="price-badge">&#8377; <?php echo $row['price']; ?></span>

                                <span class="duration-badge">DURATION: <?php echo $row['duration']; ?>min</span>
                            
                            </div>
                        </div>
                    </label>
                </div>
                <?php } ?>
            </div>

            <div class="summary">
                <h2>Appointment Summary</h2>
                <div id="summary-list"></div>
                <div id="total-price"></div>
                <button type="submit" class="next-btn">Next</button>
            </div>
        </div>
    </form>


    <script src="../assets/js/select-service.js"></script>
</body>

</html>