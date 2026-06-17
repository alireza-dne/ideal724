const registerForm = document.querySelector('.register-form')
const RegisterEmail = registerForm.querySelector("input[name='email']")
const RegisterUsername = registerForm.querySelector("input[name='username']")
const RegisterPassword = registerForm.querySelector("input[name='password']")
const RegisterConfirmPassword = registerForm.querySelector("input[name='confirm-password']")
const finalMessageRegister = document.querySelector('.final-message-register');


registerForm.onsubmit = function(e) {
    e.preventDefault();
    registerStore();
}


function registerStore() {
    let targetUrl = registerForm.getAttribute('action');

    let xmlHttp = new XMLHttpRequest();
    xmlHttp.onreadystatechange = function() {
        if (xmlHttp.readyState == 4 && xmlHttp.status == 200) {
            var jsonData = JSON.parse(xmlHttp.responseText);
            let data = jsonData;
            console.log(data);
            checkRegister(data);
        }
    }
    xmlHttp.open('POST', targetUrl, true);
    xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    let data = { "email": RegisterEmail.value, "username": RegisterUsername.value, "password": RegisterPassword.value, "confirm-password": RegisterConfirmPassword.value };
    data = JSON.stringify(data)
    xmlHttp.send(data);
}


function checkRegister(data) {
    if (data.email) {
        if (data.email.status == false) {
            RegisterEmail.parentElement.classList.remove('success');
            RegisterEmail.parentElement.classList.add('error');
            RegisterEmail.parentElement.querySelector('span').innerHTML = data.email.message;
        } else {
            RegisterEmail.parentElement.classList.add('success');
            RegisterEmail.parentElement.classList.remove('error');
        }
    } else {
        RegisterEmail.parentElement.classList.remove('error');
        RegisterEmail.parentElement.classList.remove('success');
    }


    if (data.username) {
        if (data.username.status == false) {
            RegisterUsername.parentElement.classList.remove('success');
            RegisterUsername.parentElement.classList.add('error');
            RegisterUsername.parentElement.querySelector('span').innerHTML = data.username.message;
        } else {
            RegisterUsername.parentElement.classList.add('success');
            RegisterUsername.parentElement.classList.remove('error');
        }
    } else {
        RegisterUsername.parentElement.classList.remove('error');
        RegisterUsername.parentElement.classList.remove('success');
    }


    if (data.password) {
        if (data.password.status == false) {
            RegisterPassword.parentElement.classList.remove('success');
            RegisterPassword.parentElement.classList.add('error');
            RegisterPassword.parentElement.querySelector('span').innerHTML = data.password.message;
        } else {
            RegisterPassword.parentElement.classList.add('success');
            RegisterPassword.parentElement.classList.remove('error');
        }
    } else {
        RegisterPassword.parentElement.classList.remove('error');
        RegisterPassword.parentElement.classList.remove('success');
    }


    if (data.confirmPassword) {
        if (data.confirmPassword.status == false) {
            RegisterConfirmPassword.parentElement.classList.remove('success');
            RegisterConfirmPassword.parentElement.classList.add('error');
            RegisterConfirmPassword.parentElement.querySelector('span').innerHTML = data.confirmPassword.message;
        } else {
            RegisterConfirmPassword.parentElement.classList.add('success');
            RegisterConfirmPassword.parentElement.classList.remove('error');
        }
    } else {
        RegisterConfirmPassword.parentElement.classList.remove('error');
        RegisterConfirmPassword.parentElement.classList.remove('success');
    }


    if (data.emailStatus) {
        finalMessageRegister.innerHTML = 'ایمیل فعالساز برای شما ارسال شد، پس از فعالسازی می تواند وارد حساب کاربری خود شوید';
        finalMessageRegister.classList.remove('text-danger');
        finalMessageRegister.classList.add('text-success');
        window.location.href = registerForm.getAttribute('registerTarget');

    } else {
        finalMessageRegister.innerHTML = 'ارسال ایمیل انجام نشد';
        finalMessageRegister.classList.remove('text-success');
        finalMessageRegister.classList.add('text-danger');
    }
}