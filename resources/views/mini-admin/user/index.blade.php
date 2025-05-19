@extends('layouts.app')

@section('title', 'Customer Accounts – MiniAdmin')

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
        <h2 class="h5 mb-0 fw-bold">Customer Accounts</h2>
        <small class="text-muted">View and manage customer profiles</small>
      </div>
    </div>
    <span class="badge bg-success-subtle text-success fs-6">MiniAdmin</span>
  </div>

  {{-- Success Alert --}}
  @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
      <i class="bi bi-check-circle-fill me-1"></i>
      {{ session('success') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
  @endif

  {{-- Accounts Table --}}
  <div class="card border-0 shadow-sm">
    <div class="card-body p-0">
      <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
          <thead class="table-light text-uppercase small">
            <tr>
              <th>Name</th>
              <th>Email</th>
              <th>CIN</th>
              <th>Status</th>
              <th class="text-end">Actions</th>
            </tr>
          </thead>
          <tbody>
            @forelse($users as $user)
              <tr class="{{ $user->status === 'frozen' ? 'table-danger' : '' }}">
                <td>{{ $user->Nom }} {{ $user->Prenom }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->Cin }}</td>
                <td>
                  <span class="badge bg-{{ $user->status === 'active' ? 'success' : 'danger' }}">
                    {{ ucfirst($user->status) }}
                  </span>
                </td>
                <td class="text-end d-flex justify-content-end gap-2">
                  @if($user->status === 'active' && $miniAdmin->hasPermission('freeze_accounts'))
                    <form action="{{ route('mini-admin.user.freeze', $user) }}" method="POST" class="d-inline">
                      @csrf
                      <button type="submit" class="btn btn-sm btn-outline-danger d-flex align-items-center">
                        <i class="bi bi-lock-fill me-1"></i> Freeze
                      </button>
                    </form>
                  @endif

                  @if($user->status === 'frozen' && $miniAdmin->hasPermission('unfreeze_accounts'))
                    <form action="{{ route('mini-admin.user.unfreeze', $user) }}" method="POST" class="d-inline">
                      @csrf
                      <button type="submit" class="btn btn-sm btn-outline-success d-flex align-items-center">
                        <i class="bi bi-unlock-fill me-1"></i> Unfreeze
                      </button>
                    </form>
                  @endif

                  @if($miniAdmin->hasPermission('delete_users'))
                    <form action="{{ route('mini-admin.user.delete', $user) }}" method="POST" class="d-inline"
                          onsubmit="return confirm('Are you sure you want to delete this user?');">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-sm btn-outline-danger d-flex align-items-center">
                        <i class="bi bi-trash3 me-1"></i> Delete
                      </button>
                    </form>
                  @endif
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="5" class="text-center text-muted py-5">
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
