<!-- resources/views/mini-admin/login.blade.php -->
@extends('layouts.app')

@section('title', 'MiniAdmin Login')

@section('content')
<div class="row justify-content-center mt-5">
    <div class="col-md-4">
        <div class="card shadow-lg border-0 rounded-lg">
            <div class="card-header bg-success text-white text-center">
                <h4>AmudBank Staff Portal</h4>
                <small>MiniAdmin Login</small>
            </div>
            <div class="card-body p-4">
                <form method="POST" action="{{ route('mini-admin.login.submit') }}">
                    @csrf
                    <div class="mb-3">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" autocomplete="off" required>
                    </div>
                    <div class="mb-3">
                        <label>Password</label>
                        <div class="input-group">
                            <input type="password" name="password" id="password" class="form-control" required>
                            <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                <i class="bi bi-eye"></i>
                            </button>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success w-100">Login</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<!-- Add Bootstrap Icons CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
@endpush
@push('scripts')
<script>
document.getElementById('togglePassword').addEventListener('click', function () {
    const pwd = document.getElementById('password');
    const icon = this.querySelector('i');
    pwd.type = pwd.type === 'password' ? 'text' : 'password';
    icon.classList.toggle('bi-eye');
    icon.classList.toggle('bi-eye-slash');
});
</script>
@endpush