<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Banque Connect - Votre banque en ligne sécurisée</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="styles.css">
</head>
<style>
    :root {
    --primary-color: #2563eb;
    --primary-dark: #1d4ed8;
    --secondary-color: #10b981;
    --dark-color: #1e293b;
    --light-color: #f8fafc;
    --gray-color: #94a3b8;
    --light-gray: #e2e8f0;
    --danger-color: #ef4444;
    --success-color: #10b981;
    --warning-color: #f59e0b;
    --border-radius: 12px;
    --box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
    --transition: all 0.3s ease;
}

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

body {
    color: var(--dark-color);
    line-height: 1.6;
    overflow-x: hidden;
}

.container {
    width: 100%;
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 1.5rem;
}

/* Navigation */
.navbar {
    background-color: white;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    position: fixed;
    width: 100%;
    top: 0;
    z-index: 1000;
}

.navbar .container {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 1rem 1.5rem;
}

.logo {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    font-size: 1.5rem;
    font-weight: 600;
    color: var(--primary-color);
    text-decoration: none;
}

.logo i {
    font-size: 1.75rem;
}

.nav-links {
    display: flex;
    align-items: center;
    gap: 1.5rem;
}

.nav-links a {
    color: var(--dark-color);
    text-decoration: none;
    font-weight: 500;
    transition: var(--transition);
}

.nav-links a:hover {
    color: var(--primary-color);
}

.btn {
    padding: 0.5rem 1.25rem;
    border-radius: var(--border-radius);
    font-weight: 500;
    cursor: pointer;
    transition: var(--transition);
    text-decoration: none;
    display: inline-block;
}

.btn-outline {
    border: 1px solid var(--primary-color);
    color: var(--primary-color);
    background: transparent;
}

.btn-outline:hover {
    background-color: var(--primary-color);
    color: white;
}

.btn-primary {
    background-color: var(--primary-color);
    color: white;
    border: 1px solid var(--primary-color);
}

.btn-primary:hover {
    background-color: var(--primary-dark);
    transform: translateY(-2px);
    box-shadow: var(--box-shadow);
}

.menu-toggle {
    display: none;
    background: none;
    border: none;
    font-size: 1.5rem;
    color: var(--dark-color);
    cursor: pointer;
}

