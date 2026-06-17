const loginForm = document.querySelector('.login-form')
const loginEmail = loginForm.querySelector("input[name='email']")
const loginPassword = loginForm.querySelector("input[name='password']")
const finalMessageLogin = document.querySelector('.final-message-login');


loginForm.onsubmit = function(e) {
    e.preventDefault();
    loginStore();
}


function loginStore() {
    let targetUrl = loginForm.getAttribute('action');

    let xmlHttp = new XMLHttpRequest();
    xmlHttp.onreadystatechange = function() {
        if (xmlHttp.readyState == 4 && xmlHttp.status == 200) {
            var jsonData = JSON.parse(xmlHttp.responseText);
            let data = jsonData;
            checkLogin(data)
        }
    }
    xmlHttp.open('POST', targetUrl, true);
    xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    let data = { "email": loginEmail.value, "password": loginPassword.value };
    data = JSON.stringify(data)
    xmlHttp.send(data);
}


function checkLogin(data) {
    console.log(data);
    // if (data.email) {
    //     if (data.email.status == false) {
    //         loginEmail.parentElement.classList.remove('success');
    //         loginEmail.parentElement.classList.add('error');
    //         loginEmail.parentElement.querySelector('span').innerHTML = data.email.message;
    //     } else {
    //         loginEmail.parentElement.classList.add('success');
    //         loginEmail.parentElement.classList.remove('error');
    //     }
    // } else {
    //     loginEmail.parentElement.classList.remove('error');
    //     loginEmail.parentElement.classList.remove('success');
    // }

    // if (data.password) {
    //     if (data.password.status == false) {
    //         loginPassword.parentElement.classList.remove('success');
    //         loginPassword.parentElement.classList.add('error');
    //         loginPassword.parentElement.querySelector('span').innerHTML = data.password.message;
    //     } else {
    //         loginPassword.parentElement.classList.add('success');
    //         loginPassword.parentElement.classList.remove('error');
    //     }
    // } else {
    //     loginPassword.parentElement.classList.remove('error');
    //     loginPassword.parentElement.classList.remove('success');
    // }

    if (data.finalStatus.status) {
        finalMessageLogin.innerHTML = data.finalStatus.message;
        finalMessageLogin.classList.remove('text-danger');
        finalMessageLogin.classList.add('text-success');
        window.location.href = loginForm.getAttribute('loginTarget');



    } else {
        finalMessageLogin.innerHTML = data.finalStatus.message;
        finalMessageLogin.classList.remove('text-success');
        finalMessageLogin.classList.add('text-danger');

    }
}