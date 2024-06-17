document.addEventListener('DOMContentLoaded', function () {
    const form = document.querySelector('.login');

    form.addEventListener('submit', function (event) {
        event.preventDefault();

        const usernameInput = form.querySelector('input[type="text"]');
        const passwordInput = form.querySelector('input[type="password"]');

        const username = usernameInput.value.trim();
        const password = passwordInput.value.trim();

        if (username === '') {
            alert('Please enter a username.');
            usernameInput.focus();
            return false;
        }

        if (password.length < 8 || !containsSpecialSymbol(password)) {
            alert('Password should be at least 8 characters long and contain at least one special symbol.');
            passwordInput.focus();
            return false;
        }
     
            alert('Form submitted successfully!');
            form.reset(); 
        });

    function containsSpecialSymbol(str) {
        const specialSymbols = /[`!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?~]/;
        return specialSymbols.test(str);
    }
});
