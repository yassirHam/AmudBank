@extends('layouts.app')

@section('title', 'Customer Accounts - SuperAdmin')

@section('content')
<div class="container-fluid py-4">

  {{-- Page Header --}}
  <div class="d-flex align-items-center justify-content-between mb-4">
    <div class="d-flex align-items-center">
      <a href="{{ route('super-admin.dashboard') }}" class="d-flex align-items-center text-decoration-none me-3">
        <img src="{{ asset('images/LOGO - Copy.png') }}"
             alt="AmudBank Logo"
             width="40"
             height="40"
             class="rounded-circle shadow-sm">
      </a>
      <div>
        <h2 class="h5 mb-0 fw-bold">Customer Accounts</h2>
        <small class="text-muted">Manage all registered customers</small>
      </div>
    </div>
    <span class="badge bg-primary-subtle text-primary fs-6">SuperAdmin</span>
  </div>

  {{-- Success Alert --}}
  @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
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
            </tr>
          </thead>
          <tbody>
            @foreach($users as $user)
              <tr class="{{ $user->status==='frozen' ? 'table-danger' : '' }}">
                <td>{{ $user->Nom }} {{ $user->Prenom }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->Cin }}</td>
                <td>
                  <span class="badge bg-{{ $user->status==='active' ? 'success' : 'danger' }}">
                    {{ ucfirst($user->status) }}
                  </span>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
@endsection
