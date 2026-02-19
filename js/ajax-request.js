console.log("ajax-request.js loaded"); //safety check
document.getElementById("appointment_date")   //select html element whose id=appontment_date
    .addEventListener("change", function () {       //change event means:whenever user selects a new date run this function

        let date = this.value;
        let duration = document.getElementById("total_duration").value;
        let staff_id = document.getElementById("staff_id").value;

        let xhr = new XMLHttpRequest();    // xhr is a ajax object and think it as a Prepared  request box to send to server.
        xhr.open("POST", "fetch-slots.php", true);   //Method → POST,File → fetch_slots.php,true → asynchronous(no page reload)
                                                      //Sending data to fetch-slots.php using POST method.



        // this tells server:I am sending normal form data.
        // Like:date=2026-02-20&duration=45&staff_id=2
        // Without this header → PHP may not read POST properly.
        xhr.setRequestHeader("Content-type",
            "application/x-www-form-urlencoded");

        xhr.onload = function () {
            document.getElementById("time_slots")    //this function runs when the server sends response back
                .innerHTML = this.responseText;  
        }

       // Important.

/*this.responseText = Whatever PHP printed.

For example:

<h3>Morning</h3>
<button>09:00 AM</button>
<button>09:30 AM</button>

We insert that inside:
<div id="time_slots"></div>

So slots appear dynamically.

No page refresh */

        xhr.send("date=" + date +
            "&duration=" + duration +
            "&staff_id=" + staff_id);
    });

   
/*This is where data is actually sent.

Final data format becomes:

date=2026-02-20&duration=45&staff_id=2
Then in PHP you receive it like:

$date = $_POST['date'];
$duration = $_POST['duration'];
$staff_id = $_POST['staff_id'];
*/


