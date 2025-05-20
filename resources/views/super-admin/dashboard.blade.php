@extends('layouts.app')

@section('title', 'AmudBank SuperAdmin Dashboard')

@section('content')
<div class="dashboard-container">
    <!-- Sidebar -->
    <nav class="sidebar" data-bs-spy="affix" data-bs-offset-top="50">
        <div class="sidebar-header">
            <h5 class="sidebar-title">AmudBank SuperAdmin</h5>
        </div>
        
        <ul class="nav flex-column mt-4">
            <li class="nav-item">
                <a href="{{ route('super-admin.mini-admin.index') }}" class="nav-link btn btn-outline-primary rounded">
                 <i class="bi bi-people me-2"></i>MiniAdmin Management
                </a>
            </li>
            <li class="nav-item mb-2">
                <a href="{{ route('super-admin.user.index') }}" class="nav-link btn btn-outline-primary rounded">
                  <i class="bi bi-person-lines-fill me-2"></i> User Accounts
                </a>
            </li>
        </ul>

        <div class="logout-section mt-auto">
            <form action="{{ route('super-admin.logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-danger w-100">
                    <i class="bi bi-box-arrow-left me-2"></i> Logout
                </button>
            </form>
        </div>
    </nav>
    <main class="main-content">
        <header class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fs-4 fw-bold text-dark mb-0">Admin Control Center</h2>
            <div class="d-flex align-items-center gap-3">
                <span class="badge bg-success-subtle text-success">SuperAdmin</span>
            </div>
        </header>
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                <i class="bi bi-check-circle me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="row g-4">
            <div class="col-md-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-header bg-white border-0 pb-0">
                        <h5 class="card-title mb-0">Recent Activity</h5>
                    </div>
                    <div class="card-body p-0">
                        <div class="activity-feed">
                            @forelse ($recentActivity as $log)
                                <div class="activity-item d-flex align-items-start mb-3 p-3 border-bottom">
                
                                    <div>
                                        <p class="mb-1"><strong>{{ $log->miniAdmin->email }}</strong></p>
                                        <p class="mb-0 small text-muted">
                                            {{ Str::limit($log->action, 1000) }}<br>
                                            {{ Str::limit($log->description, 1000) }}<br>
                                            <span class="ms-2" title="{{ $log->created_at }}">{{ $log->created_at->diffForHumans() }}</span>
                                        </p>
                                    </div>
                                </div>
                            @empty
                                <div class="text-center py-5 text-muted">
                                    <i class="bi bi-clock-history display-6 opacity-25 mb-2"></i>
                                    <p class="mb-0">No recent activity</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
            <!-- Create MiniAdmin Section -->
            <div class="col-md-8">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white border-0">
                        <div class="d-flex align-items-center justify-content-between">
                            <h5 class="card-title mb-0 text-primary">
                                <i class="bi bi-person-plus me-2"></i>Create New MiniAdmin
                            </h5>
                            <span class="badge bg-success-subtle text-success">Active</span>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('super-admin.mini-admin.create') }}" class="row g-3">
                            @csrf
                            <div class="col-md-6">
                                <label for="email" class="form-label">Email Address</label>
                                <div class="input-group">
                                    <input type="email" name="email" id="email" class="form-control rounded-end" required placeholder="miniadmin{number}@amudbank.com">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" name="password" id="password" class="form-control" required placeholder="••••••••••••">
                            </div>
                            <div class="col-12 d-grid">
                                <button type="submit" class="btn btn-success btn-lg py-3">
                                    <i class="bi bi-person-plus me-2"></i>Create MiniAdmin
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="row g-3 mt-2">
                    <div class="col-md-6">
                        <div class="card border-0 shadow-sm h-100">
                            <div class="card-body d-flex align-items-center">
                               <div class="icon-container bg-primary-subtle text-primary me-3">
                                    <i class="bi bi-person-fill-gear fs-4"></i>
                                </div>
                                <div>
                                    <p class="text-muted mb-1">Total MiniAdmins</p>
                                    <h4 class="mb-0 text-primary">{{ \App\Models\MiniAdmin::count() }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card border-0 shadow-sm h-100">
                            <div class="card-body d-flex align-items-center">
                                <div class="icon-container bg-primary-subtle text-primary me-3">
                                    <i class="bi bi-person-fill-gear fs-4"></i>
                                </div>
                                <div>
                                    <p class="text-muted mb-1">Total Users</p>
                                    <h4 class="mb-0 text-primary">{{ \App\Models\User::count() }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
@endsection

@push('styles')
<style>
.dashboard-container {
    display: flex;
    min-height: 100vh;
    background-color: #f8f9fa;
}

.sidebar {
    width: 250px;
    background: #0a58ca;
    color: white;
    position: sticky;
    top: 20px;
    height: fit-content;
    padding: 1.5rem;
    border-radius: 1rem;
    background: linear-gradient(145deg, #0a58ca, #084298);
}

.sidebar-logo {
    width: 40px;
    height: 40px;
}

.sidebar-title {
    color: white;
    font-size: 1.1rem;
    font-weight: 600;
    align-items: center;
    display: flex;
    margin-bottom: 1.5rem;
}

.sidebar .nav-link {
    color: rgba(255, 255, 255, 0.9);
    padding: 0.8rem 1rem;
    border-radius: 0.5rem;
    transition: all 0.2s ease;
}

.sidebar .nav-link:hover {
    background-color: rgba(255, 255, 255, 0.1);
}
   

.main-content {
    flex-grow: 1;
    padding: 1.5rem 2rem;
}

.activity-feed {
    max-height: 400px;
    overflow-y: auto;
    padding: 1rem;
}

.activity-feed::-webkit-scrollbar {
    width: 8px;
}

.activity-feed::-webkit-scrollbar-thumb {
    background-color: #dee2e6;
    border-radius: 4px;
}

.icon-container {
    width: 40px;
    height: 40px;
    border-radius: 0.5rem;
    display: flex;
    align-items: center;
    justify-content: center;
}
</style>
@endpush