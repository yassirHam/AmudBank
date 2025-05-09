<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MyBank - User Profile</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/client.css') }}">
    
</head>
<style>
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

<body>
    <header>
        <div class="container header-container">
            <div class="logo">
                <i class="fas fa-university"></i>
                <span>AmurBank</span>
            </div>
            <nav>
                <ul>
                    <li><a href="#"><i class="fas fa-home"></i> Dashboard</a></li>
                    <li><a href="#"><i class="fas fa-credit-card"></i> Cards</a></li>
                    <li><a href="#"><i class="fas fa-exchange-alt"></i> Transfers</a></li>
                    <li><a href="#" class="active"><i class="fas fa-user"></i> Profile</a></li>
                    <li>                
                    <a href="#"
                    onclick="handleLogout(event)">
                    <i class="fas fa-sign-out-alt"></i> Logout
                    </a>

                    </li>
                </ul>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </nav>
        </div>
    </header>

    <div class="container">
        <div class="profile-container">
            <div class="profile-sidebar">
                <!-- <div class="profile-header">
                    <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Profile Picture" class="profile-pic">
                    <h3 class="profile-name">John Doe</h3>
                    <p class="profile-email">john.doe@example.com</p>
                    <button class="btn btn-primary"><i class="fas fa-camera"></i> Change Photo</button>
                </div> -->
                <ul class="profile-menu">
                    <li><a href="#" class="active" data-tab="overview"><i class="fas fa-chart-pie"></i> Overview</a></li>
                    <li><a href="#" data-tab="accounts"><i class="fas fa-wallet"></i> Accounts</a></li>
                    <li><a href="#" data-tab="transactions"><i class="fas fa-exchange-alt"></i> Transactions</a></li>
                    <li><a href="#" data-tab="settings"><i class="fas fa-cog"></i> Settings</a></li>
                    <li><a href="#" data-tab="security"><i class="fas fa-shield-alt"></i> Security</a></li>
                </ul>
            </div>

            <div class="profile-content">
                <!-- Overview Tab -->
                <div id="overview" class="tab-content active">
                    <h2 class="section-title"><i class="fas fa-chart-pie"></i> Account Overview</h2>
                    
                    <div class="account-summary">
                        <div class="account-card">
                            <p class="account-type">Primary Account</p>
                            <h3 class="account-balance">$12,450.50</h3>
                            <p class="account-number">**** **** **** 4567</p>
                            <div class="account-actions">
                                <button class="btn btn-sm btn-outline"><i class="fas fa-exchange-alt"></i> Transfer</button>
                                <button class="btn btn-sm btn-outline"><i class="fas fa-history"></i> History</button>
                            </div>
                        </div>
                        <div class="account-card">
                            <p class="account-type">Savings Account</p>
                            <h3 class="account-balance">$8,720.00</h3>
                            <p class="account-number">**** **** **** 8910</p>
                            <div class="account-actions">
                                <button class="btn btn-sm btn-outline"><i class="fas fa-exchange-alt"></i> Transfer</button>
                                <button class="btn btn-sm btn-outline"><i class="fas fa-history"></i> History</button>
                            </div>
                        </div>
                    </div>

                    <div class="recent-transactions">
                        <h3 class="section-title"><i class="fas fa-history"></i> Recent Transactions</h3>
                        <table class="transaction-table">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Description</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Jun 15, 2023</td>
                                    <td>Grocery Store</td>
                                    <td class="transaction-amount debit">-$125.50</td>
                                    <td><span class="transaction-status status-completed">Completed</span></td>
                                </tr>
                                <tr>
                                    <td>Jun 14, 2023</td>
                                    <td>Salary Deposit</td>
                                    <td class="transaction-amount credit">+$3,500.00</td>
                                    <td><span class="transaction-status status-completed">Completed</span></td>
                                </tr>
                                <tr>
                                    <td>Jun 12, 2023</td>
                                    <td>Online Shopping</td>
                                    <td class="transaction-amount debit">-$89.99</td>
                                    <td><span class="transaction-status status-completed">Completed</span></td>
                                </tr>
                                <tr>
                                    <td>Jun 10, 2023</td>
                                    <td>Utility Bill Payment</td>
                                    <td class="transaction-amount debit">-$220.75</td>
                                    <td><span class="transaction-status status-pending">Pending</span></td>
                                </tr>
                                <tr>
                                    <td>Jun 8, 2023</td>
                                    <td>Transfer to Friend</td>
                                    <td class="transaction-amount debit">-$200.00</td>
                                    <td><span class="transaction-status status-completed">Completed</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                
                <!-- Accounts Tab -->
                <div id="accounts" class="tab-content">
                @if (session('success'))
                    <div id="flash-message" class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                    <h2 class="section-title"><i class="fas fa-wallet"></i> My Accounts</h2>
                    <div class="account-summary">
                        <div class="account-card">
                            <p class="account-type">Primary Account</p>
                            <h3 class="account-balance">$12,450.50</h3>
                            <p class="account-number">**** **** **** 4567</p>
                            <div class="account-actions">
                                <button class="btn btn-sm btn-outline"><i class="fas fa-exchange-alt"></i> Transfer</button>
                                <button class="btn btn-sm btn-outline"><i class="fas fa-history"></i> History</button>
                                <button class="btn btn-sm btn-outline"><i class="fas fa-ellipsis-h"></i> More</button>
                            </div>
                        </div>
                        <div class="account-card">
                            <p class="account-type">Savings Account</p>
                            <h3 class="account-balance">$8,720.00</h3>
                            <p class="account-number">**** **** **** 8910</p>
                            <div class="account-actions">
                                <button class="btn btn-sm btn-outline"><i class="fas fa-exchange-alt"></i> Transfer</button>
                                <button class="btn btn-sm btn-outline"><i class="fas fa-history"></i> History</button>
                                <button class="btn btn-sm btn-outline"><i class="fas fa-ellipsis-h"></i> More</button>
                            </div>
                        </div>
                        <div class="account-card">
                            <p class="account-type">Investment Account</p>
                            <h3 class="account-balance">$24,300.25</h3>
                            <p class="account-number">**** **** **** 1234</p>
                            <div class="account-actions">
                                <button class="btn btn-sm btn-outline"><i class="fas fa-exchange-alt"></i> Transfer</button>
                                <button class="btn btn-sm btn-outline"><i class="fas fa-history"></i> History</button>
                                <button class="btn btn-sm btn-outline"><i class="fas fa-ellipsis-h"></i> More</button>
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-primary"><i class="fas fa-plus"></i> Open New Account</button>
                </div>
                <div id="registrationContainer">
                    <div class="registration-box">
                        <button class="close-btn" id="closeRegistration">&times;</button>
                        <h2><i class="fas fa-plus-circle"></i> Open New Account</h2>
                        
                        <form id="registrationForm" action="{{route('createNewBankAccount')}}" method="POST">
                        @csrf
                            <div class="form-group">
                                <label for="accountType">Account Type</label>
                                <select name="type_compte" id="accountType" required>
                                    <option value="">Sélectionnez un type de compte</option>
                                    <option value="epargne">Compte d'épargne</option>
                                    <option value="professionnel">Compte professionnel</option>
                                </select>
                            </div>
                            
                            <div class="form-group">
                                <label>
                                    <input type="checkbox" id="agreeTerms" required>
                                    I agree to the terms and conditions
                                </label>
                            </div>
                            
                            <div class="form-actions">
                                <button type="button" class="btn btn-outline" id="cancelRegistration">Cancel</button>
                                <button type="submit" class="btn btn-primary">Open Account</button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Transactions Tab -->
                <div id="transactions" class="tab-content">
                    <h2 class="section-title"><i class="fas fa-exchange-alt"></i> Transaction History</h2>
                    <div class="filters" style="margin-bottom: 20px; display: flex; gap: 15px;">
                        <select class="btn" style="padding: 8px 15px;">
                            <option>All Accounts</option>
                            <option>Primary Account</option>
                            <option>Savings Account</option>
                            <option>Investment Account</option>
                        </select>
                        <select class="btn" style="padding: 8px 15px;">
                            <option>Last 30 Days</option>
                            <option>Last 60 Days</option>
                            <option>Last 90 Days</option>
                            <option>This Year</option>
                            <option>All Time</option>
                        </select>
                        <select class="btn" style="padding: 8px 15px;">
                            <option>All Transactions</option>
                            <option>Credits Only</option>
                            <option>Debits Only</option>
                        </select>
                        <button class="btn btn-primary"><i class="fas fa-filter"></i> Apply</button>
                    </div>
                    <table class="transaction-table">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Description</th>
                                <th>Account</th>
                                <th>Amount</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Jun 15, 2023</td>
                                <td>Grocery Store</td>
                                <td>Primary</td>
                                <td class="transaction-amount debit">-$125.50</td>
                                <td><span class="transaction-status status-completed">Completed</span></td>
                            </tr>
                            <tr>
                                <td>Jun 14, 2023</td>
                                <td>Salary Deposit</td>
                                <td>Primary</td>
                                <td class="transaction-amount credit">+$3,500.00</td>
                                <td><span class="transaction-status status-completed">Completed</span></td>
                            </tr>
                            <tr>
                                <td>Jun 12, 2023</td>
                                <td>Online Shopping</td>
                                <td>Primary</td>
                                <td class="transaction-amount debit">-$89.99</td>
                                <td><span class="transaction-status status-completed">Completed</span></td>
                            </tr>
                            <tr>
                                <td>Jun 10, 2023</td>
                                <td>Utility Bill Payment</td>
                                <td>Primary</td>
                                <td class="transaction-amount debit">-$220.75</td>
                                <td><span class="transaction-status status-pending">Pending</span></td>
                            </tr>
                            <tr>
                                <td>Jun 8, 2023</td>
                                <td>Transfer to Friend</td>
                                <td>Primary</td>
                                <td class="transaction-amount debit">-$200.00</td>
                                <td><span class="transaction-status status-completed">Completed</span></td>
                            </tr>
                            <tr>
                                <td>Jun 5, 2023</td>
                                <td>Dividend Payment</td>
                                <td>Investment</td>
                                <td class="transaction-amount credit">+$150.25</td>
                                <td><span class="transaction-status status-completed">Completed</span></td>
                            </tr>
                            <tr>
                                <td>Jun 3, 2023</td>
                                <td>Monthly Savings</td>
                                <td>Savings</td>
                                <td class="transaction-amount credit">+$500.00</td>
                                <td><span class="transaction-status status-completed">Completed</span></td>
                            </tr>
                        </tbody>
                    </table>
                    <div style="margin-top: 20px; text-align: center;">
                        <button class="btn" style="margin-right: 10px;"><i class="fas fa-chevron-left"></i> Previous</button>
                        <button class="btn btn-primary">Next <i class="fas fa-chevron-right"></i></button>
                    </div>
                </div>

                <!-- Settings Tab -->
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
                            <p class="info-label">Rip</p>
                            <p class="info-value">{{ auth()->user()->rip }}</p>
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

                <!-- Security Tab -->
                <div id="security" class="tab-content">
                    <h2 class="section-title"><i class="fas fa-shield-alt"></i> Security Settings</h2>
                    <div style="background-color: var(--light-color); padding: 20px; border-radius: 8px; margin-bottom: 20px;">
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px;">
                            <div>
                                <p style="font-weight: 500;">Password</p>
                                <p style="font-size: 14px; color: #7f8c8d;">Last changed 3 months ago</p>
                            </div>
                            <button class="btn btn-primary">Change Password</button>
                        </div>
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px;">
                            <div>
                                <p style="font-weight: 500;">Two-Factor Authentication</p>
                                <p style="font-size: 14px; color: #7f8c8d;">Add an extra layer of security</p>
                            </div>
                            <label class="switch">
                                <input type="checkbox" checked>
                                <span class="slider round"></span>
                            </label>
                        </div>
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <div>
                                <p style="font-weight: 500;">Login Alerts</p>
                                <p style="font-size: 14px; color: #7f8c8d;">Get notified of new logins</p>
                            </div>
                            <label class="switch">
                                <input type="checkbox" checked>
                                <span class="slider round"></span>
                            </label>
                        </div>
                    </div>

                    <h3 class="section-title"><i class="fas fa-lock"></i> Active Sessions</h3>
                    <table class="transaction-table" style="margin-bottom: 20px;">
                        <thead>
                            <tr>
                                <th>Device</th>
                                <th>Location</th>
                                <th>Last Active</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Chrome on Windows</td>
                                <td>New York, USA</td>
                                <td>Just now</td>
                                <td><button class="btn btn-sm" style="color: var(--accent-color);">Logout</button></td>
                            </tr>
                            <tr>
                                <td>Safari on iPhone</td>
                                <td>Boston, USA</td>
                                <td>2 hours ago</td>
                                <td><button class="btn btn-sm" style="color: var(--accent-color);">Logout</button></td>
                            </tr>
                            <tr>
                                <td>Firefox on Mac</td>
                                <td>San Francisco, USA</td>
                                <td>1 week ago</td>
                                <td><button class="btn btn-sm" style="color: var(--accent-color);">Logout</button></td>
                            </tr>
                        </tbody>
                    </table>

                    <button class="btn" style="color: var(--accent-color);"><i class="fas fa-sign-out-alt"></i> Logout All Devices</button>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/client.js') }}"></script>
    <script>
// Function to evaluate password strength
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
</body>
</html>