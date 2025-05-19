document.addEventListener('DOMContentLoaded', function() {
    // Password toggle functionality
    document.querySelectorAll('.toggle-password').forEach(icon => {
        icon.addEventListener('click', function() {
            const targetId = this.getAttribute('data-target');
            const input = document.getElementById(targetId);
            if (input) {
                const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
                input.setAttribute('type', type);
                this.classList.toggle('fa-eye');
                this.classList.toggle('fa-eye-slash');
            }
        });
    });
    const passwordInput = document.getElementById('signup-password');
    if (passwordInput) {
        passwordInput.addEventListener('input', function() {
            console.log('Password input changed:', this.value); // Debugging line
            const password = this.value;
            let strength = 0;
            const strengthBars = document.querySelectorAll('.strength-bar');
            const strengthText = document.querySelector('.strength-text');

            // Check password strength criteria
            if (password.length >= 8) strength++;
            if (/\d/.test(password)) strength++;
            if (/[!@#$%^&*(),.?":{}|<>]/.test(password)) strength++;
            if (/[a-z]/.test(password) && /[A-Z]/.test(password)) strength++;

            // Update visual indicators
            strengthBars.forEach((bar, index) => {
                bar.style.backgroundColor = index < strength ? getStrengthColor(strength) : '#e2e8f0';
            });

            if (strengthText) {
                strengthText.textContent = getStrengthText(strength);
                strengthText.style.color = getStrengthColor(strength);
            }
        });
    }
});

function getStrengthColor(strength) {
    switch(strength) {
        case 0: case 1: return '#ef4444';
        case 2: return '#f59e0b';
        case 3: return '#10b981';
        case 4: return '#2563eb';
        default: return '#e2e8f0';
    }
}

function getStrengthText(strength) {
    switch(strength) {
        case 0: return 'Très faible';
        case 1: return 'Faible';
        case 2: return 'Moyen';
        case 3: return 'Fort';
        case 4: return 'Très fort';
        default: return '';
    }
}
function showForm(formId) {
    // Hide all forms
    document.querySelectorAll('.auth-form').forEach(form => {
        form.classList.remove('active');
    });
    
    // Show the selected form
    document.getElementById(formId).classList.add('active');
    
    // Update tab active state
    document.querySelectorAll('.tab').forEach(tab => {
        tab.classList.remove('active');
    });
    
    if (formId === 'login-form') {
        document.getElementById('login-tab').classList.add('active');
    } else {
        document.getElementById('register-tab').classList.add('active');
    }
}
