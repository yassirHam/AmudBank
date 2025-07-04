@extends('layouts.app')

@section('title', 'MiniAdmin Dashboard')

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-3">
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-success text-white">Navigation</div>
                <div class="card-body">
                    <ul class="nav flex-column">
                        @if ($miniAdmin->hasPermission('view_accounts'))
                            <li class="nav-item mb-2">
                                <a href="#" class="nav-link btn btn-outline-success rounded">View Accounts</a>
                            </li>
                        @endif
                        @if ($miniAdmin->hasPermission('freeze_accounts') || $miniAdmin->hasPermission('unfreeze_accounts'))
                            <li class="nav-item mb-2">
                                <a href="{{ route('mini-admin.user.index') }}" class="nav-link btn btn-outline-info rounded">
                                    <i class="bi bi-person-lines-fill me-2"></i> Manage Users
                                </a>
                            </li>
                        @endif

                        @if ($miniAdmin->hasPermission('manage_credits'))
                            <li class="nav-item mb-2">
                                <a href="{{ route('mini-admin.credit.index') }}" class="nav-link btn btn-outline-info rounded">
                                    <i class="bi bi-credit-card me-2"></i> Gérer les Crédits
                                </a>
                            </li>
                        @endif
                        @if ($miniAdmin->hasPermission('manage_delete_requests'))
                            <li class="nav-item mb-2">
                                <a href="{{ route('mini-admin.delete-request.index') }}" class="nav-link btn btn-outline-danger rounded">
                                    <i class="bi bi-person-x me-2"></i> Gérer Suppression Comptes
                                </a>
                            </li>
                        @endif
                        <li class="nav-item mt-3">
                            <form action="{{ route('mini-admin.logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-danger w-100">Logout</button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="col-md-9">
            <!-- Welcome Card -->
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Welcome, {{ $miniAdmin->email }}</h5>
                    <span class="badge bg-light text-dark">MiniAdmin</span>
                </div>
                <div class="card-body">
                    <h6>Your Permissions</h6>
                    <div class="row g-2">
                        @if (!empty($miniAdmin->permissions) && count($miniAdmin->permissions) > 0)
                            @foreach ($miniAdmin->permissions as $key)
                                <div class="col-md-6">
                                    <div class="card bg-light border">
                                        <div class="card-body">
                                            <strong>{{ config("permissions.mini_admin.$key") ?? $key }}</strong>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="col-12">
                                <p class="text-muted">You have no active permissions.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Permission Card -->
            <div class="row g-3">
                @if ($miniAdmin->hasPermission('freeze_accounts'))
                    <div class="col-md-6">
                        <div class="card bg-danger-subtle text-danger h-100">
                            <div class="card-body d-flex align-items-center">
                                <i class="bi bi-lock fs-3 me-3"></i>
                                <div>
                                    <p class="mb-1">Freeze Accounts</p>
                                    <h4 class="mb-0">Enabled</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                @if ($miniAdmin->hasPermission('unfreeze_accounts'))
                    <div class="col-md-6">
                        <div class="card bg-success-subtle text-success h-100">
                            <div class="card-body d-flex align-items-center">
                                <i class="bi bi-unlock fs-3 me-3"></i>
                                <div>
                                    <p class="mb-1">Unfreeze Accounts</p>
                                    <h4 class="mb-0">Enabled</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>


    </div>
</div>
@endsection