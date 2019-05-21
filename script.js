function switchForm() {
    // Get the checkbox
    var checkBox = document.getElementById("formCheck");
    // Get the output text
    var text = document.getElementById("mytextarea");
    var plain = document.getElementById("plain");

    // If the checkbox is checked, display the output text
    if (checkBox.checked == true){
        //text.style.display = "block";
        text.style.display = "none";
        plain.style.display = "block";
    } else {
        //text.style.display = "none";
        plain.style.display = "block";
        plain.style.display = "block";
    }
}

function check() {
    // Get the checkbox
    var checkBox = document.getElementById("myCheck");
    // Get the output text
    var text = document.getElementById("text");

    // If the checkbox is checked, display the output text
    if (checkBox.checked == true){
        text.style.display = "block";
    } else {
        text.style.display = "none";
    }
}

