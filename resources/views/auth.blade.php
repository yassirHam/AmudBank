<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Banque Connect | Authentification</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- <link rel="stylesheet" href="{{ asset('css/style_login.css') }}"> -->
    @yield('style')

</head>
<style>
    :root {
    --primary-color: #2563eb;
    --primary-dark: #1d4ed8;
    --secondary-color: #10b981;
    --dark-color: #1e293b;
    --light-color: #f8fafc;
    --gray-color: #94a3b8;
    --danger-color: #ef4444;
    --success-color: #10b981;
    --warning-color: #f59e0b;
    --border-radius: 12px;
    --box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
}

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

body {
    background-color: #f1f5f9;
    color: var(--dark-color);
    min-height: 100vh;
}

/* Main Container Layout */
.bank-app-container {
    display: grid;
    grid-template-columns: 1fr;
    height: 100vh;
}

/* Left Illustration Section */
.illustration-section {
    display: none;
    background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
    color: white;
    padding: 2rem;
    position: relative;
    overflow: hidden;
    flex-direction: column;
}

.bank-logo {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    font-size: 1.5rem;
    font-weight: 600;
    position: absolute;
    top: 2rem;
    left: 2rem;
}

.bank-logo i {
    font-size: 2rem;
}

.illustration {
    text-align: center;
    margin: 6rem 0 2rem;
}

.illustration img {
    max-width: 100%;
    height: auto;
    max-height: 250px;
}

.features-list {
    position: absolute;
    bottom: 0.6rem;
    left: 2rem;
    right: 2rem;
}

.feature {
    display: flex;
    align-items: center;
    gap: 1rem;
    margin-bottom: 1.5rem;
}

.feature i {
    font-size: 1.25rem;
    color: rgba(255, 255, 255, 0.9);
}

/* Right Auth Section */
.auth-section {
    display: grid;
    place-items: center;
    padding: 2rem;
    background-color: white;
    overflow-y: auto;
    height: 100vh;
}

.auth-container {
    width: 100%;
    max-width: 450px;
    padding: 1rem 0;
}

/* Auth Form Elements */
.auth-tabs {
    margin-bottom: 2rem;
    text-align: center;
}

.tab {
    padding: 0.75rem 1.5rem;
    background: none;
    border: none;
    font-size: 1rem;
    font-weight: 600;
    color: var(--primary-color);
    position: relative;
    transition: all 0.3s ease;
    cursor: pointer;
    display: inline-block;
}

.tab.active {
    border-bottom: 2px solid var(--primary-color);
    font-weight: bold;
}

.auth-form {
    display: none;
}

.auth-form.active {
    display: block;
}

.input-group {
    margin-bottom: 1.5rem;
}

.input-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1rem;
}

.input-group label {
    display: block;
    margin-bottom: 0.5rem;
    font-size: 0.875rem;
    font-weight: 500;
    color: var(--dark-color);
}

.input-with-icon {
    position: relative;
}

.input-with-icon i:first-child {
    position: absolute;
    left: 1rem;
    top: 50%;
    transform: translateY(-50%);
    color: var(--gray-color);
}

.input-with-icon input {
    width: 100%;
    padding: 0.875rem 1rem 0.875rem 2.5rem;
    border: 1px solid #e2e8f0;
    border-radius: var(--border-radius);
    font-size: 0.9375rem;
    transition: all 0.3s ease;
}

.input-with-icon input:focus {
    outline: none;
    border-color: var(--primary-color);
    box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
}

.toggle-password {
    position: absolute;
    right: 1rem;
    top: 50%;
    transform: translateY(-50%);
    color: var(--gray-color);
    cursor: pointer;
}

.under_input {
    display: flex;
    gap: 20%;
}

.forgot-password, .dont {
    display: inline-block;
    margin-top: 0.5rem;
    font-size: 0.8125rem;
    color: var(--primary-color);
    text-decoration: none;
}

.t {
    display: inline-block;
    font-weight: 700;
    color: var(--primary-color);
    text-decoration: none;
}

.forgot-password:hover, .t:hover {
    text-decoration: underline;
}

.password-strength {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    margin-top: 0.5rem;
}

.strength-bar {
    height: 4px;
    width: 20%;
    background-color: #e2e8f0;
    border-radius: 2px;
}

.strength-text {
    font-size: 0.75rem;
    color: var(--gray-color);
}

.terms-checkbox {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    margin: 1.5rem 0;
}

.terms-checkbox input {
    width: 1rem;
    height: 1rem;
}

.terms-checkbox label {
    font-size: 0.8125rem;
    color: var(--dark-color);
}

.terms-checkbox a {
    color: var(--primary-color);
    text-decoration: none;
}

.terms-checkbox a:hover {
    text-decoration: underline;
}

.auth-btn {
    width: 100%;
    padding: 1rem;
    background-color: var(--primary-color);
    color: white;
    border: none;
    border-radius: var(--border-radius);
    font-size: 1rem;
    font-weight: 600;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
    transition: all 0.3s ease;
}

.auth-btn:hover {
    background-color: var(--primary-dark);
    transform: translateY(-2px);
}

/* Multi-step form styles */
.form-step {
    display: none;
}

.form-step.active {
    display: block;
}

.step-indicator {
    display: flex;
    justify-content: center;
    margin-bottom: 2rem;
    gap: 40px;
}

.step {
    display: flex;
    flex-direction: column;
    align-items: center;
}

.step-number {
    width: 30px;
    height: 30px;
    border-radius: 50%;
    background-color: #e0e0e0;
    color: #666;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
    margin-bottom: 5px;
}

.step-number.active {
    background-color: var(--primary-color);
    color: white;
}

.step-number.completed {
    background-color: #4CAF50;
    color: white;
}

.step-title {
    font-size: 12px;
    color: #666;
    text-align: center;
}

.step-title.active {
    color: var(--primary-color);
    font-weight: bold;
}

.step-buttons {
    display: flex;
    justify-content: space-between;
    margin-top: 2rem;
}

/* Footer */
.auth-footer {
    margin-top: 3rem;
    text-align: center;
    font-size: 0.75rem;
    color: var(--gray-color);
}

.footer-links {
    display: flex;
    justify-content: center;
    gap: 1rem;
    margin-top: 0.5rem;
}

.footer-links a {
    color: var(--gray-color);
    text-decoration: none;
}

.footer-links a:hover {
    color: var(--primary-color);
    text-decoration: underline;
}


    .bank-app-container {
        grid-template-columns: 0.9fr 1.1fr;
    }

    .illustration-section {
        display: flex;
        flex-direction: column;
        padding: 3rem;
    }

    .auth-section {
        padding: 3rem;
    }



</style>
<body>
    <div class="bank-app-container">
        <!-- Section Illustration -->
        <div class="illustration-section">
            <div class="bank-logo">
                <i class="fas fa-university"></i>
                <span>AmudBank</span>
            </div>
            <div class="illustration">
                <img src="https://cdn-icons-png.flaticon.com/512/2638/2638031.png" alt="Online banking">
            </div>
            <div class="features-list">
                <div class="feature">
                    <i class="fas fa-shield-alt"></i>
                    <span>Sécurité bancaire de niveau premium</span>
                </div>
                <div class="feature">
                    <i class="fas fa-mobile-alt"></i>
                    <span>Accès depuis n'importe quel appareil</span>
                </div>
                <div class="feature">
                    <i class="fas fa-clock"></i>
                    <span>Disponible 24h/24</span>
                </div>
            </div>
        </div>

        <!-- Section Authentification -->
        <div class="auth-section">
            @yield('content')
        </div>
    </div>

</body>
</html>