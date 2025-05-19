@extends('layouts.app')

@section('content')

<div class="container">
    <h3>Edit MiniAdmin: {{ $miniAdmin->email }}</h3>
    <form method="POST" action="{{ route('super-admin.mini-admin.update', $miniAdmin) }}">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label>Password</label>
            <input type="password" name="password" class="form-control">
        </div>
        <div class="mb-3">
            <label>Confirm Password</label>
            <input type="password" name="password_confirmation" class="form-control">
        </div>
        <div class="mb-3">
            <label>Permissions</label>
            <div class="row">
                @foreach (config('permissions.mini_admin') as $key => $label)
                    <div class="col-md-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox"
                                   name="permissions[]" value="{{ $key }}" id="perm-{{ $key }}"
                                {{ in_array($key, $miniAdmin->permissions ?? []) ? 'checked' : '' }}>
                            <label class="form-check-label" for="perm-{{ $key }}">{{ $label }}</label>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Save Changes</button>
    </form>
</div>
@endsection