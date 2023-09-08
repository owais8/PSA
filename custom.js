document.addEventListener("DOMContentLoaded", function() {
    const cardSelect = document.querySelector(".custom-select.card-select");
    const selectedCard = document.querySelector(".custom-select .selected-card");
    const cardSelectionInput = document.querySelector("#card_selection");
    const cardOptions = document.querySelectorAll(".custom-select .options .option");
    cardSelect.addEventListener("click", function() {
        cardSelect.classList.toggle("open");
    });

    cardOptions.forEach(option => {
        option.addEventListener("click", function(e) {
            e.stopPropagation(); // Prevent the click event from reaching the document
            const selectedValue = option.getAttribute("data-value");
            cardSelectionInput.value = selectedValue;
            selectedCard.innerHTML = option.innerHTML;
            cardSelect.classList.remove("open");
        });
    });
    const cardOption = document.querySelectorAll(".custom-select .options .option");
    cardOption.forEach(option => {
        option.addEventListener("click", function(e) {
            e.stopPropagation(); // Prevent the click event from reaching the document
            const selectedValue = option.getAttribute("data-value");
            console.log(selectedValue);
            const values = selectedValue.split('|').map(value => value.trim());
            document.getElementById('card_selection').value = values[0].trim();
            document.getElementById('price').value = values[1].trim();
            document.getElementById('dv').value = values[2].trim();
        });
    });


  

});