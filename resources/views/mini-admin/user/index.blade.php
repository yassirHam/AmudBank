@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fs-4 fw-bold text-dark">Customer Accounts</h3>
        <span class="badge bg-success-subtle text-success">MiniAdmin</span>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>CIN</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $user)
                        <tr class="{{ $user->status === 'frozen' ? 'table-danger' : '' }}">
                            <td>{{ $user->Nom }} {{ $user->Prenom }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->Cin }}</td>
                            <td>
                                <span class="badge bg-{{ $user->status === 'active' ? 'success' : 'danger' }}">
                                    {{ ucfirst($user->status) }}
                                </span>
                            </td>
                            <td class="text-nowrap">
                                @if (!empty($user))
                                    @if ($user->status === 'active')
                                        <form action="{{ route('mini-admin.user.freeze', $user) }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-outline-danger" title="Freeze Account">
                                                <i class="bi bi-lock"></i>
                                            </button>
                                        </form>
                                    @endif
                                @endif

                                @if (!empty($user))
                                    @if ($user->status === 'frozen')
                                        <form action="{{ route('mini-admin.user.unfreeze', $user) }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-outline-success" title="Unfreeze Account">
                                                <i class="bi bi-unlock"></i>
                                            </button>
                                        </form>
                                    @endif
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted py-4">
                                <i class="bi bi-person-x display-6 opacity-25 mb-2 d-block"></i>
                                No users found
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