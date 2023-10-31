document.getElementById("search-faq").onkeyup = function() {
    let accordionItems;
    if (this.value.length > 1) {
        accordionItems = document.querySelector(".accordion").childNodes;
        let inputValue = document.getElementById("search-faq").value.toUpperCase();
        for (i = 0; i < accordionItems.length; i++) {
            buttonText = accordionItems[i].querySelector("span.faq").innerText;
            if (buttonText.toUpperCase().indexOf(inputValue) > -1) {
                accordionItems[i].style.display = "";
            } else {
                accordionItems[i].style.display = "none";
            }
        }
    } else {
        accordionItems = document.querySelector(".accordion").childNodes;
        for (i = 0; i < accordionItems.length; i++) {
            accordionItems[i].style.display = "";
        }
    }
}