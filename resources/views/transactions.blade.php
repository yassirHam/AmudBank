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

.transfer-type-selector {
    display: flex;
    margin-bottom: 20px;
    border-radius: 5px;
    overflow: hidden;
    border: 1px solid #ccc;
}

.transfer-type-btn {
    flex: 1;
    padding: 10px;
    text-align: center;
    background: white;
    cursor: pointer;
    transition: all 0.3s;
    border: none;
}

.transfer-type-btn.active {
    background-color: var(--secondary-color);
    color: white;
}

.transfer-form {
    margin-top: 20px;
}

.transfer-section {
    display: none;
}

.transfer-section.active {
    display: block;
}

.alert-success {
    background-color: #d4edda;  
    color: #155724;             
    border: 1px solid #c3e6cb;
    padding: 15px;
    border-radius: 5px;
    margin: 15px 0;
    font-size: 16px;
    position: relative;
}

.alert-danger {
    background-color: #f8d7da;  
    color: #721c24;             
    border: 1px solid #f5c6cb;
    padding: 15px;
    border-radius: 5px;
    margin: 15px 0;
    font-size: 16px;
    position: relative;
}

.transfer-form h3 {
    color: var(--primary-color);
    margin-bottom: 15px;
    font-size: 20px;
}

.transfer-form label {
    font-weight: 500;
    display: block;
    margin-top: 15px;
}

.transfer-form input, 
.transfer-form select, 
.transfer-form textarea {
    width: 100%;
    padding: 10px;
    margin-top: 5px;
    border-radius: 5px;
    border: 1px solid #ccc;
    font-size: 14px;
}

.transfer-form button {
    margin-top: 20px;
    width: 100%;
}

.internal-transfer .account-select {
    margin-bottom: 15px;
}

.external-transfer .bank-info {
    margin-bottom: 15px;
}
</style>
@endsection

@section('content')
<div class="transfer-container">
    <h3 class="section-title"><i class="fas fa-paper-plane"></i> Effectuer un Virement</h3>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul style="list-style-type: none;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="transfer-type-selector">
        <button type="button" class="transfer-type-btn active" data-type="internal">Virement Interne</button>
        <button type="button" class="transfer-type-btn" data-type="external">Virement Externe</button>
    </div>

    <!-- Virement Interne -->
    <form id="internal-transfer-form" class="transfer-form internal-transfer transfer-section active" method="POST" action="{{ route('internal_transfer') }}">
        @csrf
        <div class="account-select">
            <label for="source-account">Compte Source</label>
            <select id="source-account" name="source" required>
                <option value="">-- Sélectionner le compte source --</option>
                @foreach(auth()->user()->comptes as $compte)
                    <option value="{{ $compte->type_compte }}">Compte {{ $compte->type_compte }} ({{ $compte->numero_carte }}) - Solde: {{ $compte->solde }} MAD</option>
                @endforeach
            </select>
        </div>

        <div class="account-select">
            <label for="target-account">Compte Destination</label>
            <select id="target-account" name="compte_destinataire" required>
                <option value="">-- Sélectionner le compte destination --</option>
                @foreach(auth()->user()->comptes as $compte)
                    <option value="{{ $compte->type_compte }}">Compte {{ $compte->type_compte }} ({{ $compte->numero_carte }})</option>
                @endforeach
            </select>
        </div>

        <label for="internal-amount">Montant (MAD)</label>
        <input type="number" name="montant" id="internal-amount" step="0.01" min="0.01" placeholder="ex : 500.00" required>

        <label for="internal-description">Description (Facultatif)</label>
        <textarea id="internal-description" name="description" rows="2" placeholder="Description du virement"></textarea>

        <button type="submit" class="btn btn-primary">Effectuer le virement interne</button>
    </form>

    <!-- Virement Externe -->
    <form id="external-transfer-form" class="transfer-form external-transfer transfer-section" method="POST" action="{{ route('faireTransactions') }}">
        @csrf
        <div class="account-select">
            <label for="external-source-account">Compte Source</label>
            <select id="external-source-account" name="source" required>
                <option value="">-- Sélectionner le compte source --</option>
                @foreach(auth()->user()->comptes as $compte)
                    <option value="{{ $compte->type_compte }}">Compte {{ $compte->type_compte }} ({{ $compte->numero_carte }}) - Solde: {{ $compte->solde }} MAD</option>
                @endforeach
            </select>
        </div>
        <div class="bank-info">
            <label for="bank-name">Nom de la banque du bénéficiaire</label>
            <select id="bank-name" name="banque_destinataire" required>
                <option value="">-- Sélectionnez une banque --</option>
                <option value="AmudBank">Amud Bank</option>
                <option value="Al Barid Bank">Al Barid Bank</option>
                <option value="Attijariwafa Bank">Attijariwafa Bank</option>
                <option value="Banque Populaire">Banque Populaire</option>
                <option value="BMCE Bank">BMCE Bank (Bank of Africa)</option>
                <option value="CIH Bank">CIH Bank</option>
                <option value="Crédit Agricole du Maroc">Crédit Agricole du Maroc</option>
                <option value="Crédit du Maroc">Crédit du Maroc</option>
                <option value="Société Générale Maroc">Société Générale Maroc</option>
                <option value="Banque Centrale Populaire">Banque Centrale Populaire</option>
                <option value="Bank Al-Maghrib">Bank Al-Maghrib</option>
                <option value="Autre">Autre</option>
            </select>
        </div>


        <div class="bank-info">
            <label for="beneficiary-name">Nom complet du bénéficiaire</label>
            <input type="text" id="beneficiary-name" name="nom_complete" placeholder="Nom complet du bénéficiaire" required>
        </div>

        <div class="bank-info">
            <label for="account-number">Numéro de compte du bénéficiaire</label>
            <input type="text" id="account-number" name="num_compte_destinataire" placeholder="Numéro de compte" required>
        </div>


        <label for="external-amount">Montant (MAD)</label>
        <input type="number" name="montant" id="external-amount" step="0.01" min="0.01" placeholder="ex : 500.00" required>

        <label for="external-description">Description (Facultatif)</label>
        <textarea id="external-description" name="description" rows="2" placeholder="Description du virement"></textarea>

        <button type="submit" class="btn btn-primary">Effectuer le virement externe</button>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const transferTypeBtns = document.querySelectorAll('.transfer-type-btn');
    const transferSections = document.querySelectorAll('.transfer-section');

    transferTypeBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            const type = this.dataset.type;
            
            // Update active button
            transferTypeBtns.forEach(b => b.classList.remove('active'));
            this.classList.add('active');
            
            // Show corresponding form
            transferSections.forEach(section => section.classList.remove('active'));
            document.getElementById(`${type}-transfer-form`).classList.add('active');
        });
    });

    // Prevent selecting same account for source and target in internal transfer
    const sourceAccount = document.getElementById('source-account');
    const targetAccount = document.getElementById('target-account');

    if(sourceAccount && targetAccount) {
        sourceAccount.addEventListener('change', function() {
            Array.from(targetAccount.options).forEach(option => {
                option.disabled = option.value === this.value && option.value !== '';
            });
        });

        targetAccount.addEventListener('change', function() {
            Array.from(sourceAccount.options).forEach(option => {
                option.disabled = option.value === this.value && option.value !== '';
            });
        });
    }
});
</script>
@endsection