@extends('client')
@section('styles')
<style>
:root {
    --primary-color: #2c3e50;
    --secondary-color: #3498db;
    --accent-color: #e74c3c;
    --light-color: #ecf0f1;
    --dark-color: #2c3e50;
    --success-color: #2ecc71;
    --danger-color: #e74c3c;
    --border-radius: 8px;
}

.section-title {
    font-size: 22px;
    margin-bottom: 20px;
    color: var(--primary-color);
    display: flex;
    align-items: center;
}

.section-title i {
    margin-right: 10px;
}

.personal-info {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 20px;
}

.info-item {
    margin-bottom: 15px;
}

.info-label {
    font-size: 14px;
    color: #7f8c8d;
    margin-bottom: 5px;
}

.info-value {
    font-size: 16px;
    font-weight: 500;
}

.btn {
    padding: 8px 15px;
    border: none;
    border-radius: 5px;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.3s;
    font-size: 14px;
}

.btn-primary {
    background-color: var(--secondary-color);
    color: white;
}

.btn-primary:hover {
    background-color: #2980b9;
}

.btn-success {
    background-color: var(--success-color);
    color: white;
}

.btn-secondary {
    background-color: #95a5a6;
    color: white;
}

.form-group {
    margin-bottom: 15px;
}

.form-control {
    width: 100%;
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 4px;
    background-color: white;
}

label {
    display: block;
    margin-bottom: 5px;
    font-weight: 500;
}

textarea.form-control {
    min-height: 100px;
}

/* Password strength meter */
.password-strength {
    display: flex;
    align-items: center;
    margin-top: 5px;
}

.strength-bar {
    height: 4px;
    background: #e0e0e0;
    flex-grow: 1;
    margin-right: 3px;
    border-radius: 2px;
}

.strength-text {
    font-size: 12px;
    margin-left: 8px;
}

.password-strength.weak .strength-bar:nth-child(-n+1) {
    background: var(--accent-color);
}

.password-strength.medium .strength-bar:nth-child(-n+2) {
    background: #f39c12;
}

.password-strength.strong .strength-bar {
    background: var(--success-color);
}

/* Toggle switch */
.switch {
    position: relative;
    display: inline-block;
    width: 50px;
    height: 24px;
}

.switch input {
    opacity: 0;
    width: 0;
    height: 0;
}

.slider {
    position: absolute;
    cursor: pointer;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: #ccc;
    transition: .4s;
}

.slider:before {
    position: absolute;
    content: "";
    height: 16px;
    width: 16px;
    left: 4px;
    bottom: 4px;
    background-color: white;
    transition: .4s;
}

input:checked + .slider {
    background-color: var(--secondary-color);
}

input:checked + .slider:before {
    transform: translateX(26px);
}

.slider.round {
    border-radius: 24px;
}

.slider.round:before {
    border-radius: 50%;
}


.tab-content.active {
    display: block;
}
.password-strength {
    display: flex;
    align-items: center;
    gap: 4px;
    margin-top: 4px;
}

.strength-bar {
    height: 4px;
    width: 30px;
    background-color: #e0e0e0; /* Default: empty bar */
    border-radius: 2px;
}

/* Strength states (updated via JS) */
.password-strength.weak .strength-bar:nth-child(1) {
    background-color: #ff4d4f; /* Red (weak) */
}
.password-strength.medium .strength-bar:nth-child(-n+2) {
    background-color: #faad14; /* Yellow (medium) */
}
.password-strength.strong .strength-bar {
    background-color: #52c41a; /* Green (strong) */
}

.strength-text {
    margin-left: 8px;
    font-size: 12px;
    color: #666;
}
</style>
@endsection
@section('content') 

