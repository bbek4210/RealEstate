const loginForm = document.querySelector('#login-form');
const signupForm = document.querySelector('#signup-form');
const loginLink = document.querySelector('#login-link');
const signupLink = document.querySelector('#signup-link');

loginLink.addEventListener('click', () => {
  loginForm.style.display = 'block';
  signupForm.classList.remove('show');
});

signupLink.addEventListener('click', () => {
  signupForm.classList.add('show');
  loginForm.style.display = 'none';
});



