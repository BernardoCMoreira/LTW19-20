let username = document.querySelector('.register input[name=username]');
username.addEventListener('keyup', validateUsername, false);

let email = document.querySelector('.register input[name=email]');
email.addEventListener('keyup', validateEmail, false);

let password = document.querySelector('.register input[name=password]');
password.addEventListener('keyup', validatePassword, false);

let register = document.querySelector('.register form');
register.addEventListener('submit', validateRegister, false);


function validateUsername() {
  if (!/^[a-z]{3,}$/.test(this.value))
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

function validateRepeat(password) {
  if (this.value !== password.value)
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