/* Hero Section */
.hero {
    padding: 8rem 0 4rem;
    background: linear-gradient(to bottom, #f8fafc, #ffffff);
}

.hero .container {
    display: flex;
    align-items: center;
    gap: 3rem;
}

.hero-content {
    flex: 1;
}

.hero-image {
    flex: 1;
    position: relative;
    display: none;
}

.hero h1 {
    font-size: 3rem;
    margin-bottom: 1.5rem;
    line-height: 1.2;
}

.subtitle {
    font-size: 1.25rem;
    color: var(--gray-color);
    margin-bottom: 2rem;
    max-width: 600px;
}

.cta-buttons {
    display: flex;
    gap: 1rem;
    margin-bottom: 2rem;
}

.btn-large {
    padding: 0.75rem 1.5rem;
    font-size: 1.1rem;
}

.btn-secondary {
    background-color: white;
    color: var(--primary-color);
    border: 1px solid var(--light-gray);
}

.btn-secondary:hover {
    background-color: #f1f5f9;
    transform: translateY(-2px);
    box-shadow: var(--box-shadow);
}

.app-stores p {
    margin-bottom: 0.75rem;
    color: var(--gray-color);
}

.store-buttons {
    display: flex;
    gap: 1rem;
}

.store-btn {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.5rem 1rem;
    background-color: var(--dark-color);
    color: white;
    border-radius: var(--border-radius);
    text-decoration: none;
    transition: var(--transition);
}

.store-btn:hover {
    background-color: #334155;
    transform: translateY(-2px);
}

.card-animation {
    position: absolute;
    bottom: -50px;
    right: 0;
    z-index: 10;
}

.card {
    width: 280px;
    height: 160px;
    background: linear-gradient(135deg, #3b82f6, #2563eb);
    border-radius: 12px;
    padding: 1.25rem;
    color: white;
    box-shadow: var(--box-shadow);
    position: relative;
    overflow: hidden;
}

.card-1 {
    transform: rotate(-5deg);
    z-index: 2;
}

.card-2 {
    transform: rotate(5deg) translateY(-120px) translateX(40px);
    background: linear-gradient(135deg, #10b981, #059669);
    z-index: 1;
}

.card-chip {
    font-size: 1.5rem;
    margin-bottom: 1.5rem;
}

.card-number {
    font-family: 'Courier New', monospace;
    letter-spacing: 2px;
    font-size: 1.1rem;
    margin-bottom: 1.5rem;
}

.card-footer {
    display: flex;
    justify-content: space-between;
    font-size: 0.8rem;
    text-transform: uppercase;
}

/* Sections communes */
.section-title {
    font-size: 2rem;
    text-align: center;
    margin-bottom: 1rem;
}

.section-subtitle {
    color: var(--gray-color);
    text-align: center;
    max-width: 700px;
    margin: 0 auto 3rem;
}

/* Features Section */
.features {
    padding: 5rem 0;
    background-color: white;
}

.features-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 2rem;
}

.feature-card {
    background-color: #f8fafc;
    border-radius: var(--border-radius);
    padding: 2rem;
    transition: var(--transition);
}

.feature-card:hover {
    transform: translateY(-5px);
    box-shadow: var(--box-shadow);
}

.feature-icon {
    width: 60px;
    height: 60px;
    background-color: var(--primary-color);
    color: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    margin-bottom: 1.5rem;
}

.feature-card h3 {
    font-size: 1.25rem;
    margin-bottom: 1rem;
}

.feature-card p {
    color: var(--gray-color);
}

/* Security Section */
.security {
    padding: 5rem 0;
    background-color: #f1f5f9;
}

.security .container {
    display: flex;
    align-items: center;
    gap: 3rem;
}

.security-content {
    flex: 1;
}

.security-image {
    flex: 1;
    display: none;
}

.security-image img {
    max-width: 100%;
    height: auto;
}

.security-features {
    margin-top: 2rem;
}

.security-item {
    display: flex;
    gap: 1.5rem;
    margin-bottom: 2rem;
}

.security-item i {
    font-size: 1.75rem;
    color: var(--primary-color);
    margin-top: 0.25rem;
}

.security-item h3 {
    margin-bottom: 0.5rem;
}

.security-item p {
    color: var(--gray-color);
}

/* Testimonials */
.testimonials {
    padding: 5rem 0;
    background-color: white;
}

.testimonials-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 2rem;
    margin-top: 2rem;
}

.testimonial-card {
    background-color: #f8fafc;
    border-radius: var(--border-radius);
    padding: 2rem;
    transition: var(--transition);
}

.testimonial-card:hover {
    transform: translateY(-5px);
    box-shadow: var(--box-shadow);
}

.testimonial-rating {
    color: var(--warning-color);
    margin-bottom: 1rem;
}

.testimonial-text {
    font-style: italic;
    margin-bottom: 1.5rem;
    color: var(--dark-color);
}

.testimonial-author {
    display: flex;
    align-items: center;
    gap: 1rem;
}

.testimonial-author img {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    object-fit: cover;
}

.testimonial-author h4 {
    margin-bottom: 0.25rem;
}

.testimonial-author span {
    font-size: 0.875rem;
    color: var(--gray-color);
}

/* CTA Section */
.cta {
    padding: 5rem 0;
    background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
    color: white;
    text-align: center;
}

.cta h2 {
    font-size: 2rem;
    margin-bottom: 1rem;
}

.cta p {
    max-width: 600px;
    margin: 0 auto 2rem;
    opacity: 0.9;
}

/* Footer */
.footer {
    background-color: var(--dark-color);
    color: white;
    padding: 4rem 0 0;
}

.footer-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 2rem;
    margin-bottom: 3rem;
}

.footer-col h4 {
    font-size: 1.1rem;
    margin-bottom: 1.5rem;
    position: relative;
    padding-bottom: 0.75rem;
}

.footer-col h4::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    width: 40px;
    height: 2px;
    background-color: var(--primary-color);
}

.footer-col ul {
    list-style: none;
}

.footer-col ul li {
    margin-bottom: 0.75rem;
}

.footer-col ul li a {
    color: var(--light-gray);
    text-decoration: none;
    transition: var(--transition);
}

.footer-col ul li a:hover {
    color: white;
    padding-left: 5px;
}

.social-links {
    display: flex;
    gap: 1rem;
    margin-top: 1.5rem;
}

