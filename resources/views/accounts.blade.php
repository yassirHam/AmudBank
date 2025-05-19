@extends('client')
@section('styles')
<style>
.alert-success {
    color: #2ecc71;
    background-color: #dcfce7;
    padding: 1rem;
    border-radius: 8px;
    margin-bottom: 1.5rem;
    font-weight: 600;
    border: 1px solid #2ecc71;
}

:root {
    --primary-color: #2c3e50;
    --secondary-color: #3498db;
}

body {
    background-color: #f5f7fa;
    color: var(--primary-color);
    line-height: 1.6;
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

.account-summary {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px;
    margin-bottom: 30px;
}

.button-container {
    display: flex;
    justify-content: space-between;
    margin-bottom: 20px;
}

.btn {
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.3s;
    font-size: 14px;
    display: flex;
    align-items: center;
    gap: 8px;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
}

.btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0,0,0,0.15);
}

.btn-primary {
    background-color: var(--secondary-color);
    color: white;
    margin-right: auto;
}

.btn-primary:hover {
    background-color: #2980b9;
}

.btn-danger {
    background-color: #e74c3c;
    color: white;
    margin-left: auto;
}

.btn-danger:hover {
    background-color: #c0392b;
}

.btn-outline {
    background-color: transparent;
    border: 1px solid white;
    color: white;
}

.btn-outline:hover {
    background-color: white;
    color: var(--secondary-color);
}

/* Modal Styles */
.modal-container {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    z-index: 1000;
    justify-content: center;
    align-items: center;
}

.modal-box {
    background-color: white;
    width: 100%;
    max-width: 500px;
    border-radius: 10px;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
    padding: 25px;
    position: relative;
}

.modal-box h2 {
    margin-top: 0;
    margin-bottom: 20px;
    color: #2c3e50;
    font-size: 1.5rem;
    display: flex;
    align-items: center;
    gap: 10px;
}

.close-btn {
    position: absolute;
    top: 15px;
    right: 15px;
    font-size: 1.5rem;
    background: none;
    border: none;
    cursor: pointer;
    color: #7f8c8d;
}

.modal-form {
    display: flex;
    flex-direction: column;
    gap: 15px;
}

.form-group {
    display: flex;
    flex-direction: column;
    gap: 5px;
}

.form-group label {
    font-weight: 500;
    color: #2c3e50;
}

.form-group input,
.form-group select,
.form-group textarea {
    padding: 10px 12px;
    border: 1px solid #ddd;
    border-radius: 5px;
    font-size: 1rem;
}

.form-group textarea {
    min-height: 80px;
    resize: vertical;
}

.form-group select {
    appearance: none;
    background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6 9 12 15 18 9'%3e%3c/polyline%3e%3c/svg%3e");
    background-repeat: no-repeat;
    background-position: right 10px center;
    background-size: 1em;
}

.form-actions {
    display: flex;
    justify-content: flex-end;
    gap: 10px;
    margin-top: 10px;
}

.delete-form .btn-outline {
    border: 1px solid #e74c3c;
    color: #e74c3c;
}

.delete-form .btn-outline:hover {
    background-color: #f5f5f5;
}

