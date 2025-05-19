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
    text-decoration: none;
}

.btn-primary:hover {
    background-color: #2980b9;
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
.profile-content{
    position:relative;
}
.btn-previous{
    position:absolute;
    left:30px;
    
}
.btn-next{
    position:absolute;
    right:30px;
}
.pagination{
    display: flex;
    margin-top: 20px;
    margin-bottom: 20px;
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
</style>
</style>
@endsection
@section('content')
<div id="transactions" class="tab-content">
    <h2 class="section-title"><i class="fas fa-exchange-alt"></i> Transaction History</h2>
    <form class="filters" action="{{route('transactionsHistory')}}" method="GET" style="margin-bottom: 20px; display: flex; gap: 15px;">
        <select class="btn" name="type_compte" style="padding: 8px 15px;">
            <option value="">All Accounts</option>
            <option value="courant">compte courant</option>
            <option value="epargne">compte epargne</option>
            <option value="professionnel">compte professionnel</option>
        </select>
        <select class="btn" name="time" style="padding: 8px 15px;">
            <option value="30">Last 30 Days</option>
            <option value="60">Last 60 Days</option>
            <option value="90">Last 90 Days</option>
            <option value="">This Year</option>
            <option value="">All Time</option>
        </select>

        <button class="btn btn-primary"><i class="fas fa-filter"></i> Apply</button>
    </form>

    <table class="transaction-table">
        <thead>
            <tr>
                <th>Date et Heure</th>
                <th>Description</th>
                <th>Compte</th>
                <th>Montant</th>
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

    <div class="pagination">
        @if($transactions->onFirstPage() === false)
            <a href="{{ $transactions->previousPageUrl() }}" class="btn btn-primary btn-previous" style="margin-right: 10px;">
                <i class="fas fa-chevron-left"></i> Previous
            </a>
        @endif

        @if($transactions->hasMorePages())
            <a href="{{ $transactions->nextPageUrl() }}" class="btn btn-primary btn-next">
                Next <i class="fas fa-chevron-right"></i>
            </a>
        @endif
    </div>

</div>
@endsection
