@extends('client')
@section('styles')
<style>
    .credit-section {
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px;
    }

    .credit-application {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 30px;
        margin-bottom: 30px;
    }

    .credit-info-box {
        background-color: #f8f9fa;
        border-radius: 8px;
        padding: 25px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    }

    .credit-info-box h3 {
        color: var(--primary-color);
        margin-bottom: 15px;
        display: flex;
        align-items: center;
    }

    .credit-info-box h3 i {
        margin-right: 10px;
        color: var(--secondary-color);
    }

    .credit-info-box p {
        color: #666;
        margin-bottom: 20px;
        line-height: 1.6;
    }

    .loan-features {
        display: flex;
        flex-direction: column;
        gap: 15px;
    }

    .feature {
        display: flex;
        align-items: center;
        gap: 10px;
        color: var(--dark-color);
    }

    .feature i {
        color: var(--success-color);
        font-size: 18px;
    }

    .loan-form {
        background-color: white;
        border-radius: 8px;
        padding: 25px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        display: block;
        margin-bottom: 8px;
        font-weight: 500;
        color: var(--dark-color);
    }

    .form-control {
        width: 100%;
        padding: 10px 15px;
        border: 1px solid #ddd;
        border-radius: 5px;
        font-size: 16px;
        transition: border 0.3s;
    }

    .form-control:focus {
        border-color: var(--secondary-color);
        outline: none;
    }

    .amount-input-container {
        position: relative;
        margin-bottom: 15px;
    }



    input[type="range"] {
        flex-grow: 1;
        margin: 0;
        -webkit-appearance: none;
        height: 8px;
        background: #ddd;
        border-radius: 5px;
    }

    input[type="range"]::-webkit-slider-thumb {
        -webkit-appearance: none;
        width: 20px;
        height: 20px;
        background: var(--secondary-color);
        border-radius: 50%;
        cursor: pointer;
    }

    .checkbox-group {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .checkbox-group input {
        width: auto;
    }

    .submit-loan {
        width: 100%;
        padding: 12px;
        font-size: 16px;
        margin-top: 10px;
    }

    .submit-loan i {
        margin-right: 8px;
    }

    .loan-simulation {
        background-color: var(--light-color);
        border-radius: 8px;
        padding: 25px;
        margin-top: 30px;
    }

    .loan-simulation h3 {
        color: var(--primary-color);
        margin-bottom: 20px;
        display: flex;
        align-items: center;
    }

    .loan-simulation h3 i {
        margin-right: 10px;
        color: var(--secondary-color);
    }

    .simulation-results {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 20px;
    }

    .result-item {
        background-color: white;
        padding: 15px;
        border-radius: 5px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.05);
        text-align: center;
    }

    .result-item span:first-child {
        display: block;
        color: #666;
        margin-bottom: 5px;
        font-size: 14px;
    }

    .result-item span:last-child {
        font-weight: bold;
        color: var(--dark-color);
        font-size: 18px;
    }
    .form-group .termes {
    text-decoration: none;
}
    .form-group .termes:hover {
        text-decoration: underline;
    }
    .form-group .termes:hover {
        text-decoration: underline;
    }
.alert {
    padding: 15px 20px;
    border-radius: 5px;
    margin: 15px 0;
    font-family: Arial, sans-serif;
    font-size: 15px;
}

.alert-success {
    background-color: #e6ffed;
    color: #256029;
    border: 1px solid #a3d9a5;
}

.alert-danger {
    background-color: #ffe6e6;
    color: #a12622;
    border: 1px solid #f5a5a5;
}

.alert ul {
    margin: 10px 0 0 20px;
    padding: 0;
}

