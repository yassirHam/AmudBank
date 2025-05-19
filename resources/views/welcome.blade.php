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

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

body {
    background-color: #f5f7fa;
    color: var(--dark-color);
    line-height: 1.6;
}

.container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 20px;
}

.profile-container {
    display: grid;
    grid-template-columns: 300px 1fr;
    gap: 30px;
    margin-top: 30px;
}

.profile-content {
    background-color: white;
    border-radius: 10px;
    box-shadow: 0 2px 15px rgba(0, 0, 0, 0.05);
    padding: 30px;
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
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 20px;
    margin-bottom: 30px;
}

.account-card {
    background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
    color: white;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    position: relative;
    overflow: hidden;
}

.account-card::before {
    content: '';
    position: absolute;
    top: -50px;
    right: -50px;
    width: 150px;
    height: 150px;
    background-color: rgba(255, 255, 255, 0.1);
    border-radius: 50%;
}

.account-type {
    font-size: 16px;
    margin-bottom: 15px;
    opacity: 0.9;
}
.bank-name{
    font-size: 30px;
    margin-bottom: 15px;
    right:10px;
    top:0px;
    position:absolute;
    opacity: 0.9; 
}

.account-balance {
    font-size: 24px;
    font-weight: bold;
    margin-bottom: 5px;
}

.account-number {
    font-size: 14px;
    opacity: 0.8;
    margin-bottom: 15px;
}

.account-actions {
    display: flex;
    justify-content: space-between;
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

.btn-sm {
    padding: 5px 10px;
    font-size: 12px;
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

.recent-transactions {
    margin-bottom: 30px;
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
    background-color: var(--light-color);
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

.tab-content.active {
    display: block;
}




@import url('https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@400;600;700&display=swap');
               
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
            transform-style: preserve-3d;
        }
        .epargne{
            background: linear-gradient(to right, #2ecc71, #27ae60);
            background-image: url("{{ asset('23.jpg') }}");


        }
        .professionnel{
            background: linear-gradient(to right, #000000, #0d0d0d, #1a1a1a);
            background-image: url("{{ asset('black.jpg') }}");
            /* background: linear-gradient(to right, #f5e6c8, #e8d8b5, #d4c4a3);   */             
            } 
        
        .credit-card:hover {
            transform: translateY(-5px) rotateX(5deg);
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
            top:55%;
            right:13%;
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
            bottom:25px;
            position: absolute;
            
            z-index: 2;
        }
        
        .card-bottom {
            position:absolute;
            justify-content: space-between;
            align-items: flex-end;
            position:absolute;
            bottom:25px;
            right:25px;
            line-height:15px;
            margin-top: 15px;
        }
        
        
        /* .chip {
            width: 40px;
            height: 30px;
            background: linear-gradient(135deg, #ffd700 0%, #d4af37 100%);
            border-radius: 5px;
            position: absolute;
            top: 50px;
            left: 25px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.2);
        } */
        
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
        .bank-logo img{
            position:absolute;
            top:40px;
            height: 50px;
            width:auto;       
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
</style>
@endsection
@section('content')               

                <div id="overview" class="tab-content active">
                    <h2 class="section-title"><i class="fas fa-chart-pie"></i> Account Overview</h2>

                    <div class="account-summary">

                    @foreach($comptes as $compte)
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
                                        <div class="card-holder">{{ strtoupper(auth()->user()->Prenom) }} {{ strtoupper(auth()->user()->Nom) }}
                                        </div>
                                        <!-- <div class="mastercard-logo">Mastercard</div> -->
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