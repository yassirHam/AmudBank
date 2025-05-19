@extends('client')

@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

<style>
body {
    background: #f5f7fa;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

.account-container {
    max-width: 1000px;
    margin: 10px auto;
    padding: 30px;
    background: #ffffff;
    border-radius: 16px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.05);
}

.account-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 30px;
}

.account-header h2 {
    font-size: 1.8rem;
    font-weight: 700;
    color: #2c3e50;
}

.back-button {
    color: #3498db;
    font-weight: 600;
    text-decoration: none;
    font-size: 1rem;
}

.details-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 30px;
}

.account-summary {
    display: grid;
    grid-template-columns: 1fr;
    gap: 20px;
    margin-bottom: 30px;
}

/* FLIP CARD STYLES */
.card-flip-container {
    perspective: 1000px;
    width: 100%;
    height: 100%;
}

.card-flip-inner {
    position: relative;
    width: 100%;
    max-width: 380px;
    height: 240px;
    transform-style: preserve-3d;
    transition: transform 0.6s;
}

.card-flip-container:hover .card-flip-inner,
.card-flip-container:focus-within .card-flip-inner {
    transform: rotateY(180deg);
}

.card-front, .card-back {
    position: absolute;
    width: 100%;
    height: 100%;
    max-width: 380px;
    backface-visibility: hidden;
    border-radius: 16px;
    overflow: hidden;
}

/* Front */
.card-front {
    background: linear-gradient(145deg, #1a3a6e 0%, #2a5a9a 50%, #3a7ac6 100%);
    background-image: url("{{ asset('bleu.jpg') }}");
    background-size: cover;
    background-repeat: no-repeat;
    background-position: center;
    color: white;
    padding: 25px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
}

/* Back */
.card-back {
    background: #2c3e50;
    color: white;
    transform: rotateY(180deg);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    letter-spacing: 2px;
    font-family: 'Courier New', monospace;
}

/* Type-specific backgrounds */
.credit-card.epargne .card-front {
    background: linear-gradient(to right, #2ecc71, #27ae60);
    background-image: url("{{ asset('23.jpg') }}");
}

.credit-card.professionnel .card-front {
    background: linear-gradient(to right, #000000, #0d0d0d, #1a1a1a);
    background-image: url("{{ asset('black.jpg') }}");
}

.bank-name {
    font-size: 22px;
    font-weight: 700;
    margin-bottom: 30px;
    text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
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
    position: absolute;
    bottom: 25px;
    z-index: 2;
}

.card-bottom {
    position: absolute;
    bottom: 25px;
    right: 25px;
    line-height: 15px;
}

.contactless {
    position: absolute;
    top: 30px;
    right: 25px;
}

.expiry-label {
    font-size: 8px;
    opacity: 0.8;
    display: block;
}

.expiry {
    font-size: 14px;
}

.bank-logo img {
    position: absolute;
    top: 40px;
    height: 50px;
    width: auto;
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

.info-box {
    background: #f9f9f9;
    border-radius: 10px;
    padding: 20px;
}

.info-box h4 {
    margin-bottom: 15px;
    font-size: 1.1rem;
    color: #34495e;
}

.info-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 15px;
}

.info-line {
    margin-bottom: 12px;
}

.info-label {
    color: #7f8c8d;
    font-size: 0.9rem;
    display: block;
    margin-bottom: 3px;
}

.info-value {
    font-weight: 600;
    color: #2c3e50;
    display: block;
}

.transactions {
    margin-top: 50px;
}

.transactions h3 {
    margin-bottom: 20px;
    color: #2c3e50;
}

.transaction-item {
    background: #ffffff;
    border-left: 4px solid #3498db;
    margin-bottom: 15px;
    padding: 15px 20px;
    border-radius: 10px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.03);
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.transaction-title {
    font-weight: 600;
    color: #34495e;
}

.transaction-date {
    font-size: 0.85rem;
    color: #95a5a6;
}

.transaction-amount {
    font-weight: 600;
    font-size: 1rem;
}

.transaction-amount.credit {
    color: #27ae60;
}

.transaction-amount.debit {
    color: #e74c3c;
}
</style>
@endsection

@section('content')
<div class="account-container">
    <div class="account-header">
        <a href="{{ route('accounts') }}" class="back-button"><i class="fas fa-arrow-left"></i> Retour</a>
        <h2><i class="fas fa-wallet"></i> Compte Bancaire</h2>
    </div>

    <div class="details-grid">
        <!-- Carte avec flip -->
        <div class="account-summary">
            <div class="card-flip-container">
                <div class="card-flip-inner credit-card {{ $compte->type_compte }}">
                    <!-- Face avant -->
                    <div class="card-front">
                        <div class="gloss"></div>
                        <div class="bank-name">AmudBank</div>
                        <div class="bank-logo">
                            <img src="{{ asset('logo.png') }}" alt="Logo Banque">
                        </div>
                        <div class="contactless">Compte {{$compte->type_compte}}</div>
                        <div class="card-number">{{ $compte->numero_carte }}</div>
                        <div class="card-holder">{{ strtoupper(auth()->user()->Prenom) }} {{ strtoupper(auth()->user()->Nom) }}</div>
                        <div class="card-bottom">
                            <span class="expiry-label">VALID THRU</span>
                            <span class="expiry">{{ $compte->date_expiration }}</span>
                        </div>
                    </div>

                    <!-- Face arrière -->
                    <div class="card-back">
                        **** **** **** {{ substr($compte->numero_carte, -4) }}
                    </div>
                </div>
            </div>
        </div>

        <!-- Infos -->
        <div class="info-box">
            <h4><i class="fas fa-user-circle"></i> Détails du compte</h4>
            <div class="info-grid">
                <div class="info-line"><span class="info-label">Type de compte</span><span class="info-value">{{ $compte->type_compte }}</span></div>
                <div class="info-line"><span class="info-label">Numéro compte</span><span class="info-value">{{ $compte->numero_compte }}</span></div>
                <div class="info-line"><span class="info-label">Solde actuel</span><span class="info-value">{{ $compte->solde }} MAD</span></div>
                <div class="info-line"><span class="info-label">Statut</span><span class="info-value">{{ $compte->statut }}</span></div>
                <div class="info-line"><span class="info-label">Code RIP</span><span class="info-value">{{ $compte->rip }}</span></div>
                <div class="info-line"><span class="info-label">Date d'expiration</span><span class="info-value">{{ $compte->date_expiration }}</span></div>
            </div>
        </div>
    </div>

    <!-- Transactions -->
    <div class="transactions">
        <h3><i class="fas fa-clock"></i> Transactions récentes</h3>
        @if($compte->transactions->isEmpty())
        <div class="alert alert-info" style="text-align: center;">
            Aucune transaction pour le moment.
        </div>
        @endif
        @foreach ($compte->transactions as $transaction) 
        <div class="transaction-item">
            <div class="left">
                <div class="transaction-title">{{ $transaction->description }}</div>
                <div class="transaction-date">{{ $transaction->created_at }}</div>
            </div>
            <div class="transaction-amount {{ $transaction->amount < 0 ? 'debit' : 'credit' }}">
                {{ $transaction->montant }} MAD
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