</style>
@section('content')
<div class="credit-section">
    <h2 class="section-title">
        <i class="fas fa-hand-holding-dollar"></i> Demande de Prêt Bancaire
    </h2>
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if($errors->any())
    <div class="alert alert-danger">
        <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
        </ul>
    </div>
    @endif

    <div class="credit-application">
        <div class="credit-info-box">
            <h3><i class="fas fa-info-circle"></i> Informations sur le Prêt</h3>
            <p>Bénéficiez du soutien financier dont vous avez besoin grâce à nos offres de prêt compétitives. Choisissez le montant et la durée adaptés à vos besoins.</p>
            
            <div class="loan-features">
                <div class="feature">
                    <i class="fas fa-percentage"></i>
                    <span>Taux d’intérêt à partir de 3%</span>
                </div>
                <div class="feature">
                    <i class="fas fa-calendar-alt"></i>
                    <span>Durée : de 12 à 60 mois</span>
                </div>
                <div class="feature">
                    <i class="fas fa-money-bill-wave"></i>
                    <span>Montant : de 2 500 DH à 120 000 DH</span>
                </div>
            </div>
        </div>

        <form class="loan-form" action="{{ route('submitCreditRequest') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="loan-amount">Montant du prêt (DH)</label>
                <div class="amount-input-container">
                    <input type="number" id="loan-amount" name="montant" min="2500" max="120000" step="100" value="10000" class="form-control" required>
                </div>

            </div>
            <div class="form-group">
                <label for="contrat">Type de contrat</label>
                <select id="contrat" name="type" class="form-control">
                <option value="">-- Sélectionnez --</option>
                <option value="cdi">CDI</option>
                <option value="cdd">CDD</option>
                <option value="fonctionnaire">Fonctionnaire</option>
                <option value="auto-entrepreneur">Auto-entrepreneur</option>
                <option value="autre">Autre</option>
            </select>
            </div>

            <div class="form-group">
                <label for="loan-duration">Durée (mois)</label>
                <select id="loan-duration" name="duration" class="form-control">
                    <option value="12">12 mois</option>
                    <option value="24">24 mois</option>
                    <option value="36">36 mois</option>
                    <option value="48">48 mois</option>
                    <option value="60">60 mois</option>
                    <option value="72">72 mois</option>
                    <option value="84">84 mois</option>
                    <option value="96">96 mois</option>
                </select>
            </div>

            <div class="form-group">
                <label for="loan-purpose">Motif du prêt</label>
                <select id="loan-purpose" name="motif_credit" class="form-control">
                    <option value="personal">Projet personnel</option>
                    <option value="voiture ou maison">Achat de voiture ou maison</option>
                    <option value="consommation">consommation</option>
                    <option value="debt">Regroupement de dettes</option>
                    <option value="vacances">Vacances</option>
                    <option value="scolarité">Scolarité</option>
                    <option value="Autre">Autre</option>
                </select>
            </div>
            <div class="form-group">
                <label for="compte">Choisissez le compte sur lequel transférer le montant :</label>
                <select id="compte" name="compte_bancaire" class="form-control">
                    <option value="">-- Sélectionnez un compte --</option>
                    @foreach(auth()->user()->comptes as $compte)
                    <option value="{{$compte->type_compte}}">Compte {{$compte->type_compte}}</option>
                    @endforeach
                </select>
            </div>


            <div class="form-group">
                <label for="monthly-income">Revenu mensuel (DH)</label>
                <input type="number" placeholder="ex : 5000 dh" id="monthly-income" name="revenu_mensuel" min="1000" required class="form-control">
            </div>

            <div class="form-group">
                <label for="monthly-income">Attestation de travail ou contrat.</label>
                <input type="file" id="monthly-income" name="Attestation_travail_contrat" min="1000" required class="form-control">
            </div>

            <div class="form-group">
                <label for="monthly-income">Bulletins de salaire</label>
                <input type="file" id="monthly-income" name="Bulletins_salaire" min="1000" required class="form-control">
            </div>
            <input type="hidden" id="monthly-payment-visible" name="paiement_mensuel" readonly>            
            <div class="form-group checkbox-group">
                <input type="checkbox" id="terms-agreement" name="terms" required>
                <label for="terms-agreement">J'accepte <a href="#"  class="termes">les termes et conditions</a></label>
            </div>

            <button type="submit" class="btn btn-primary submit-loan">
                <i class="fas fa-paper-plane"></i> Envoyer la demande
            </button>
        </form>
    </div>

    <div class="loan-simulation">
        <h3><i class="fas fa-calculator"></i> Simulation de Prêt</h3>
        <div class="simulation-results">
            <div class="result-item">
                <span>Mensualité :</span>
                <span id="monthly-payment">320.50 DH</span>
            </div>
            <div class="result-item">
                <span>Intérêts totaux :</span>
                <span id="total-interest">1 846.00 DH</span>
            </div>
            <div class="result-item">
                <span>Remboursement total :</span>
                <span id="total-repayment">11 846.00 DH</span>
            </div>
        </div>
    </div>
</div>
@endsection


<script>
    document.addEventListener('DOMContentLoaded', function () {
        const amountInput = document.getElementById('loan-amount');
        const durationSelect = document.getElementById('loan-duration');
        const monthlyPaymentSpan = document.getElementById('monthly-payment');
        const totalInterestSpan = document.getElementById('total-interest');
        const totalRepaymentSpan = document.getElementById('total-repayment');
        const monthlyVisibleInput = document.getElementById('monthly-payment-visible');

        function calculateSimulation() {
            const montant = parseFloat(amountInput.value);
            const duree = parseInt(durationSelect.value);

            if (!montant || !duree) return;

            const tauxAnnuel = 0.03;
            const tauxMensuel = tauxAnnuel / 12;

            // Formule de mensualité pour prêt amortissable :
            const mensualite = (montant * tauxMensuel) / (1 - Math.pow(1 + tauxMensuel, -duree));
            const total = mensualite * duree;
            const interets = total - montant;

            monthlyPaymentSpan.textContent = mensualite.toFixed(2) + " DH";
            totalRepaymentSpan.textContent = total.toFixed(2) + " DH";
            totalInterestSpan.textContent = interets.toFixed(2) + " DH";
            monthlyVisibleInput.value = mensualite.toFixed(2);
        }

        amountInput.addEventListener('input', calculateSimulation);
        durationSelect.addEventListener('change', calculateSimulation);

        calculateSimulation(); // Appel initial
    });
</script>

@endsection