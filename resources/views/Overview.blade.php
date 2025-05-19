@extends('client')

@section('styles')
<style>
:root {
    --success-color: #2ecc71;
    --accent-color: #e74c3c;
}

.recent-transactions {
    margin-bottom: 30px;
    padding-top:40px;
}

.transaction-table {
    width: 100%;
    border-collapse: collapse;
}

.transaction-table th, .transaction-table td {
    padding: 12px 15px;
    text-align: left;
    border-bottom: 1px solid #eee;
}

.transaction-table th {
    background-color: #ecf0f1;
    font-weight: 600;
}

.transaction-table tr:hover {
    background-color: #f9f9f9;
}

.transaction-amount.credit {
    color: var(--success-color);
}

.transaction-amount.debit {
    color: var(--accent-color);
}

.transaction-status {
    display: inline-block;
    padding: 3px 8px;
    border-radius: 4px;
    font-size: 12px;
    font-weight: 500;
}

.status-completed {
    background-color: #d4edda;
    color: #155724;
}

.status-pending {
    background-color: #fff3cd;
    color: #856404;
}

/* Credit Card Styles */
.account-summary{
    position:relative;
}
.credit-card {
    width: 380px;
    height: 240px;
    background: linear-gradient(145deg, #1a3a6e, #3a7ac6);
    border-radius: 16px;
    color: white;
    padding: 25px;
    box-sizing: border-box;
    background-image: url("{{ asset('bleu.jpg') }}");;
    background-size: cover;
    background-repeat: no-repeat;
    background-position: center;
    box-shadow: 
        0 10px 30px rgba(0, 0, 0, 0.2),
        inset 0 0 0 1px rgba(255, 255, 255, 0.1);
    position: relative;
    overflow: hidden;
    transition: transform 0.3s ease;
    transform-style: preserve-3d;
}
.courant{
    z-index: 2;
}

.epargne {
    background: linear-gradient(to right, #2ecc71, #27ae60);
    background-image: url("{{ asset('23.jpg') }}");
    position:absolute;
    z-index: 0;
    top: 0;
    left:40%;

}

.professionnel {
    background: linear-gradient(to right, #000000, #1a1a1a);
    background-image: url("{{ asset('black.jpg') }}");
    position:absolute;
    z-index: 1;
    top: 0;
    left:20%;

    
}

.credit-card:hover {
    transform: translateY(-5px) rotateX(5deg);
}
.professionnel:hover {
    z-index: 3;
    transition: opacity 0.6s ease;
}
.epargne:hover {
 z-index: 3;
   
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
.welcome{
    margin-bottom: 40px;

}
    .welcome h1 {
      font-size: 1.75rem;
      margin-bottom: 0.5rem;
    }

    .highlight {
      color: #3498db;
    }
</style>
@endsection

@section('content')               
<div id="overview" class="tab-content active">
        <div class="welcome">
          <h1>BIENVENUE, <span class="highlight">{{ strtoupper(auth()->user()->Prenom)}}</span></h1>
        </div>
    <h2 class="section-title"><i class="fas fa-chart-pie"></i> Account Overview</h2>

    <div class="account-summary">
        @foreach($comptes as $compte)
        <div class="credit-card {{ $compte->type_compte }}">
            <div class="gloss"></div>
            <div class="bank-name">AmudBank</div>
            <div class="bank-logo">
                <img src="{{ asset('logo.png') }}" alt="Logo">
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
        @endforeach
    </div>

    <div class="recent-transactions">
        <h3 class="section-title"><i class="fas fa-history"></i> Recent Transactions</h3>
        <table class="transaction-table">
            <thead>
                <tr>
                    <th>Date et Heure</th>
                    <th>Description</th>
                    <th>Compte</th>
                    <th>Amount</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @if($transactions->isEmpty())
                <tr>
                    <td colspan="5" style="text-align: center;">Aucune transaction pour le moment.</td>
                </tr>
                @endif
                @foreach($transactions as $transaction)
                <tr>
                    <td>{{$transaction->created_at}}</td>
                    <td>{{$transaction->description}}</td>
                    <td>{{$transaction->compte_source}}</td>
                    <td class="transaction-amount debit">-{{$transaction->montant}}</td>
                    <td><span class="transaction-status status-completed">{{$transaction->status}}</span></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
