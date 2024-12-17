document.addEventListener('DOMContentLoaded', () => {
    const authForm = document.getElementById('auth-form');
    const toggleAuth = document.getElementById('toggle-auth');
    const toggleText = document.getElementById('toggle-text');
    const nameGroup = document.getElementById('name-group');
    const authTitle = document.getElementById('auth-title');

    let isLogin = true;

    toggleAuth.addEventListener('click', (e) => {
        e.preventDefault();
        isLogin = !isLogin;

        if (isLogin) {
            authTitle.textContent = 'Login to your account';
            toggleText.textContent = "Don't have an account?";
            toggleAuth.textContent = 'Sign Up';
            nameGroup.style.display = 'none';
            document.querySelector('.btn-submit').textContent = 'Login';
        } else {
            authTitle.textContent = 'Create your account';
            toggleText.textContent = 'Already have an account?';
            toggleAuth.textContent = 'Log In';
            nameGroup.style.display = 'block';
            document.querySelector('.btn-submit').textContent = 'Sign Up';
        }
    });

    authForm.addEventListener('submit', (e) => {
        e.preventDefault();

        const formData = new FormData(authForm);
        const actionUrl = authForm.action; // Get the action URL from the form

        fetch(actionUrl, {
            method: 'POST',
            body: formData,
        })
        .then(response => response.text())
        .then(data => {
            // Handle the response from the server
            // Assuming the server returns a JSON response
            const result = JSON.parse(data);
            Swal.fire({
                icon: result.success ? 'success' : 'error',
                title: result.message,
            }).then(() => {
                if (result.success && isLogin) {
                    window.location.href = 'index.php'; // Redirect on successful login
                }
            });
        })
        .catch(error => {
            console.error('Error:', error);
            Swal.fire({
                icon: 'error',
                title: 'An error occurred',
                text: 'Please try again later.',
            });
        });
    });
});