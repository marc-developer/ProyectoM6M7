let username = document.getElementById("username");
let email = document.getElementById("email");

username.addEventListener("focusout", function(){
    if(username.value ==="") {
        username.style.borderColor = "red";

    }else {
        username.style.borderColor = "green";

    }
});

function validateEmail(email) {
    if(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email)) {
        return true;
    }
    else {
        return false;
    }
}

email.addEventListener("focusout", function() {
    if(validateEmail(document.getElementById("email").value)) {
        email.style.borderColor = "green";
    }
    else {
        email.style.borderColor = "red";
    }
});

let inputPwd = document.getElementById("password");
inputPwd.addEventListener('input', (e) => {
    let pwd = inputPwd.value;
    let lowerCase = /[a-z]/g;
    let upperCaseLetters = /[A-Z]/g;
    let numbers = /[0-9]/g;
    let specialChars = /[`!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?~]/;

    if(lowerCase.test(pwd) ){
        document.querySelector('#msgLowerCase').style.color="green";
    }else{
        document.querySelector('#msgLowerCase').style.color="red";
    }

    if(pwd.length>=8 && pwd.length<=15) {
        document.querySelector('#msgLenght').style.color ="green";
    }
    else {
        document.querySelector('#msgLenght').style.color="red";
    }

    if(upperCaseLetters.test(pwd)) {
        document.querySelector('#msgUpperCase').style.color="green";
    }
    else {
        document.querySelector('#msgUpperCase').style.color="red";
    }

    if(numbers.test(pwd)) {
        document.querySelector('#msgNumbers').style.color="green";
    }
    else {
        document.querySelector('#msgNumbers').style.color="red";
    }

    if(specialChars.test(pwd)) {
        document.querySelector('#msgSpecialChars').style.color="green";
    }
    else {
        document.querySelector('#msgSpecialChars').style.color="red";
    }

});

let inputPwdRepeat = document.getElementById("passwordConfirm");
if(inputPwdRepeat.value === inputPwd.value) {
    inputPwdRepeat.style.borderColor = "green";
}
else {
    inputPwdRepeat.style.borderColor = "red";
}
