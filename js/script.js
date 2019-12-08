
let username = document.querySelector('.register input[name=username]');
if (username) username.addEventListener('keyup', validateUsername, false);

let email = document.querySelector('.register input[name=email]');
if (email) email.addEventListener('keyup', validateEmail, false);

let password = document.querySelector('.register input[name=password]');
if (password) password.addEventListener('keyup', validatePassword, false);

let register = document.querySelector('.register form');
if (register) register.addEventListener('submit', validateRegister, false);

let change_username = document.querySelector('.userprofile input[name=username]');
if (change_username) change_username.addEventListener('keyup', validateUsername, false);

let change_email = document.querySelector('.userprofile input[name=email]');
if (change_email) change_email.addEventListener('keyup', validateEmail, false);

let change_password = document.querySelector('.userprofile input[name=password]');
if (change_password) change_password.addEventListener('keyup', validatePassword, false);

let changes = document.querySelector('.userprofile form');
if (changes) changes.addEventListener('submit', validateRegister, false);


function validateUsername() {
  if (!/^[a-zA-Z0-9]{3,}$/.test(this.value))
    this.classList.add('invalid');
  else
    this.classList.remove('invalid');
}

function validateEmail() {
  if (!/^.*(?=.*[@]).{4,}$/.test(this.value))
    this.classList.add('invalid');
  else
    this.classList.remove('invalid');
}

function validatePassword() {
  if (!/^.*(?=.*[A-Z])(?=.*[!@#$&*])(?=.*[0-9]).{8,}$/.test(this.value))
    this.classList.add('invalid');
  else
    this.classList.remove('invalid');
}

function validateRegister(event) {
  let inputs = this.querySelectorAll('input');
  for (let i = 0; i < inputs.length; i++)
    if (inputs[i].classList.contains('invalid'))
     event.preventDefault();
}


