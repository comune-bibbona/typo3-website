let radios = document.getElementsByClassName("bit3rating");
for(var i = 0, max = radios.length; i < max; i++) {
    radios[i].onclick = function() {
        document.getElementById("feedbackForm--radiobutton-1-"+(this.value - 1)).checked = true;
        document.getElementById("form-2nd-rating").classList.remove("d-none");
        document.querySelector("[data-step='1']").classList.remove("d-none");
        if (this.value < 4) {
            document.querySelector("[data-element='feedback-rating-positive']").classList.add("d-none");
            document.querySelector("[data-element='feedback-rating-negative']").classList.remove("d-none");
            if((document.querySelector('input[name="ratingPos"]:checked')) !== null){
                document.querySelector("input[name='ratingPos']:checked").checked = false;
            }
        }else{
            document.querySelector("[data-element='feedback-rating-negative']").classList.add("d-none");
            document.querySelector("[data-element='feedback-rating-positive']").classList.remove("d-none");
            if((document.querySelector('input[name="ratingNeg"]:checked')) !== null){
                document.querySelector("input[name='ratingNeg']:checked").checked = false;
            }
        }
    }
}

document.getElementById("form-2nd-back").onclick = function() {
    if (document.querySelector("[data-step='2']").classList.contains("d-none")) {
        document.getElementById("form-2nd-rating").classList.add("d-none");
        document.querySelector("[data-step='1']").classList.add("d-none");
        if(document.querySelector("input[name='ratingA']:checked")){
            document.querySelector("input[name='ratingA']:checked").checked = false;
        }
    }else{
        document.querySelector("[data-step='1']").classList.remove("d-none");
        document.querySelector("[data-step='2']").classList.add("d-none");
    }
}

document.getElementById("form-2nd-next").onclick = function() {
    if (document.querySelector("[data-step='2']").classList.contains("d-none")) {
        document.querySelector("[data-step='1']").classList.add("d-none");
        document.querySelector("[data-step='2']").classList.remove("d-none");
    }else{
        document.getElementById("form-2nd-next").classList.add("d-none");
        document.getElementById("submit-feedback").classList.remove("d-none");
    }
}

let radiosNeg = document.getElementsByClassName("radiosNeg");
for(var i = 0, max = radiosNeg.length; i < max; i++) {
    radiosNeg[i].onclick = function() {
        document.getElementById("feedbackForm--radiobutton-2-"+this.value).checked = true;
        if((document.querySelector('input[name="tx_form_formframework[feedbackForm-][radiobutton-3]"]:checked')) !== null){
            document.querySelector("input[name='tx_form_formframework[feedbackForm-][radiobutton-3]']:checked").checked = false;
        }
    }
}

let radiosPos = document.getElementsByClassName("radiosPos");
for(var i = 0, max = radiosPos.length; i < max; i++) {
    radiosPos[i].onclick = function() {
        document.getElementById("feedbackForm--radiobutton-3-"+this.value).checked = true;
        if((document.querySelector('input[name="tx_form_formframework[feedbackForm-][radiobutton-2]"]:checked')) !== null){
            document.querySelector("input[name='tx_form_formframework[feedbackForm-][radiobutton-2]']:checked").checked = false;
        }
    }
}

let altriDettagli = document.getElementById("altriDettagli");
altriDettagli.addEventListener("focusout", editInput);
function editInput() {
    document.getElementById("feedbackForm--text-1").value = this.value;
}