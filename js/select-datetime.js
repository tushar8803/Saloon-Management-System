// at top for debugging
console.log("select-datetime.js loaded");

document.addEventListener("click", function(e){
    // safer detection for elements inside button
    let btn = e.target.closest(".time-btn");
    if (!btn) return;

    console.log("Time button clicked:", btn.dataset.time);

    let selectedTime = btn.dataset.time;
    let selectedDate = document.getElementById("appointment_date").value;

    // sanity checks
    if(!selectedDate){
        console.log("No date selected");
        return;
    }
    if(!selectedTime){
        console.log("No time in data-time attribute");
        return;
    }

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "store-datetime.php", true);

    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    xhr.onload = function(){
        console.log("store-datetime response:", this.responseText);
        if(this.responseText.trim() === "success"){
            window.location.href = "confirmation.php";
        } else {
            // helpful debug message
            alert("Could not store appointment. Response: " + this.responseText);
        }
    }

    xhr.onerror = function(){
        console.log("AJAX request failed");
    }

    xhr.send("date="+encodeURIComponent(selectedDate) +
             "&time="+encodeURIComponent(selectedTime));
});
//above code is helpful for debugging
document.addEventListener("click", function(e){

    if(e.target.classList.contains("time-btn")){

        let selectedTime = e.target.dataset.time;
        let selectedDate = 
            document.getElementById("appointment_date").value;

        let xhr = new XMLHttpRequest();
        xhr.open("POST", "store-datetime.php", true);
        xhr.setRequestHeader("Content-type",
            "application/x-www-form-urlencoded");

        xhr.onload = function(){
            if(this.responseText == "success"){
                window.location.href = "confirmation.php";
            }
        }

        xhr.send("date="+selectedDate+
                 "&time="+selectedTime);
    }
});
