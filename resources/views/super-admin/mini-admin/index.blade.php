@extends('layouts.app')

@section('title', 'MiniAdmin Management - SuperAdmin')

@section('content')
<div class="container-fluid py-4">

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
        <h2 class="h5 mb-0 fw-bold">MiniAdmin Management</h2>
        <small class="text-muted">Create, edit or remove staff accounts</small>
      </div>
    </div>  
  </div>
  @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
      {{ session('success') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
  @endif
  <div class="card border-0 shadow-sm">
    <div class="card-body p-0">
      <div class="table-responsive">
        <table class="table table-striped align-middle mb-0">
          <thead class="table-light text-uppercase small">
            <tr>
              <th>Email</th>
              <th>Permissions</th>
              <th class="text-end">Actions</th>
            </tr>
          </thead>
          <tbody>
            @foreach($miniAdmins as $admin)
              <tr>
                <td>{{ $admin->email }}</td>
                <td>
                  @foreach($admin->permissions ?? [] as $perm)
                    <span class="badge bg-secondary">{{ $perm }}</span>
                  @endforeach
                </td>
                <td class="text-end">
                   <a href="{{ route('super-admin.mini-admin.edit', $admin) }}"
                      class="btn btn-sm btn-outline-success me-1">
                       <i class="bi bi-unlock-fill me-1"></i> EDIT
                   </a>

                   <form action="{{ route('super-admin.mini-admin.destroy', $admin) }}"
                         method="POST"
                         class="d-inline"
                         onsubmit="return confirm('Delete this MiniAdmin?');">
                       @csrf
                       @method('DELETE')
                       <button type="submit" class="btn btn-sm btn-outline-danger">
                           <i class="bi bi-lock-fill me-1"></i> DELETE
                       </button>
                   </form>
               </td>

                  </form>
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
