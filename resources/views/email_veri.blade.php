<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Banque Connect | Vérification Email</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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
        overflow: hidden;
    }

    /* Grid Layout */
    .bank-app-container {
        display: grid;
        grid-template-columns:1fr 1fr;
        height: 100vh;
    }

    /* Section Illustration - Left Side (Fixed) */
    .illustration-section {
        display: none;
        background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
        color: white;
        padding: 2rem;
        position: relative;
        overflow: hidden;
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

    /* Section Authentification - Right Side (Scrollable) */
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

    .auth-tabs {
        margin-bottom: 2rem;
        text-align:center;
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
    }

    .auth-form {
        display: block;
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

    .verification-message {
        text-align: center;
        padding: 2rem;
        background-color: #f8f9fa;
        border-radius: var(--border-radius);
        margin-bottom: 1.5rem;
        border: 1px solid #e0e0e0;
    }

    .verification-message i {
        font-size: 3rem;
        color: var(--primary-color);
        margin-bottom: 1rem;
    }

    .verification-message h3 {
        margin-bottom: 1rem;
        color: var(--primary-color);
    }

    .verification-code {
        margin-top: 2rem;
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

    .step-btn {
        padding: 10px 20px;
        border: none;
        border-radius: var(--border-radius);
        cursor: pointer;
        font-weight: 500;
    }

    .step-btn.next {
        background-color: var(--primary-color);
        color: white;
    }

    .step-btn.prev {
        background-color: #e0e0e0;
    }

    /* Responsive Design */
    @media (min-width: 768px) {
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
    }

    @media (min-width: 1024px) {
        .illustration-section {
            padding: 4rem;
        }

        .auth-section {
            padding: 3rem;
        }
    }
    </style>
</head>
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
            <div class="auth-container">
            @if($errors->any())
                            <div style="color: var(--danger-color); background-color: #fee2e2; padding: 1rem; border-radius: var(--border-radius); margin-bottom: 1.5rem;">
                                <ul style="list-style-type: none;">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
            @endif
                <div class="auth-tabs">
                    <p class="tab active">Vérification Email</p>
                </div>

                <!-- Verification Form -->
                <form id="verification-form" class="auth-form active" method="POST" action="{{ route('email_verification') }}">
                    @csrf
                    <input type="hidden" name="email" value="{{ old('email', $email) }}">
                    
                    <!-- Step Indicator -->
                    <div class="step-indicator">
                        <div class="step">
                            <div class="step-number completed">1</div>
                            <div class="step-title">Informations personnelles</div>
                        </div>
                        <div class="step">
                            <div class="step-number active">2</div>
                            <div class="step-title active">Vérification</div>
                        </div>
                    </div>
                    
                    <div class="verification-message">
                        <i class="fas fa-envelope-open-text"></i>
                        <h3>Vérification d'email requise</h3>
                        <p>Nous avons envoyé un code de vérification à <strong>{{ $email }}</strong>. Veuillez entrer ce code ci-dessous.</p>
                        
                        <div class="input-group verification-code">
                            <label for="verification-code">Code de vérification</label>
                            <div class="input-with-icon">
                                <i class="fas fa-shield-alt"></i>
                                <input type="number" id="verification-code" name="verification_code" placeholder="Entrez le code à 6 chiffres" required>
                            </div>
                        </div>
                        
                        <p>Si vous n'avez pas reçu l'email, vérifiez votre dossier spam ou <a href="#">renvoyer le code</a>.</p>
                    </div>
                    
                    <button type="submit" class="auth-btn">
                        <span>Vérifier et finaliser</span>
                        <i class="fas fa-check"></i>
                    </button>

                    <p class="dont" style="text-align: center; margin-top: 15px;">Vous avez déjà un compte? <a href="{{ route('login') }}" class="t">Se connecter</a></p>
                </form>

                <div class="auth-footer">
                    <p>© 2025 AmudBank. Tous droits réservés.</p>
                    <div class="footer-links">
                        <a href="#">Confidentialité</a>
                        <a href="#">Sécurité</a>
                        <a href="#">Aide</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>