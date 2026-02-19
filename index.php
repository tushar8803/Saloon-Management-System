 <?php session_start(); 
   
   ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Salon Navigation Bar</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
   


    <nav class="navbar">
        <!-- Logo area -->
        <div class="logo-space">
            <img id="logomain" src="assets/images/mainlogo.svg" alt="">
        </div>

        <!-- Navigation links -->
        <ul class="nav-links">
            <li><a href="#">Home</a></li>
            <li><a href="Service.html">Services</a></li>
            <li><a href="#">Choose Barber</a></li>
            <li><a href="#">Contact Us</a></li>
            <li><a href="sign-up.php">Login</a></li>
            <li><a href="logout.php">logout</a></li>
        </ul>
    </nav>
    <div id="HeroImageContainer">
        <img class="img" src="assets/images/HeroImage.avif" alt="">
        <div class="text-overlay">
            <div>Welecome to The Gents Place</div>
            <div>Premium Grooming for the modern Gentleman
                1797 COVENTRY RD, CLEVELAND HEIGHTS, OH 44118</div>
            <div>CALL US: 216-795-5185</div>
            
            <div>
            <?php if(isset($_SESSION['user'])){ ?>
                  
                 <a href="user/select-service.php">
                      <button class="book-btn">Book Next Available</button>
                 </a>
            <?php } else { ?>
               <a href="login.php">
                <button class="book-btn">Book Next Available</button>
               </a>
             <?php } ?>


             </div>

            
                
            



        </div>
    </div>

    <div class="Staff-Section">
        <h1 class="Heading">
            <span class="meet-our-staff-heading">MEET OUR STAFF</span>
        </h1>

        <section class="staff-section">

            <div class="staff-card">
                <img src="assets/images/noahcarterbarber.avif" alt="Noah Carter">

                <div class="staff-card-items-except-image">
                    <h3>NOAH CARTER</h3>

                    <p>
                        Professional barber, Noah Carter has been a staple of customer satisfaction at Eddy’s Barbershop
                        for several years. Skilled in the art of fades, long flows, gentleman’s cuts, beard trims,
                        shaves, and much more. Whether you’re looking for a clean, tight trim for that professional
                        appointment or a total transformation, Noah is your man.
                    </p>

                    <button>BOOK WITH NOAH</button>
                </div>
            </div>

            <div class="staff-card">
                <img src="assets/images/rebbecabarber.jpeg" alt="Rebecca Britz">
                <div class="staff-card-items-except-image">

                    <h3>REBECCA BRITZ</h3>

                    <p>
                        Rebecca is a licensed barber who has been cutting hair in the Cleveland area for over 10 years.
                        A staple at Eddy's, she is a master of gentlemen's cuts, fades, beard trims, shaves, and
                        facials. Book with Rebecca for an unforgettable experience.
                    </p>

                    <button>BOOK WITH REBECCA</button>
                </div>
            </div>


            <div class="staff-card">
                <img src="assets/images/marcusJoewrightbarber.avif" alt="Rebecca Britz">
                <div class="staff-card-items-except-image">

                    <h3>MARKUS JOERIGHT</h3>

                    <p>
                        Markus has been cutting hair in the Greater Cleveland area for over 20 years. During this time,
                        he has mastered the the art of men’s grooming in all styles. Regardless if your hair is long and
                        short, Markus looks forward to seeing you in his chair.
                    </p>

                    <button>BOOK WITH MARKUS</button>
                </div>
            </div>


            <div class="staff-card">
                <img src="assets/images/robLoganBarber.jpeg" alt="Rebecca Britz">
                <div class="staff-card-items-except-image">

                    <h3>ROB LOGAN</h3>

                    <p>
                        Born and raised in Cleveland Ohio. I love modern, and classic haircut’s and beard trims. My
                        favorite thing about barbering is it allows me to be creative while connecting with people. I
                        always look forward to a great conversation during our time together.
                    </p>

                    <button>BOOK WITH ROB LOGAN</button>
                </div>
            </div>



        </section>


    </div>
    <section>
        <h1 class="Heading meet-our-staff-heading-area our-work"> OUR WORK</h1>
        <div id="video-section">

            <div>
                <video src="assets/videos/video1.mp4" autoplay muted loop playsinline></video>
            </div>

            <div>
                <video src="assets/videos/video2.mp4" autoplay muted loop playsinline></video>
            </div>

            <div>
                <video src="assets/videos/video3.mp4" autoplay muted loop playsinline></video>
            </div>
        </div>
    </section>

    <section class="contact-section">
        <div class="contact-container">

            <div class="contact-box">
                <h2>SAY HELLO</h2>
                <span>Drop Us A Line!</span>
                <p>PHONE: 216-795-5185</p>
            </div>

            <div class="contact-box">
                <h2>ADDRESS</h2>
                <span>Come Say Hello!</span>
                <p>
                    1797 Coventry Rd.<br>
                    Cleveland Heights, OH 44118
                </p>
            </div>

            <div class="contact-box">
                <h2>HOURS</h2>
                <span>Come Get Cut!</span>
                <ul>
                    <li>Sunday: 9am-5pm</li>
                    <li>Monday: 9am-7pm</li>
                    <li>Tuesday: 9am-7pm</li>
                    <li>Wednesday: 9am-7pm</li>
                    <li>Thursday: 9am-7pm</li>
                    <li>Friday: 9am-7pm</li>
                    <li>Saturday: 9am-6pm</li>
                </ul>
            </div>

        </div>
    </section>



</body>

</html>