<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Banque Connect | Authentification</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/style_login.css') }}">

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
                <!-- Onglets -->
                <div class="auth-tabs">
                    <p class="tab active" id="login-tab" onclick="showForm('login-form')">Connexion</p>
                    <p class="tab" id="register-tab" onclick="showForm('signup-form')">Inscription</p>
                </div>

                <!-- Formulaire de Connexion -->
                <form id="login-form" class="auth-form active" action="{{ route('login') }}" method="POST">
                    @csrf
                    <div class="input-group">
                        <label for="login-email">Cin</label>
                        <div class="input-with-icon">
                            <i class="fas fa-id-card"></i>
                            <input type="text" id="login-email" placeholder="carte d'identite" name="Cin" required>
                        </div>
                    </div>

                    <div class="input-group">
                        <label for="login-password">Mot de passe</label>
                        <div class="input-with-icon">
                            <i class="fas fa-lock"></i>
                            <input type="password" id="login-password" placeholder="••••••••" name="password" required>
                            <i class="fas fa-eye toggle-password" data-target="login-password"></i>
                        </div>
                        <div class="under_input">
                            <a href="#" class="forgot-password">Mot de passe oublié ?</a>
                            <p class="dont">vous n'avez pas de compte? <a href="#" class="t" onclick="showForm('signup-form'); document.getElementById('register-tab').click();">s'inscrire</a></p>
                        </div>
                    </div>

                    <button type="submit" class="auth-btn">
                        <span>Se connecter</span>
                        <i class="fas fa-arrow-right"></i>
                    </button>
                </form>

                <!-- Formulaire d'Inscription (2 étapes) -->
                <div id="signup-form" class="auth-form">
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
                            <label for="signup-Cin">Cin</label>
                            <div class="input-with-icon">
                                <i class="fas fa-id-card"></i>
                                <input type="text" id="signup-Cin" placeholder="votre carte d'identite" name="Cin" value="{{ old('Cin') }}" required>
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
                            <label for="signup-email">date de naissance</label>
                            <div class="input-with-icon">
                                <i class="fas fa-envelope"></i>
                                <input type="date" id="signup-email" placeholder="dd/mm/yyyy" name="birthday" value="{{ old('birthday') }}" required>
                            </div>
                        </div>

                        <div class="input-group">
                            <label for="signup-email">Adresse</label>
                            <div class="input-with-icon">
                                <i class="fas fa-envelope"></i>
                                <input type="texte" id="signup-email" placeholder="entrer adresse de votre local5" name="adresse" value="{{ old('adresse') }}" required>
                            </div>
                        </div>

                        <div class="input-group">
                            <label for="signup-telephone">Téléphone</label>
                            <div class="input-with-icon">
                                <i class="fas fa-phone"></i>
                                <input type="text" id="signup-telephone" name="telephone" placeholder="votre numéro de téléphone" value="{{ old('telephone') }}" required>
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

                        <div class="terms-checkbox">
                            <input type="checkbox" id="agree-terms" required>
                            <label for="agree-terms">J'accepte les <a href="#">conditions d'utilisation</a> et la <a href="#">politique de confidentialité</a></label>
                        </div>
                        
                        <div class="step-buttons">
                            <div></div> <!-- Empty div for spacing -->
                            <button type="submit" class="auth-btn">
                                <span>Continuer</span>
                                <i class="fas fa-arrow-right"></i>
                            </button>
                        </div>
                    </form>
                    
                    
                    <p class="dont" style="text-align: center; margin-top: 15px;">Vous avez déjà un compte? <a href="#" class="t" onclick="showForm('login-form'); document.getElementById('login-tab').click();">Se connecter</a></p>
                </div>

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
    <script src="{{ asset('js/style_login.js') }}">

    </script>
</body>
</html>