const signInBtnLink = document.querySelector('.signInBtn-link');
const signUpBtnLink = document.querySelector('.signUpBtn-link');
const wrapper = document.querySelector('.wrapper');
signUpBtnLink.addEventListener('click', () => {
    wrapper.classList.toggle('active');
});
signInBtnLink.addEventListener('click', () => {
    wrapper.classList.toggle('active');
});

    const loginForm = document.querySelector('.sign-in form');

    if (loginForm) {
        loginForm.addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent default form submission
            
            // Perform form validation
            const email = loginForm.email.value;
            const password = loginForm.psw.value;
            const role = loginForm.role.value;

            if (!email || !password || !role) {
                alert('Please fill in all fields.');
                return;
            }

        
            loginForm.submit(); 
        });
    }
