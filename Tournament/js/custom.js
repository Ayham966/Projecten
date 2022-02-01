// show password scheidsrechters page

function myFunction() {
    var x = document.getElementById("psw_input");
    var y = document.getElementById("psw_input2");
    if (x.type && y.type === "password") {
        x.type = "text";
        y.type = "text";

    } else {
        x.type = "password";
        y.type = "password";
    }
}


