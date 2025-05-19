@extends('auth')
@section('style')
<style>
#signup-form .step-indicator {
    display: flex;
    justify-content: center;
    margin-bottom: 2rem;
}

#signup-form .step {
    display: flex;
    flex-direction: column;
    align-items: center;
}

#signup-form .step-number {
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

#signup-form .step-number.active {
    background-color: var(--primary-color);
    color: white;
}

#signup-form .step-title {
    font-size: 12px;
    color: #666;
    text-align: center;
}

#signup-form .step-title.active {
    color: var(--primary-color);
    font-weight: bold;
}

#signup-form .form-step {
    display: block;
}

#signup-form .input-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1rem;
}

#signup-form .input-group {
    margin-bottom: 1.5rem;
}

#signup-form .input-group label {
    display: block;
    margin-bottom: 0.5rem;
    font-size: 0.875rem;
    font-weight: 500;
    color: var(--dark-color);
}

#signup-form .input-with-icon {
    position: relative;
}

#signup-form .input-with-icon i:first-child {
    position: absolute;
    left: 1rem;
    top: 50%;
    transform: translateY(-50%);
    color: var(--gray-color);
}

#signup-form .input-with-icon input {
    width: 100%;
    padding: 0.875rem 1rem 0.875rem 2.5rem;
    border: 1px solid #e2e8f0;
    border-radius: var(--border-radius);
    font-size: 0.9375rem;
    transition: all 0.3s ease;
}

#signup-form .input-with-icon input:focus {
    outline: none;
    border-color: var(--primary-color);
    box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
}

#signup-form .toggle-password {
    position: absolute;
    right: 1rem;
    top: 50%;
    transform: translateY(-50%);
    color: var(--gray-color);
    cursor: pointer;
}

#signup-form .terms-checkbox {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    margin: 1.5rem 0;
}

#signup-form .terms-checkbox input {
    width: 1rem;
    height: 1rem;
}

#signup-form .terms-checkbox label {
    font-size: 0.8125rem;
    color: var(--dark-color);
}

#signup-form .terms-checkbox a {
    color: var(--primary-color);
    text-decoration: none;
}

#signup-form .terms-checkbox a:hover {
    text-decoration: underline;
}

#signup-form .step-buttons {
    display: flex;
    justify-content: space-between;
    margin-top: 2rem;
}

#signup-form .auth-btn {
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

#signup-form .auth-btn:hover {
    background-color: var(--primary-dark);
    transform: translateY(-2px);
}

/* Error message styling */
#signup-form [style*="color: var(--danger-color);"] {
    color: var(--danger-color) !important;
    background-color: #fee2e2;
    padding: 1rem;
    border-radius: var(--border-radius);
    margin-bottom: 1.5rem;
}

#signup-form [style*="color: var(--danger-color);"] ul {
    list-style-type: none;
}
.auth-footer {
    margin-top: 1.5rem;
    text-align: center;
    font-size: 0.875rem;
    color: var(--dark-color);
}

.auth-footer a {
    color: var(--primary-color);
    text-decoration: none;
    font-weight: 500;
}

.auth-footer a:hover {
    text-decoration: underline;
}
</style>
@endsection

@section('content')
<div class="auth-tabs">
    <a href="{{route('login')}}" style="text-decoration:none" class="tab" id="login-tab">Connexion</a>
    <a href="{{route('register_step1')}}" style="text-decoration:none" class="tab active" id="register-tab" >Inscription</a>
