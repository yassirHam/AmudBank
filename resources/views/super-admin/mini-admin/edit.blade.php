@extends('layouts.app')

@section('title', 'Edit MiniAdmin - SuperAdmin')

@section('content')
<div class="container-fluid py-4">

  {{-- Page Header --}}
  <div class="d-flex align-items-center justify-content-between mb-4">
    <div class="d-flex align-items-center">
      <a href="{{ route('super-admin.mini-admin.index') }}" class="btn btn-sm btn-outline-secondary me-3">
        <i class="bi bi-arrow-left"></i> Back
      </a>
      <div>
        <h2 class="h5 mb-0 fw-bold">Edit MiniAdmin</h2>
        <small class="text-muted">{{ $miniAdmin->email }}</small>
      </div>
    </div>
  </div>

  {{-- Edit Form --}}
  <div class="card border-0 shadow-sm">
    <div class="card-body">
      <form method="POST" action="{{ route('super-admin.mini-admin.update', $miniAdmin) }}">
        @csrf @method('PUT')

        <div class="row gy-3">
          <div class="col-md-6">
            <label class="form-label fw-medium">New Password</label>
            <input type="password"
                   name="password"
                   class="form-control @error('password') is-invalid @enderror"
                   placeholder="••••••••">
            @error('password')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>
          <div class="col-md-6">
            <label class="form-label fw-medium">Confirm Password</label>
            <input type="password"
                   name="password_confirmation"
                   class="form-control"
                   placeholder="••••••••">
          </div>

          <div class="col-12">
            <label class="form-label fw-medium">Permissions</label>
            <div class="row">
              @foreach(config('permissions.mini_admin') as $key => $label)
                <div class="col-sm-6 col-md-4">
                  <div class="form-check">
                    <input class="form-check-input"
                           type="checkbox"
                           name="permissions[]"
                           value="{{ $key }}"
                           id="perm-{{ $key }}"
                           {{ in_array($key, $miniAdmin->permissions ?? []) ? 'checked' : '' }}>
                    <label class="form-check-label" for="perm-{{ $key }}">
                      {{ $label }}
                    </label>
                  </div>
                </div>
              @endforeach
            </div>
          </div>
        </div>

        <div class="mt-4 text-end">
          <button type="submit" class="btn btn-primary">
            <i class="bi bi-save me-1"></i> Save Changes
          </button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