.social-links a {
    width: 36px;
    height: 36px;
    border-radius: 50%;
    background-color: rgba(255, 255, 255, 0.1);
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: var(--transition);
}

.social-links a:hover {
    background-color: var(--primary-color);
    transform: translateY(-3px);
}

.footer-bottom {
    border-top: 1px solid rgba(255, 255, 255, 0.1);
    padding-top: 2rem;
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 1rem;
    text-align: center;
}

.footer-links {
    display: flex;
    gap: 1.5rem;
}

.footer-links a {
    color: var(--light-gray);
    text-decoration: none;
    font-size: 0.875rem;
    transition: var(--transition);
}

.footer-links a:hover {
    color: white;
}

/* Responsive Design */
@media (min-width: 768px) {
    .hero-image {
        display: block;
    }

    .security-image {
        display: block;
    }
}

@media (max-width: 768px) {
    .nav-links {
        display: none;
    }

    .menu-toggle {
        display: block;
    }

    .hero .container {
        flex-direction: column;
        text-align: center;
    }

    .hero-content {
        margin-bottom: 3rem;
    }

    .cta-buttons {
        justify-content: center;
    }

    .app-stores {
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .security .container {
        flex-direction: column;
    }

    .security-content {
        text-align: center;
    }

    .security-item {
        flex-direction: column;
        align-items: center;
        text-align: center;
    }
}
    </style>
<body>
    <!-- Barre de navigation -->
    <nav class="navbar">
        <div class="container">
            <div class="logo">
                <i class="fas fa-university"></i>
                <span>AmudBank</span>
            </div>
            <div class="nav-links">
                <a href="#features">Fonctionnalités</a>
                <a href="#security">Sécurité</a>
                <a href="#pricing">Tarifs</a>
                <a href="#contact">Contact</a>
                <a href="{{ route('login') }}" class="btn btn-outline">Connexion</a>
                <a href="{{ route('register_step1') }}" class="btn btn-primary">Ouvrir un compte</a>
            </div>
            <button class="menu-toggle">
                <i class="fas fa-bars"></i>
            </button>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero">
        <div class="container">
            <div class="hero-content">
                <h1>Votre banque 100% digitale</h1>
                <p class="subtitle">Gérez votre argent simplement, où que vous soyez, avec une sécurité bancaire de niveau premium.</p>
                <div class="cta-buttons">
                    <a href="{{ route('register_step1') }}" class="btn btn-primary btn-large">Ouvrir un compte <i class="fas fa-arrow-right"></i></a>
                    <a href="#demo" class="btn btn-secondary btn-large">Voir la démo <i class="fas fa-play-circle"></i></a>
                </div>
                <div class="app-stores">
                    <p>Téléchargez notre application :</p>
                    <div class="store-buttons">
                        <a href="#" class="store-btn">
                            <i class="fab fa-apple"></i>
                            <span>App Store</span>
                        </a>
                        <a href="#" class="store-btn">
                            <i class="fab fa-google-play"></i>
                            <span>Google Play</span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="hero-image">
                <img src="https://cdn-icons-png.flaticon.com/512/2638/2638031.png" alt="Application mobile AmudBank">
                <div class="card-animation">
                    <div class="card card-1">
                        <div class="card-chip">
                            <i class="fas fa-microchip"></i>
                        </div>
                        <div class="card-number">•••• •••• •••• 4562</div>
                        <div class="card-footer">
                            <div class="card-name">VOTRE NOM</div>
                            <div class="card-expiry">09/25</div>
                        </div>
                    </div>
                    <div class="card card-2">
                        <div class="card-chip">
                            <i class="fas fa-microchip"></i>
                        </div>
                        <div class="card-number">•••• •••• •••• 7890</div>
                        <div class="card-footer">
                            <div class="card-name">VOTRE NOM</div>
                            <div class="card-expiry">12/26</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features" id="features">
        <div class="container">
            <h2 class="section-title">Pourquoi choisir AmudBank ?</h2>
            <p class="section-subtitle">Découvrez nos services innovants conçus pour simplifier votre vie bancaire</p>

            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-money-bill-wave"></i>
                    </div>
                    <h3>Comptes sans frais</h3>
                    <p>Ouvrez un compte courant ou épargne sans frais cachés et avec des conditions transparentes.</p>
                </div>

                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-exchange-alt"></i>
                    </div>
                    <h3>Virements instantanés</h3>
                    <p>Effectuez des virements entre comptes en quelques secondes, 24h/24 et 7j/7.</p>
                </div>

                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <h3>Sécurité renforcée</h3>
                    <p>Protection avancée avec authentification à deux facteurs et surveillance des transactions.</p>
                </div>

                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-piggy-bank"></i>
                    </div>
                    <h3>Épargne intelligente</h3>
                    <p>Programmes d'épargne automatique avec des taux compétitifs pour faire fructifier votre argent.</p>
                </div>

                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <h3>Tableaux de bord</h3>
                    <p>Visualisez vos dépenses et recevez des conseils personnalisés pour mieux gérer votre budget.</p>
                </div>

                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-headset"></i>
                    </div>
                    <h3>Support 24/7</h3>
                    <p>Notre équipe est disponible à tout moment pour répondre à vos questions et résoudre vos problèmes.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Security Section -->
    <section class="security" id="security">
        <div class="container">
            <div class="security-content">
                <h2 class="section-title">Votre sécurité est notre priorité</h2>
                <p class="section-subtitle">Nous utilisons les technologies les plus avancées pour protéger votre argent et vos données</p>

                <div class="security-features">
                    <div class="security-item">
                        <i class="fas fa-fingerprint"></i>
                        <div>
                            <h3>Authentification biométrique</h3>
                            <p>Connectez-vous en un clin d'œil avec reconnaissance faciale ou empreinte digitale.</p>
                        </div>
                    </div>

                    <div class="security-item">
                        <i class="fas fa-lock"></i>
                        <div>
                            <h3>Chiffrement bancaire</h3>
                            <p>Toutes vos données sont chiffrées avec un protocole SSL 256 bits, le standard des banques.</p>
                        </div>
                    </div>

                    <div class="security-item">
                        <i class="fas fa-bell"></i>
                        <div>
                            <h3>Alertes en temps réel</h3>
                            <p>Recevez une notification pour chaque transaction et signalez immédiatement toute activité suspecte.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="security-image">
                <img src="https://cdn-icons-png.flaticon.com/512/2889/2889676.png" alt="Sécurité bancaire">
            </div>
        </div>
    </section>

    <!-- Testimonials -->
    <section class="testimonials">
        <div class="container">
            <h2 class="section-title">Ils nous font confiance</h2>
            <p class="section-subtitle">Découvrez ce que nos clients disent de leur expérience</p>

            <div class="testimonials-grid">
                <div class="testimonial-card">
                    <div class="testimonial-rating">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <p class="testimonial-text">"Je suis passé à AmudBank il y a un an et je ne regrette absolument pas. L'interface est intuitive et le service client réactif."</p>
                    <div class="testimonial-author">
                        <img src="walid.jpeg" alt="Sophie Martin">
                        <div>
                            <h4>Walid lebhir</h4>
                            <span>Software Engineer</span>
                        </div>
                    </div>
                </div>

                <div class="testimonial-card">
                    <div class="testimonial-rating">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                    <p class="testimonial-text">"Les virements instantanés ont changé ma façon de gérer mon entreprise. Plus besoin d'attendre 24h pour que les transactions soient effectives."</p>
                    <div class="testimonial-author">
                        <img src="youssef.jpeg" alt="Thomas Leroy">
                        <div>
                            <h4>Youssef El Kahlaoui</h4>
                            <span>Data Scientists</span>
                        </div>
                    </div>
                </div>

                <div class="testimonial-card">
                    <div class="testimonial-rating">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <p class="testimonial-text">"En tant qu'expatrié, AmudBank m'a permis de gérer facilement mes comptes en plusieurs devises avec des frais très compétitifs."</p>
                    <div class="testimonial-author">
                        <img src="https://randomuser.me/api/portraits/women/65.jpg" alt="Camille Dubois">
                        <div>
                            <h4>Camille Dubois</h4>
                            <span>Expatriée à Londres</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta">
        <div class="container">
            <h2>Prêt à révolutionner votre expérience bancaire ?</h2>
            <p>Ouvrez un compte en moins de 5 minutes et profitez de tous nos services dès aujourd'hui.</p>
            <div class="cta-buttons">
                <a href="{{ route('register_step1') }}" class="btn btn-primary btn-large">Ouvrir un compte</a>
                <a href="{{ route('login') }}" class="btn btn-secondary btn-large">Se connecter</a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-grid">
                <div class="footer-col">
                    <div class="logo">
                        <i class="fas fa-university"></i>
                        <span>AmudBank</span>
                    </div>
                    <p>La banque 100% digitale qui simplifie votre vie financière avec des solutions innovantes et sécurisées.</p>
                    <div class="social-links">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-linkedin-in"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>

                <div class="footer-col">
                    <h4>Services</h4>
                    <ul>
                        <li><a href="#">Comptes bancaires</a></li>
                        <li><a href="#">Cartes bancaires</a></li>
                        <li><a href="#">Épargne et placements</a></li>
                        <li><a href="#">Prêts et crédits</a></li>
                        <li><a href="#">Assurances</a></li>
                    </ul>
                </div>

                <div class="footer-col">
                    <h4>Entreprise</h4>
                    <ul>
                        <li><a href="#">À propos</a></li>
                        <li><a href="#">Carrières</a></li>
                        <li><a href="#">Presse</a></li>
                        <li><a href="#">Blog</a></li>
                        <li><a href="#">Impact social</a></li>
                    </ul>
                </div>

                <div class="footer-col">
                    <h4>Support</h4>
                    <ul>
                        <li><a href="#">Centre d'aide</a></li>
                        <li><a href="#">Nous contacter</a></li>
                        <li><a href="#">Sécurité</a></li>
                        <li><a href="#">Tarifs</a></li>
                        <li><a href="#">CGU</a></li>
                    </ul>
                </div>
            </div>

            <div class="footer-bottom">
                <p>© 2025 AmudBank. Tous droits réservés.</p>
                <div class="footer-links">
                    <a href="#">Confidentialité</a>
                    <a href="#">Conditions d'utilisation</a>
                    <a href="#">Cookies</a>
                    <a href="#">Mentions légales</a>
                </div>
            </div>
        </div>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
    // Menu mobile
    const menuToggle = document.querySelector('.menu-toggle');
    const navLinks = document.querySelector('.nav-links');

    if (menuToggle && navLinks) {
        menuToggle.addEventListener('click', function() {
            navLinks.style.display = navLinks.style.display === 'flex' ? 'none' : 'flex';
        });

        // Fermer le menu quand on clique sur un lien
        document.querySelectorAll('.nav-links a').forEach(link => {
            link.addEventListener('click', function() {
                navLinks.style.display = 'none';
            });
        });
    }

    // Animation des cartes dans le hero
    const cards = document.querySelectorAll('.card');
    if (cards.length > 0) {
        cards.forEach((card, index) => {
            card.style.opacity = '0';
            card.style.transform = `rotate(${index % 2 === 0 ? -15 : 15}deg) translateY(50px)`;

            setTimeout(() => {
                card.style.transition = 'all 0.5s ease-out';
                card.style.opacity = '1';
                card.style.transform = `rotate(${index % 2 === 0 ? -5 : 5}deg) translateY(${index === 1 ? -120 : 0}px) translateX(${index === 1 ? 40 : 0}px)`;
            }, 300 * (index + 1));
        });
    }

    // Animation au défilement
    const animateOnScroll = function() {
        const elements = document.querySelectorAll('.feature-card, .security-item, .testimonial-card');

        elements.forEach(element => {
            const elementPosition = element.getBoundingClientRect().top;
            const windowHeight = window.innerHeight;

            if (elementPosition < windowHeight - 100) {
                element.style.opacity = '1';
                element.style.transform = 'translateY(0)';
            }
        });
    };

    // Initialiser les éléments animés
    const animatedElements = document.querySelectorAll('.feature-card, .security-item, .testimonial-card');
    animatedElements.forEach(element => {
        element.style.opacity = '0';
        element.style.transform = 'translateY(30px)';
        element.style.transition = 'all 0.5s ease-out';
    });

    // Écouter l'événement de défilement
    window.addEventListener('scroll', animateOnScroll);

    // Déclencher une première fois au chargement
    animateOnScroll();

    // Smooth scrolling pour les liens d'ancrage
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            e.preventDefault();

            const targetId = this.getAttribute('href');
            if (targetId === '#') return;

            const targetElement = document.querySelector(targetId);
            if (targetElement) {
                window.scrollTo({
                    top: targetElement.offsetTop - 80,
                    behavior: 'smooth'
                });
            }
        });
    });
});
    </script>
</body>
</html>
