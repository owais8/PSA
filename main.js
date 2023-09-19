    document.addEventListener("DOMContentLoaded", function() {
        const gradingOptions = {
            "PSA Bulk 1980-present- $19 per card - Max Declared Value: $499 - Est. Turnaround : 60 Business Days|19": 19,
            "PSA Bulk 1979-older- $19 per card - Max Declared Value: $499 - Est. Turnaround: 60 Business Days|19": 19,
            "PSA Bulk Dual 1980-present - $25 per card - Max Declared Value: $499 - Est. Turnaround: 75 Business Days|25": 25,
            "PSA Value 1980-present- $25 per card - Max Declared Value: $499 - Est. Turnaround: 65 Business Days|25": 25,
            "PSA Value 1979-older- $25 per card - Max Declared Value: $499 - Est. Turnaround: 65 Business Days|25": 25,
            "PSA Value Plus - $40 per card - Max Declared Value: $499 - Est. Turnaround: 20 Business Days|40": 40,
            "PSA Regular- $75 per card - Max Declared Value: $1,499 - Est. Turnaround: 10 Business Days|75": 75,
            "PSA Regular Dual - $110 per card - Max Declared Value: $1,499 - Est. Turnaround: 15 Business Days|110": 110,
            "PSA Express- $170 per card - Max Declared Value: $2,499 - Est. Turnaround: 5 Business Days|170": 170,
            "PSA Express Dual- $215 per card - Max Declared Value: $2,499 - Est. Turnaround: 10 Business Days|215": 215,
            "PSA Super Express- $330 per card - Max Declared Value $4,999 - Est. Turnaround: 3 Business Days|330": 330,
            "2023 NATIONAL ON-SITE GRADING|150": 150
          };
        const evaluateCardsCheck = document.getElementById("evaluateCardsCheck");
        const wipe = document.getElementById("wipeDownService");

        const cardsPrice = document.getElementById("grandTotal");
        const selectedOption = document.getElementById("input_2_24");
        document.getElementById("myForm").addEventListener("submit", function (event) {
            // Get the table element
            var table = document.getElementById("myTable");
            // Check if the table is empty
            if (table.rows.length === 1) {
                alert("Table is empty. Please fill in the table before submitting the form.");
                event.preventDefault(); // Prevent form submission
            }
        });
        // Function to update the price
        evaluateCardsCheck.addEventListener("change", updateEvaluation);
        wipe.addEventListener("change", updateWipeDown);
        wipe.addEventListener("change", updatePrice);
        psaQuantityInput.addEventListener("input", updateWipeDown);


        psaQuantityInput.addEventListener("input", updateEvaluation);
        psaQuantityInput.addEventListener("input", updatePrice);
        selectedOption.addEventListener("change", updatePrice);
        function updateEvaluation() {
            const quantity = document.getElementById("psaQuantityInput").value
            const isEvaluationChecked = evaluateCardsCheck.checked;
            document.getElementById("card_quantity").value = quantity;
            if (isEvaluationChecked) {
                evaluationPrice.textContent = "$" + (4 * quantity).toFixed(2);
                document.getElementById("total_evaluation_price").value = "$" + (4 * quantity).toFixed(2);

            } else {
                evaluationPrice.textContent = "$0.00";
                document.getElementById("total_evaluation_price").value = "$0.00";

            }
            updateTotalPrice();


            if (isEvaluationChecked) {
                return "$" + (4 * quantity).toFixed(2)
            } else {
                return "$0.00"
            }

        }
        updateEvaluation();
        function updateWipeDown() {
            const quantity = document.getElementById("psaQuantityInput").value
            const isWipeChecked = wipe.checked;
            document.getElementById("card_quantity").value = quantity;
            if (isWipeChecked) {
                wipeDownPrice.textContent = "$" + (1.5 * quantity).toFixed(2);
                document.getElementById("total_wipe_down_price").value = "$" + (1.5 * quantity).toFixed(2);

            } else {
                wipeDownPrice.textContent = "$0.00";
                document.getElementById("total_wipe_down_price").value = "$0.00";

            }
            updateTotalPrice();
        }

       function updatePrice(){
            const quantity = document.getElementById("psaQuantityInput").value
            const selectedOptionValue = document.getElementById("input_2_24").value;
            document.getElementById("card_value").value = selectedOptionValue;
            const price = gradingOptions[selectedOptionValue];
            const totalPrice = price * quantity;
            cardsPrice.textContent = "$" + (totalPrice).toFixed(2);
            updateTotalPrice();
            document.getElementById("total_grading_price").value = "$" + (totalPrice).toFixed(2);

            return "$" + (totalPrice).toFixed(2)


        }
        function updateTotalPrice() {

            const evaluationPriceValue = parseFloat(evaluationPrice.textContent.replace("$", ""));
            const wipeDown = parseFloat(wipeDownPrice.textContent.replace("$", ""));

            const cardsPriceValue = parseFloat(cardsPrice.textContent.replace("$", ""));
            console.log(wipeDown)
            const total = evaluationPriceValue + cardsPriceValue+wipeDown;
    
            document.getElementById("totalPrice").textContent = "$" + total.toFixed(2);
            document.getElementById("total_price").value = "$" + total.toFixed(2);;

            return "$" + total.toFixed(2)
        }
        updateTotalPrice();
        const modal = document.getElementById("largeScrollableModal");
        const saveChangesButton = modal.querySelector("#group_data");
        const serviceProviderSelect = modal.querySelector("#serviceProviderSelect");
    
        // Get reference to the table body where data will be appended
        const tableBody = document.querySelector("tbody");
    
        // Add a click event listener to the "Save changes" button
        saveChangesButton.addEventListener("click", function () {
          // Retrieve values from the modal form fields
          const serviceProvider = serviceProviderSelect.value;
          // Create a new row in the table
          const newRow = tableBody.insertRow();
    
          // Insert cells for each column in the table
          const serviceProviderCell = newRow.insertCell(0);
          const gradingSubtotalCell = newRow.insertCell(1);
          const evaluationSubtotalCell = newRow.insertCell(2);
          const totalCell = newRow.insertCell(3);
          // Set the cell values with the retrieved data
          serviceProviderCell.textContent = serviceProvider;
          gradingSubtotalCell.textContent = updatePrice();
          evaluationSubtotalCell.textContent = updateEvaluation(); // You can add evaluation subtotal logic here
          totalCell.textContent =updateTotalPrice(); // You can add total logic here    
          // Close the modal
          document.getElementById("service_provider").value = serviceProvider;

          let myModalEl = document.getElementById('largeScrollableModal')
          let modal = bootstrap.Modal.getInstance(myModalEl)
          modal.hide()
        });
    });