</div>
<div id="signup-form" class="auth-form active">
    <!-- Step Indicator -->
    <div class="step-indicator">
        <div class="step">
            <div class="step-number active" id="step-1-indicator">1</div>
            <div class="step-title active">Informations personnelles</div>
        </div>
        <div class="step">
            <div class="step-number" id="step-2-indicator">2</div>
            <div class="step-title">Vérification</div>
        </div>
    </div>

    <!-- Step 1: Personal Information Form -->
    <form id="step-1-form" class="form-step active" method="POST" action="{{ route('register_step1') }}" enctype="multipart/form-data">
        @csrf
        @if($errors->any())
            <div style="color: var(--danger-color); background-color: #fee2e2; padding: 1rem; border-radius: var(--border-radius); margin-bottom: 1.5rem;">
                <ul style="list-style-type: none;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="input-row">
            <div class="input-group">
                <label for="signup-nom">Nom</label>
                <div class="input-with-icon">
                    <i class="fas fa-user"></i>
                    <input type="text" id="signup-nom" placeholder="Votre nom" name="Nom" value="{{ old('Nom') }}" required>
                </div>
            </div>
            <div class="input-group">
                <label for="signup-prenom">Prénom</label>
                <div class="input-with-icon">
                    <i class="fas fa-user"></i>
                    <input type="text" id="signup-prenom" placeholder="Votre prénom" name="Prenom" value="{{ old('Prenom') }}" required>
                </div>
            </div>
        </div>

        <div class="input-group">
            <label for="signup-Cin">CIN</label>
            <div class="input-with-icon">
                <i class="fas fa-id-card"></i>
                <input type="text" id="signup-Cin" placeholder="Votre carte d'identité" name="Cin" value="{{ old('Cin') }}" required>
            </div>
        </div>

        <div class="input-group">
            <label for="signup-cin-image">Photo de votre Carte d'Identité (CIN)</label>
            <div class="input-with-icon">
                <i class="fas fa-id-card"></i>
                <input type="file" id="signup-cin-image" name="cin_image" accept="image/*" required>
            </div>
        </div>

        <div class="input-group">
            <label for="signup-email">Adresse email</label>
            <div class="input-with-icon">
                <i class="fas fa-envelope"></i>
                <input type="email" id="signup-email" placeholder="votre@email.com" name="email" value="{{ old('email') }}" required>
            </div>
        </div>

        <div class="input-group">
            <label for="signup-birthday">Date de naissance</label>
            <div class="input-with-icon">
                <i class="fas fa-calendar"></i>
                <input type="date" id="signup-birthday" name="birthday" value="{{ old('birthday') }}" required>
            </div>
        </div>

        <div class="input-group">
            <label for="signup-adresse">Adresse</label>
            <div class="input-with-icon">
                <i class="fas fa-map-marker-alt"></i>
                <input type="text" id="signup-adresse" placeholder="Adresse complète" name="adresse" value="{{ old('adresse') }}" required>
            </div>
        </div>

        <div class="input-group">
            <label for="signup-telephone">Téléphone</label>
            <div class="input-with-icon">
                <i class="fas fa-phone"></i>
                <input type="text" id="signup-telephone" name="telephone" placeholder="Votre numéro de téléphone" value="{{ old('telephone') }}" required>
            </div>
        </div>

        <div class="input-group">
            <label for="signup-password">Mot de passe</label>
            <div class="input-with-icon">
                <i class="fas fa-lock"></i>
                <input type="password" id="signup-password" placeholder="••••••••" name="password" required>
                <i class="fas fa-eye toggle-password" data-target="signup-password"></i>
            </div>
            <div class="password-strength">
                <div class="strength-bar"></div>
                <div class="strength-bar"></div>
                <div class="strength-bar"></div>
                <span class="strength-text">Faible</span>
            </div>
        </div>

        <div class="input-group">
            <label for="signup-confirm">Confirmer le mot de passe</label>
            <div class="input-with-icon">
                <i class="fas fa-lock"></i>
                <input type="password" id="signup-confirm" placeholder="••••••••" name="password_confirmation" required>
            </div>
        </div>
        <div style="text-align: right; margin-top: -0.5rem;font-size: 0.775rem; "> Vous avez déjà un compte?
            <a href="{{ route('login') }}" style="font-size: 0.7rem; color: var(--primary-color); text-decoration: none;">
             Connectez-vous ici
            </a>
         </div>
        <div class="terms-checkbox">
            <input type="checkbox" id="agree-terms" required>
            <label for="agree-terms">J'accepte les <a href="#">conditions d'utilisation</a> et la <a href="#">politique de confidentialité</a></label>
        </div>

        <div class="step-buttons">
            <div></div> <!-- Pour l'espacement -->
            <button type="submit" class="auth-btn">
                <span>Continuer</span>
                <i class="fas fa-arrow-right"></i>
            </button>
        </div>
    </form>
</div>
<script>
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

    // Password strength indicator
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
</script>

@endsection