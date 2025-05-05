@extends('layouts.app')

@section('content')
<!-- ✅ Success Message -->
@if (session('success'))
    <div class="container mb-3">
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
@endif

<div class="container">
    <h3>MiniAdmin Management</h3>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Email</th>
                <th>Permissions</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($miniAdmins as $miniAdmin)
            <tr>
                <td>{{ $miniAdmin->email }}</td>
                <td>
                @foreach ($miniAdmin->permissions ?? [] as $perm)
                  <span class="badge bg-secondary">{{ $perm }}</span>
                @endforeach
                </td>
                <td>
                    <a href="{{ route('super-admin.mini-admin.edit', $miniAdmin) }}" class="btn btn-sm btn-primary">Edit</a>
                    <form action="{{ route('super-admin.mini-admin.destroy', $miniAdmin) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection