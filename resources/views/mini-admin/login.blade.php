<!-- resources/views/mini-admin/login.blade.php -->
@extends('layouts.app')

@section('title', 'AmudBank Staff Portal - MiniAdmin Login')

@section('content')
<div class="login-wrapper d-flex align-items-center justify-content-center min-vh-100 py-4">
  <div class="login-container">
    <!-- Logo & Title -->
    <div class="text-center mb-5">
      <img src="{{ asset('images/LOGO - Copy.png') }}"
           alt="AmudBank Logo"
           class="login-logo mb-3 rounded-circle shadow-sm"
           width="80"
           height="80">
      <h2 class="login-title text-success">AmudBank Staff Portal</h2>
      <p class="login-slogan">MiniAdmin Login</p>
    </div>

    <!-- Login Card -->
    <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
      <div class="card-header bg-gradient-success text-white text-center py-3">
        <h5 class="mb-0">Welcome, MiniAdmin</h5>
      </div>
      <div class="card-body p-4">
        <form method="POST" action="{{ route('mini-admin.login.submit') }}" class="needs-validation" novalidate>
          @csrf

          <div class="mb-4">
            <label for="email" class="form-label fw-medium">Email Address</label>
            <div class="input-group input-group-lg shadow-sm">
              <span class="input-group-text bg-white border-end-0">
                <i class="bi bi-envelope text-success"></i>
              </span>
              <input type="email"
                     id="email"
                     name="email"
                     class="form-control form-control-lg border-start-0 rounded-end @error('email') is-invalid @enderror"
                     placeholder="staff@example.com"
                     value="{{ old('email') }}"
                     required
                     autocomplete="username">
            </div>
            @error('email')
              <div class="invalid-feedback d-block mt-1">
                {{ $message }}
              </div>
            @enderror
          </div>

          <div class="mb-4 position-relative">
            <label for="password" class="form-label fw-medium">Password</label>
            <div class="input-group input-group-lg shadow-sm">
              <span class="input-group-text bg-white border-end-0">
                <i class="bi bi-lock text-success"></i>
              </span>
              <input type="password"
                     id="password"
                     name="password"
                     class="form-control form-control-lg border-start-0 rounded-end @error('password') is-invalid @enderror"
                     placeholder="••••••••"
                     required
                     autocomplete="current-password">
              <button type="button"
                      id="togglePassword"
                      class="btn btn-outline-secondary position-absolute top-50 end-0 translate-middle-y rounded-end"
                      style="z-index: 2; border-left: none;">
                <i id="togglePasswordIcon" class="bi bi-eye text-success"></i>
              </button>
            </div>
            @error('password')
              <div class="invalid-feedback d-block mt-1">
                {{ $message }}
              </div>
            @enderror
          </div>

          <button type="submit" class="btn btn-success w-100 py-3 fw-semibold rounded-3 shadow-sm">
            <i class="bi bi-box-arrow-in-right me-2"></i> Log In
          </button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

<style>
  .login-wrapper {
    background: linear-gradient(135deg, #e9f7ef, #d1ece3);
  }

  .login-container {
    max-width: 380px;
    width: 100%;
    margin: auto;
  }

  .login-logo {
    transition: transform 0.3s ease;
  }
  .login-logo:hover {
    transform: rotate(5deg) scale(1.02);
  }

  .login-title {
    font-size: 1.5rem;
    font-weight: 700;
    color: #28a745;
  }

  .login-slogan {
    color: #6c757d;
    font-size: 0.9rem;
  }

  .bg-gradient-success {
    background: linear-gradient(90deg, #28a745, #218838);
  }

  .form-control:focus {
    box-shadow: 0 0 0 0.2rem rgba(40, 167, 69, 0.25);
  }

  .input-group.shadow-sm {
    border-radius: .375rem;
    overflow: hidden;
  }
</style>
@endpush

@push('scripts')
<script>
  document.getElementById('togglePassword').addEventListener('click', function () {
    const pwd = document.getElementById('password');
    const icon = document.getElementById('togglePasswordIcon');
    if (pwd.type === 'password') {
      pwd.type = 'text';
      icon.classList.replace('bi-eye', 'bi-eye-slash');
    } else {
      pwd.type = 'password';
      icon.classList.replace('bi-eye-slash', 'bi-eye');
    }
  });
</script>
@endpush
