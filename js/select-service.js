const checkboxes = document.querySelectorAll('.service-checkbox');
    const summaryList = document.getElementById('summary-list');
    const totalPriceDiv = document.getElementById('total-price');

    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', updateSummary);
    });

    function updateSummary() {
        summaryList.innerHTML = '';
        let total = 0;
        let totalDuration = 0;

        checkboxes.forEach(checkbox => {
            if (checkbox.checked) {
                // Accessing data attributes from the checkbox
                const name = checkbox.dataset.name;
                const price = parseFloat(checkbox.dataset.price);
                const duration = parseInt(checkbox.dataset.duration);

                total += price;
                totalDuration += duration;

                // FIXED: Removed the space between $ and {
                summaryList.innerHTML += `
                    <div class="summary-item">
                        <p>
                            <strong>${name}</strong><br>
                            ₹${price} (${duration} min)
                        </p>
                    </div>`;
            }
        });

        if (total === 0) {
            totalPriceDiv.innerHTML = '<p>No services selected</p>';
            return;
        }

        // FIXED: Corrected template literal syntax for totals
        totalPriceDiv.innerHTML = `
            <hr>
            <h3>Total Price: ₹${total}</h3>
            <h4>Total Duration: ${totalDuration} min</h4>
        `;
    }