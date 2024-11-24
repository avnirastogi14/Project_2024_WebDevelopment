const signUpButton = document.getElementById('signUp');
const signInButton = document.getElementById('signIn');
const container = document.getElementById('container');
const backtabDiv = document.getElementById('backtab');
const animationDiv = document.getElementById('animation');

// Toggle button for sign up/sign in forms
signUpButton.addEventListener('click', () => {
    container.classList.add("active");
});

signInButton.addEventListener('click', () => {
    container.classList.remove("active");
});

// Handling the animation end event
window.addEventListener('load', () => {
    const animation = document.getElementById('animation');

    animation.addEventListener('animationend', () => {
        animation.style.display = 'none'; 
        backtabDiv.style.display = 'block';  // revealing the backtab div
    });
});
