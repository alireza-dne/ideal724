const registerBtn = document.querySelector('.login-register-box .top .register-btn');
const loginBtn = document.querySelector('.login-register-box .top .login-btn')
const topLoginRegister = document.querySelector('.login-register-box .top')
const formBox = document.querySelector('.form-box')


loginBtn.onclick = function(e) {
    registerBtn.classList.remove('active');
    loginBtn.classList.add('active');
    topLoginRegister.classList.remove('register')
    topLoginRegister.classList.add('login')
    formBox.style.transform = 'translateX(0)';
}

registerBtn.onclick = function(e) {
    loginBtn.classList.remove('active');
    registerBtn.classList.add('active');
    topLoginRegister.classList.remove('login')
    topLoginRegister.classList.add('register')
    formBox.style.transform = 'translateX(380px)';
}