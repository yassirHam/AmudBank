@extends('layouts.app')

@section('title', 'Demandes de Crédit – MiniAdmin')

@section('content')
<div class="container-fluid py-4">

  {{-- Page Header --}}
  <div class="d-flex align-items-center justify-content-between mb-4">
    <div class="d-flex align-items-center">
      <a href="{{ route('mini-admin.dashboard') }}" class="d-flex align-items-center text-decoration-none me-3">
        <img src="{{ asset('images/LOGO - Copy.png') }}"
             alt="AmudBank Logo"
             width="40"
             height="40"
             class="rounded-circle shadow-sm">
      </a>
      <div>
        <h2 class="h5 mb-0 fw-bold">Demandes de Crédit</h2>
        <small class="text-muted">Surveillez et traitez les demandes</small>
      </div>
    </div>
    <span class="badge bg-success-subtle text-success fs-6">MiniAdmin</span>
  </div>

  {{-- Success Alert --}}
  @if(session('success'))
    <div class="alert alert-success d-flex align-items-center gap-2 mb-4" role="alert">
      <i class="bi bi-check-circle-fill"></i>
      {{ session('success') }}
      <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
    </div>
  @endif

  {{-- Credit Requests Table --}}
  <div class="card border-0 shadow-sm">
    <div class="card-body p-0">
      <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
          <thead class="table-light text-uppercase small">
            <tr>
              <th>Client</th>
              <th>Type</th>
              <th>Montant</th>
              <th>Durée</th>
              <th>Status</th>
              <th class="text-end">Actions</th>
            </tr>
          </thead>
          <tbody>
            @forelse($credits as $credit)
              <tr class="{{ $credit->statut==='rejete' ? 'table-danger' : ($credit->statut==='approuve' ? 'table-success-subtle' : '') }}">
                <td>{{ $credit->user->Nom }} {{ $credit->user->Prenom }}</td>
                <td>{{ ucfirst($credit->type) }}</td>
                <td>{{ number_format($credit->montant, 2, ',', '.') }} MAD</td>
                <td>{{ $credit->duree }} mois</td>
                <td>
                  <span class="badge 
                    bg-{{ $credit->statut==='approuve' ? 'success' : ($credit->statut==='rejete' ? 'danger' : 'secondary') }}">
                    {{ ucfirst($credit->statut) }}
                  </span>
                </td>
                <td class="text-end d-flex justify-content-end gap-2">
                  @if($miniAdmin->hasPermission('manage_credits') && $credit->statut==='en_attente')
                    {{-- Approve --}}
                    <form action="{{ route('mini-admin.credit.update.status', $credit) }}"
                          method="POST" class="d-inline">
                      @csrf
                      <input type="hidden" name="statut" value="approuve">
                      <button type="submit" class="btn btn-sm btn-outline-success d-flex align-items-center">
                        <i class="bi bi-check-circle-fill me-1"></i> Approuver
                      </button>
                    </form>
                    {{-- Reject --}}
                    <form action="{{ route('mini-admin.credit.update.status', $credit) }}"
                          method="POST" class="d-inline">
                      @csrf
                      <input type="hidden" name="statut" value="rejete">
                      <button type="submit" class="btn btn-sm btn-outline-danger d-flex align-items-center">
                        <i class="bi bi-x-circle-fill me-1"></i> Rejeter
                      </button>
                    </form>
                  @elseif($credit->statut!=='en_attente')
                    <span class="text-muted fst-italic small">Traité</span>
                  @else
                    <span class="text-muted fst-italic small">Pas d'action</span>
                  @endif
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="6" class="text-center text-muted py-5">
                  <i class="bi bi-credit-card display-5 opacity-25 mb-2 d-block"></i>
                  Aucune demande de crédit disponible
                </td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
@endsection
