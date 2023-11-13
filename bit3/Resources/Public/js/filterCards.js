document.getElementById("search-card").onkeyup = function() {
    let cardItems;
    if (this.value.length > 1) {
        cardItems = document.querySelector(".filterCard").childNodes;
        let inputValue = document.getElementById("search-card").value.toUpperCase();
        for (i = 0; i < cardItems.length; i++) {
            buttonText = cardItems[i].querySelector("a.cardTitle").innerText;
            if (buttonText.toUpperCase().indexOf(inputValue) > -1) {
                cardItems[i].style.display = "";
            } else {
                cardItems[i].style.display = "none";
            }
        }
    } else {
        cardItems = document.querySelector(".filterCard").childNodes;
        for (i = 0; i < cardItems.length; i++) {
            cardItems[i].style.display = "";
        }
    }
}