<div id="settings" class="tab-content">
                    @if(session('success'))
                        <div style="color: var(--success-color); background-color: #dcfce7; padding: 1rem; border-radius: var(--border-radius); margin-bottom: 1.5rem;">
                            <p style="margin: 0; font-weight: 500;">
                                <i class="fas fa-check-circle"></i> {{ session('success') }}
                            </p>
                        </div>
                    @endif
                    @if($errors->any())
                        <div style="color: var(--danger-color); background-color: #fee2e2; padding: 1rem; border-radius: var(--border-radius); margin-bottom: 1.5rem;">
                            <ul style="list-style-type: none;">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <h2 class="section-title"><i class="fas fa-cog"></i> Profile Settings</h2>
                    <div class="personal-info">
                        <div class="info-item">
                            <p class="info-label">First Name</p>
                            <p class="info-value">{{ auth()->user()->Prenom }}</p>
                        </div>
                        <div class="info-item">
                            <p class="info-label">Last Name</p>
                            <p class="info-value">{{ auth()->user()->Nom }}</p>
                        </div>
                        <div class="info-item">
                            <p class="info-label">Cin</p>
                            <p class="info-value">{{ auth()->user()->Cin }}</p>
                        </div>

                        <div class="info-item">
                            <p class="info-label">Email</p>
                            <p class="info-value">{{ auth()->user()->email }}</p>
                        </div>

                        <div class="info-item">
                            <p class="info-label">Phone Number</p>
                            <p class="info-value">{{ auth()->user()->telephone }}</p>
                        </div>
                    
                        <div class="info-item">
                            <p class="info-label">Address</p>
                            <p class="info-value">{{ auth()->user()->adresse }}</p>
                        </div>

                        <div class="info-item">
                            <p class="info-label">password</p>
                            <p class="info-value">********</p>
                        </div>

                        <div class="info-item">
                            <p class="info-label">Date of Birth</p>
                            <p class="info-value">{{ auth()->user()->birthday }}</p>
                        </div>

                    </div>
                    <button id='editProfileBtn' class="btn btn-primary"><i class="fas fa-edit"></i> Edit Profile</button>
                
        <div id="editProfileForm" style="display: none; margin-top: 20px; background-color: var(--light-color); padding: 20px; border-radius: 8px;">
            <h3 class="section-title"><i class="fas fa-user-edit"></i> Edit Profile Information</h3>
        
            <form action="{{ route('changeProfile') }}" method="POST">
                @csrf
                @method('PATCH')


                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ auth()->user()->email }}">
                </div>
                
                <div class="form-group">
                    <label for="telephone">Phone Number</label>
                    <input type="text" class="form-control" id="telephone" name="telephone" value="{{ auth()->user()->telephone }}">
                </div>
                
                <div class="form-group">
                    <label for="adresse">Address</label>
                    <textarea class="form-control" id="adresse" name="adresse" rows="3">{{ auth()->user()->adresse }}</textarea>
                </div>
                
                <div class="form-group">
                    <label for="current_password">Current Password (to confirm changes)</label>
                    <input type="password" class="form-control" id="current_password" name="current_password">
                </div>
                
                 <div class="form-group">
                    <label for="new_password">New Password (leave blank to keep current)</label>
                    <input type="password" class="form-control" id="new_password" name="new_password">
                    <!-- Password strength meter -->
                    <div class="password-strength">
                        <div class="strength-bar"></div>
                        <div class="strength-bar"></div>
                        <div class="strength-bar"></div>
                        <span class="strength-text">Faible</span>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="new_password_confirmation">Confirm New Password</label>
                    <input type="password" class="form-control" id="new_password_confirmation" name="new_password_confirmation">
                </div>
                
                <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Save Changes</button>
                <button type="button" id="cancelEditBtn" class="btn btn-secondary"><i class="fas fa-times"></i> Cancel</button>
            </form>
        </div>
                    <h3 class="section-title" style="margin-top: 30px;"><i class="fas fa-bell"></i> Notification Preferences</h3>
                    <div style="background-color: var(--light-color); padding: 20px; border-radius: 8px; margin-bottom: 20px;">
                        <div style="display: flex; justify-content: space-between; margin-bottom: 15px;">
                            <div>
                                <p style="font-weight: 500;">Email Notifications</p>
                                <p style="font-size: 14px; color: #7f8c8d;">Receive important updates via email</p>
                            </div>
                            <label class="switch">
                                <input type="checkbox" checked>
                                <span class="slider round"></span>
                            </label>
                        </div>
                        <div style="display: flex; justify-content: space-between;">
                            <div>
                                <p style="font-weight: 500;">SMS Notifications</p>
                                <p style="font-size: 14px; color: #7f8c8d;">Receive transaction alerts via SMS</p>
                            </div>
                            <label class="switch">
                                <input type="checkbox">
                                <span class="slider round"></span>
                            </label>
                        </div>
                    </div>
                </div>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
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

        function updatePasswordStrength(password) {
    const strengthMeter = document.querySelector('#new_password').nextElementSibling; // Targets the .password-strength div
    const strengthText = strengthMeter.querySelector('.strength-text');
    let strength = 0;

    // Strength criteria (customize as needed)
    if (password.length >= 8) strength++;
    if (password.match(/[A-Z]/)) strength++; // Uppercase
    if (password.match(/[0-9!@#$%^&*]/)) strength++; // Number/symbol

    // Update UI
    strengthMeter.className = 'password-strength'; // Reset classes
    if (strength === 0) {
        strengthText.textContent = 'Très faible';
    } else if (strength === 1) {
        strengthMeter.classList.add('weak');
        strengthText.textContent = 'Faible';
    } else if (strength === 2) {
        strengthMeter.classList.add('medium');
        strengthText.textContent = 'Moyen';
    } else if (strength >= 3) {
        strengthMeter.classList.add('strong');
        strengthText.textContent = 'Fort';
    }
}

// Attach event listener to the password input
document.getElementById('new_password').addEventListener('input', (e) => {
    updatePasswordStrength(e.target.value);
});
</script>
@endsection