.credit-card {
    width: 380px;
    height: 240px;
    background: linear-gradient(145deg, #1a3a6e 0%, #2a5a9a 50%, #3a7ac6 100%);
    border-radius: 16px;
    color: white;
    padding: 25px;
    box-sizing: border-box;
    background-image: url("{{ asset('bleu.jpg') }}");
    background-size: cover;
    background-repeat: no-repeat;
    background-position: center;
    box-shadow: 
        0 10px 30px rgba(0, 0, 0, 0.2),
        inset 0 0 0 1px rgba(255, 255, 255, 0.1);
    position: relative;
    overflow: hidden;
    transition: transform 0.3s ease;
    margin: 0 auto;
}

.credit-card:hover {
    transform: translateY(-5px);
}

.epargne {
    background-image: linear-gradient(to right, #2ecc71, #27ae60), url("{{ asset('23.jpg') }}");
    background-blend-mode: overlay;
    background-size: cover;
}

.professionnel {
    background: linear-gradient(to right, #000000, #0d0d0d, #1a1a1a);
    background-image: url("{{ asset('black.jpg') }}");
}

.bank-name {
    font-size: 22px;
    font-weight: 700;
    margin-bottom: 30px;
    letter-spacing: 1px;
    text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
    position: relative;
    z-index: 2;
}

.card-number {
    letter-spacing: 1px;
    font-size: 20px;
    letter-spacing: 3px;
    top: 55%;
    right: 13%;
    text-align: center;
    font-family: 'Courier New', monospace;
    font-weight: 600;
    text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
    position: absolute;
    z-index: 2;
}

.card-holder {
    font-size: 16px;
    letter-spacing: 2px;
    bottom: 25px;
    position: absolute;
    z-index: 2;
}

.card-bottom {
    position: absolute;
    justify-content: space-between;
    align-items: flex-end;
    bottom: 25px;
    right: 25px;
    line-height: 15px;
    margin-top: 15px;
}

.contactless {
    position: absolute;
    top: 30px;
    right: 25px;
}

.mastercard-logo {
    position: absolute;
    bottom: 25px;
    right: 25px;
}

.expiry {
    font-size: 14px;
    letter-spacing: 1px;
}

.expiry-label {
    font-size: 8px;
    opacity: 0.8;
    display: block;
    margin-bottom: 2px;
}

.bank-logo img {
    position: absolute;
    top: 40px;
    height: 50px;
    width: auto;
    font-weight: bold;
    vertical-align: middle;
}

.gloss {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(135deg, rgba(255,255,255,0.3) 0%, rgba(255,255,255,0) 60%);
    pointer-events: none;
    border-radius: 16px;
}

.tab-content a {
    text-decoration: none;
}

.alert-error {
    color: #e74c3c;
    background-color: #fdecea;
    padding: 1rem;
    border-radius: 8px;
    margin-bottom: 1.5rem;
    font-weight: 600;
    border: 1px solid #e74c3c;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .button-container {
        flex-direction: column;
        gap: 10px;
    }
    
    .btn-primary, .btn-danger {
        width: 100%;
        margin: 0;
        justify-content: center;
    }
    
    .account-summary {
        grid-template-columns: 1fr;
    }
    
    .credit-card {
        width: 100%;
        max-width: 380px;
    }
}
</style>
@endsection

@section('content') 
    <div id="accounts" class="tab-content">
        @if (session('success'))
            <div id="flash-message" class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div id="flash-message" class="alert alert-error">
                {{ session('error') }}
            </div>
        @endif
        
        <h2 class="section-title"><i class="fas fa-wallet"></i> My Accounts</h2>
        
        <div class="account-summary">
            @foreach($comptes as $compte)
            <a href="{{ route('cardinfo', ['id' => $compte->id]) }}">
                <div class="credit-card {{ $compte->type_compte }}">
                    <div class="gloss"></div>
                    <div class="bank-name">AmudBank</div>
                    <div class="bank-logo">
                        <img src="{{ asset('logo.png') }}" alt="Image">
                    </div>
                    <div class="contactless">Compte {{$compte->type_compte}}</div>
                    <div class="card-number">{{$compte->numero_carte}}</div>
                    <div class="card-bottom">
                        <span class="expiry-label">VALID THRU</span>
                        <span class="expiry">{{$compte->date_expiration}}</span>
                    </div>
                    <div class="card-holder">{{ strtoupper(auth()->user()->Prenom) }} {{ strtoupper(auth()->user()->Nom) }}</div>
                    <div class="mastercard-logo"></div>
                </div>
            </a>
            @endforeach
        </div>
        
        <div class="button-container">
            <button class="btn btn-primary" id="openAccountBtn"><i class="fas fa-plus"></i> Open New Account</button>
            <button class="btn btn-danger" id="deleteAccountBtn"><i class="fas fa-user-times"></i> Request Account Deletion</button>
        </div>
    </div>
    
    <!-- New Account Modal -->
    <div id="registrationContainer" class="modal-container">
        <div class="modal-box">
            <button class="close-btn" id="closeRegistration">&times;</button>
            <h2><i class="fas fa-plus-circle"></i> Open New Account</h2>
            @if(auth()->user()->comptes()->where('type_compte', 'epargne')->exists() && 
                auth()->user()->comptes()->where('type_compte', 'professionnel')->exists())
                <p style="color: green; margin-top: 10px;">You already have all our bank accounts!</p>
            @endif
            @if(! (auth()->user()->comptes()->where('type_compte', 'epargne')->exists() && 
                auth()->user()->comptes()->where('type_compte', 'professionnel')->exists()))
            <form id="registrationForm" class="modal-form" action="{{route('createNewBankAccount')}}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="accountType">Account Type</label>
                    <select name="type_compte" id="accountType" required>
                        <option value="">Select account type</option>
                        @if(!auth()->user()->comptes()->where('type_compte', 'epargne')->exists())
                        <option value="epargne">Savings Account</option>
                        @endif
                        @if(!auth()->user()->comptes()->where('type_compte', 'professionnel')->exists())
                        <option value="professionnel">Professional Account</option>
                        @endif
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
            @endif
        </div>
    </div>
    
    <!-- Delete Account Request Modal -->
    <div id="deleteAccountContainer" class="modal-container">
        <div class="modal-box">
            <button class="close-btn" id="closeDeleteModal">&times;</button>
            <h2><i class="fas fa-trash-alt"></i> Request Account Deletion</h2>
            <form id="deleteAccountForm" class="modal-form delete-form" action="{{route('requestdelete')}}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="accountToDelete">Select Account</label>
                    <select name="type_compte" id="accountToDelete" required>
                        <option value="">Select an account</option>
                        @foreach($comptes as $compte)
                            <option value="{{ $compte->type_compte }}">{{ ucfirst($compte->type_compte) }} - {{ $compte->numero_carte }}</option>
                        @endforeach
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="deletionReason">Reason for Deletion</label>
                    <select name="motif" id="deletionReason" required>
                        <option value="">Select a reason</option>
                        <option value="no_longer_needed">I no longer need this account</option>
                        <option value="switching_banks">I'm switching to another bank</option>
                        <option value="dissatisfied">Dissatisfied with services</option>
                        <option value="other">Other reason</option>
                    </select>
                </div>
                
                
                <div class="form-group">
                    <label>
                        <input type="checkbox" id="confirmDelete" required>
                        I understand this is a deletion request and my account will be reviewed by the bank
                    </label>
                </div>
                
                <div class="form-actions">
                    <button type="button" class="btn btn-outline" id="cancelDelete">Cancel</button>
                    <button type="submit" class="btn btn-danger">Submit Request</button>
                </div>
            </form>
        </div>
    </div>
    
    <script>
    // New Account Modal
    const openAccountBtn = document.getElementById('openAccountBtn');
    const registrationContainer = document.getElementById('registrationContainer');
    const closeRegistrationBtn = document.getElementById('closeRegistration');
    const cancelRegistrationBtn = document.getElementById('cancelRegistration');
    const registrationForm = document.getElementById('registrationForm');

    // Delete Account Modal
    const deleteAccountBtn = document.getElementById('deleteAccountBtn');
    const deleteAccountContainer = document.getElementById('deleteAccountContainer');
    const closeDeleteBtn = document.getElementById('closeDeleteModal');
    const cancelDeleteBtn = document.getElementById('cancelDelete');
    const deleteAccountForm = document.getElementById('deleteAccountForm');

    // Show/hide registration modal
    function showRegistration() {
        registrationContainer.style.display = 'flex';
    }

    function hideRegistration() {
        registrationContainer.style.display = 'none';
        if (registrationForm) registrationForm.reset();
    }

    // Show/hide delete modal
    function showDeleteModal() {
        deleteAccountContainer.style.display = 'flex';
    }

    function hideDeleteModal() {
        deleteAccountContainer.style.display = 'none';
        if (deleteAccountForm) deleteAccountForm.reset();
        document.getElementById('otherReasonContainer').style.display = 'none';
    }

    // Event listeners for registration modal
    if (openAccountBtn) {
        openAccountBtn.addEventListener('click', showRegistration);
    }

    if (closeRegistrationBtn) {
        closeRegistrationBtn.addEventListener('click', hideRegistration);
    }

    if (cancelRegistrationBtn) {
        cancelRegistrationBtn.addEventListener('click', hideRegistration);
    }

    // Event listeners for delete modal
    if (deleteAccountBtn) {
        deleteAccountBtn.addEventListener('click', showDeleteModal);
    }

    if (closeDeleteBtn) {
        closeDeleteBtn.addEventListener('click', hideDeleteModal);
    }

    if (cancelDeleteBtn) {
        cancelDeleteBtn.addEventListener('click', hideDeleteModal);
    }

    // Close modals when clicking outside
    registrationContainer.addEventListener('click', (e) => {
        if (e.target === registrationContainer) {
            hideRegistration();
        }
    });

    deleteAccountContainer.addEventListener('click', (e) => {
        if (e.target === deleteAccountContainer) {
            hideDeleteModal();
        }
    });

    // Form submissions
    if (registrationForm) {
        registrationForm.addEventListener('submit', function(e) {
            e.preventDefault();
            this.submit();
        });
    }

    // if (deleteAccountForm) {
    //     deleteAccountForm.addEventListener('submit', function(e) {
    //         e.preventDefault();
    //         if (confirm('Are you sure you want to submit this account deletion request?')) {
    //             this.submit();
    //         }
    //     });
    // }

    // Show/hide other reason field based on selection
    const deletionReason = document.getElementById('deletionReason');
    const otherReasonContainer = document.getElementById('otherReasonContainer');

    if (deletionReason && otherReasonContainer) {
        deletionReason.addEventListener('change', function() {
            if (this.value === 'other') {
                otherReasonContainer.style.display = 'block';
            } else {
                otherReasonContainer.style.display = 'none';
            }
        });
    }

    // Flash message fade out
    const flashMessages = document.querySelectorAll('#flash-message');
    if (flashMessages.length > 0) {
        flashMessages.forEach(flash => {
            setTimeout(() => {
                flash.style.opacity = '0';
                setTimeout(() => {
                    flash.style.display = 'none';
                }, 500);
            }, 3000);
        });
    }
    </script>
@endsection