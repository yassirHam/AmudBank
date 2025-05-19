@extends('layouts.app')

@section('title', 'AmudBank Admin Portal - Login')

@section('content')
<div class="login-wrapper d-flex align-items-center justify-content-center min-vh-100 py-4">
  <div class="login-container">
    <!-- Logo & Slogan -->
    <div class="text-center mb-5">
      <img src="{{ asset('images/LOGO - Copy.png') }}"
           alt="AmudBank Logo"
           class="login-logo mb-3 rounded-circle shadow-sm"
           width="100"
           height="100">
      <h1 class="login-title">AmudBank Admin Portal</h1>
      <p class="login-slogan">The Pillar of Your Wealth</p>
    </div>

    <!-- Login Card -->
    <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
      <div class="card-header bg-gradient-primary text-white text-center py-4">
        <h4 class="mb-0">SuperAdmin Login</h4>
      </div>
      <div class="card-body p-4">

        <form method="POST"
              action="{{ route('super-admin.login', ['secret' => $secret]) }}"
              class="needs-validation"
              novalidate>
          @csrf
          <input type="text" name="fake_email" value="" style="display:none;" readonly>
          <input type="password" name="fake_password" value=" " style="display:none;" readonly>

          <div class="mb-4">
            <label for="email" class="form-label fw-medium">Email Address</label>
            <div class="input-group input-group-lg shadow-sm">
              <span class="input-group-text bg-white border-end-0">
                <i class="bi bi-envelope"></i>
              </span>
              <input type="email"
                     id="email"
                     name="email"
                     class="form-control form-control-lg border-start-0 rounded-end @error('email') is-invalid @enderror"
                     value="{{ old('email') }}"
                     placeholder="admin@example.com"
                     required
                     autocomplete="new-password">
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
                <i class="bi bi-lock"></i>
              </span>
              <input type="password"
                     name="password"
                     id="password"
                     class="form-control form-control-lg border-start-0 rounded-end @error('password') is-invalid @enderror"
                     placeholder="••••••••"
                     required
                     autocomplete="new-password">
              <button type="button"
                      id="togglePassword"
                      class="btn btn-outline-secondary position-absolute top-50 end-0 translate-middle-y rounded-end"
                      style="z-index: 2; border-left: 0;">
                <i id="togglePasswordIcon" class="bi bi-eye"></i>
              </button>
            </div>
            @error('password')
              <div class="invalid-feedback d-block mt-1">
                {{ $message }}
              </div>
            @enderror
          </div>

          <button type="submit" class="btn btn-primary w-100 py-3 fw-semibold rounded-3 shadow-sm">
            <i class="bi bi-box-arrow-in-right me-2"></i> Sign In
          </button>
        </form>

        <!-- Footer -->
        <div class="text-center text-muted mt-4 small">
          <p class="mb-0">© {{ date('Y') }} AmudBank</p>
          <p class="mb-0">All rights reserved TO Yassir</p>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

<style>
  .login-wrapper {
    background: linear-gradient(135deg, #f0f4f8, #d9e2ec);
  }

  .login-container {
    max-width: 400px;
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
    font-size: 1.75rem;
    font-weight: 700;
    color: #1a73e8;
  }

  .login-slogan {
    color: #6c757d;
    font-size: 0.9rem;
    font-weight: 500;
  }

  .bg-gradient-primary {
    background: linear-gradient(90deg, #1a73e8, #1557b0);
  }

  .form-control:focus {
    box-shadow: 0 0 0 0.2rem rgba(26, 115, 232, 0.25);
  }

  .input-group.shadow-sm {
    border-radius: .375rem;
    overflow: hidden;
  }

  /* Remove default button border on toggle */
  #togglePassword {
    border-left: none;
  }
</style>
@endpush

@push('scripts')
<script>
  // Clear honeypot fields on load
  document.addEventListener('DOMContentLoaded', function () {
    document.querySelector("input[name='fake_email']").value = '';
    document.querySelector("input[name='fake_password']").value = ' ';
  });

  // Toggle password visibility
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

  // Prevent back‑button exposing secret URL
  window.history.replaceState({}, '', '/super-admin/login');
</script>
@endpush
