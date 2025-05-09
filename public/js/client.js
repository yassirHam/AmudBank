document.addEventListener('DOMContentLoaded', function() {
    // Tab system initialization
    const tabLinks = document.querySelectorAll('.profile-menu a');
    
    // Function to activate a tab
    function activateTab(tabId) {
        // Remove active class from all
        tabLinks.forEach(l => l.classList.remove('active'));
        document.querySelectorAll('.tab-content').forEach(tab => {
            tab.classList.remove('active');
        });
        
        // Activate the selected one
        const link = document.querySelector(`.profile-menu a[data-tab="${tabId}"]`);
        const tab = document.getElementById(tabId);
        
        if (link && tab) {
            link.classList.add('active');
            tab.classList.add('active');
            localStorage.setItem('menuactive', tabId);
        }
    }
    
    // Tab click handler
    tabLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            activateTab(this.getAttribute('data-tab'));
        });
    });
    
    // Check localStorage and activate saved tab
    const savedTab = localStorage.getItem('menuactive');
    if (savedTab) {
        activateTab(savedTab);
    } else {
        // Default to first tab if nothing saved
        activateTab(tabLinks[0].getAttribute('data-tab'));
    }
    
    // Rest of your code (switches, animations, etc.)
    const switches = document.querySelectorAll('.switch input');
    switches.forEach(sw => {
        // ... your existing switch code ...
    });
    
    // Edit profile functionality
    const editBtn = document.getElementById('editProfileBtn');
    const cancelBtn = document.getElementById('cancelEditBtn');
    const editForm = document.getElementById('editProfileForm');
    const personalInfo = document.querySelector('.personal-info');
    
    if (editBtn && cancelBtn) {
        editBtn.addEventListener('click', function() {
            personalInfo.style.display = 'none';
            editForm.style.display = 'block';
            editBtn.style.display = 'none';
        });
        
        cancelBtn.addEventListener('click', function() {
            personalInfo.style.display = 'grid';
            editForm.style.display = 'none';
            editBtn.style.display = 'block';
        });
    }
    
    // Account balance animation
    const overviewTab = document.getElementById('overview');
    if (overviewTab) {
        const observer = new MutationObserver(function(mutations) {
            mutations.forEach(function(mutation) {
                if (mutation.attributeName === 'class' && 
                    overviewTab.classList.contains('active')) {
                    const balances = document.querySelectorAll('.account-balance');
                    balances.forEach(balance => {
                        const amount = parseFloat(balance.textContent.replace('$', ''));
                        balance.textContent = '$0.00';
                        animateBalance(balance, amount);
                    });
                }
            });
        });
        observer.observe(overviewTab, { attributes: true });
    }
});

function animateBalance(element, target) {
    let current = 0;
    const increment = target / 100;
    const timer = setInterval(() => {
        current += increment;
        element.textContent = '$' + current.toFixed(2);
        if (current >= target) {
            element.textContent = '$' + target.toFixed(2);
            clearInterval(timer);
        }
    }, 10);

}
function handleLogout(event) {
    event.preventDefault();

    // Définir 'menuactive' dans localStorage
    localStorage.setItem('menuactive', 'overview');

    // Soumettre le formulaire de logout
    document.getElementById('logout-form').submit();
}
// Sélection des éléments
const openAccountBtn = document.querySelector('.btn-primary[onclick="showRegistration()"]') || 
                      document.querySelector('.btn-primary:has(i.fa-plus)');
const registrationContainer = document.getElementById('registrationContainer');
const closeBtn = document.getElementById('closeRegistration');
const cancelBtn = document.getElementById('cancelRegistration');
const registrationForm = document.getElementById('registrationForm');

// Fonction pour afficher le formulaire
function showRegistration() {
    registrationContainer.style.display = 'flex';
    setTimeout(() => {
        registrationContainer.style.opacity = '1';
        registrationContainer.querySelector('.registration-box').style.transform = 'translateY(0)';
    }, 10);
}

// Fonction pour masquer le formulaire
function hideRegistration() {
    const box = registrationContainer.querySelector('.registration-box');
    box.style.transform = 'translateY(-20px)';
    registrationContainer.style.opacity = '0';
    
    setTimeout(() => {
        registrationContainer.style.display = 'none';
        registrationForm.reset(); // Réinitialiser le formulaire
    }, 300);
}

// Événements
if (openAccountBtn) {
    openAccountBtn.addEventListener('click', (e) => {
        e.preventDefault();
        showRegistration();
    });
}

if (closeBtn) {
    closeBtn.addEventListener('click', hideRegistration);
}

if (cancelBtn) {
    cancelBtn.addEventListener('click', hideRegistration);
}

// Fermer en cliquant à l'extérieur de la boîte
registrationContainer.addEventListener('click', (e) => {
    if (e.target === registrationContainer) {
        hideRegistration();
    }
});

// Empêcher la fermeture quand on clique dans la boîte
registrationContainer.querySelector('.registration-box').addEventListener('click', (e) => {
    e.stopPropagation();
});

// Gestion de la soumission du formulaire
if (registrationForm) {
    registrationForm.addEventListener('submit', (e) => {
        e.preventDefault();
        
        // Ici vous pouvez ajouter votre logique de soumission
        // Par exemple une requête AJAX
        
        // Simulation de succès
        console.log('Formulaire soumis avec succès');
        hideRegistration();
        

    });
}
// Ajoutez ce code temporairement dans votre fichier JS principal
document.getElementById('registrationForm').addEventListener('submit', function(e) {
    e.preventDefault();
    console.log('Form submitted!'); // Vérifiez dans la console F12
    this.submit(); // Envoyer le formulaire manuellement
});
window.addEventListener('DOMContentLoaded', function () {
    const flash = document.getElementById('flash-message');
    if (flash) {
        setTimeout(() => {
            flash.style.opacity = '0';
            setTimeout(() => {
                flash.style.display = 'none';
            }, 500); // attendre la fin de la transition
        }, 3000); // 3 secondes d'affichage
    }
});

// Intégration avec les onglets existants (si nécessaire)
document.querySelectorAll('[data-tab]').forEach(tab => {
    tab.addEventListener('click', (e) => {
        e.preventDefault();
        // Masquer le formulaire si un onglet est cliqué
        if (registrationContainer.style.display === 'flex') {
            hideRegistration();
        }
    });
});