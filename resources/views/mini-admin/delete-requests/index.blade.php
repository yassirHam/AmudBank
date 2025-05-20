@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    {{-- Header --}}
    <div class="d-flex align-items-center justify-content-between mb-4">
     <div class="d-flex align-items-center">
        <a href="{{ route('mini-admin.dashboard') }}" class="d-flex align-items-center text-decoration-none me-3">
        <img src="{{ asset('images/LOGO - Copy.png') }}"
             alt="AmudBank Logo"
             width="40"
             height="40"
             class="rounded-circle shadow-sm">
       </a>
        <h2 class="h5 fw-bold mb-0">Demandes de Suppression de Compte</h2>
      </div>
        <span class="badge bg-success-subtle text-success">MiniAdmin</span>
    </div>
    {{-- Success Alert --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- Table Card --}}
    <div class="card border-0 shadow rounded-4">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Nom</th>
                            <th>Email</th>
                            <th>Motif</th>
                            <th>Statut</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($requests as $request)
                            <tr class="{{ $request->reponse === 'approuve' ? 'table-success-subtle' : ($request->reponse === 'rejete' ? 'table-danger-subtle' : '') }}">
                                <td>{{ $request->user->Nom }} {{ $request->user->Prenom }}</td>
                                <td>{{ $request->user->email }}</td>
                                <td>{{ $request->motif }}</td>
                                <td>
                                    <span class="badge bg-{{ $request->reponse === 'approuve' ? 'success' : ($request->reponse === 'rejete' ? 'danger' : 'secondary') }}">
                                        {{ ucfirst($request->reponse) }}
                                    </span>
                                </td>
                                <td class="text-end d-flex justify-content-end gap-2">
                                    @if ($request->reponse === 'en_attente' && $miniAdmin->hasPermission('manage_delete_requests'))
                                        {{-- Approve --}}
                                        <form action="{{ route('mini-admin.delete-request.approve', $request) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-outline-success d-flex align-items-center">
                                                <i class="bi bi-check-circle-fill me-1"></i> Approuver
                                            </button>
                                        </form>

                                        {{-- Reject --}}
                                        <form action="{{ route('mini-admin.delete-request.reject', $request) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-outline-danger d-flex align-items-center">
                                                <i class="bi bi-x-circle-fill me-1"></i> Rejeter
                                            </button>
                                        </form>
                                    @else
                                        <span class="text-muted fst-italic small">Aucune action disponible</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-5 text-muted">
                                    <i class="bi bi-person-x display-5 opacity-25 mb-2 d-block"></i>
                                    Aucune demande de suppression disponible
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
