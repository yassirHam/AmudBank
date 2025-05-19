@extends('auth')
@section("style")

@endsection
@section('content')
<div class="auth-container">
                <!-- Onglets -->
                <div class="auth-tabs">
                    <a style="text-decoration:none" class="tab active" id="login-tab">Connexion</a>
                    <a href="{{route('register_step1')}}" style="text-decoration:none" class="tab" id="register-tab" >Inscription</a>
                </div>

                <!-- Formulaire de Connexion -->
                <form id="login-form" class="auth-form active" action="{{ route('login') }}" method="POST">
                    @if($errors->any())
                        <div style="color: var(--danger-color); background-color: #fee2e2; padding: 1rem; border-radius: var(--border-radius); margin-bottom: 1.5rem;">
                            <ul style="list-style-type: none;">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @csrf
                    <div class="input-group">
                        <label for="login-email">Cin</label>
                        <div class="input-with-icon">
                            <i class="fas fa-id-card"></i>
                            <input type="text" id="login-email" placeholder="carte d'identite" name="Cin" required>
                        </div>
                    </div>

                    <div class="input-group">
                        <label for="login-password">Mot de passe</label>
                        <div class="input-with-icon">
                            <i class="fas fa-lock"></i>
                            <input type="password" id="login-password" placeholder="••••••••" name="password" required>
                            <i class="fas fa-eye toggle-password" data-target="login-password"></i>
                        </div>
                        <div class="under_input">
                            <a href="#" class="forgot-password">Mot de passe oublié ?</a>
                            <p class="dont">vous n'avez pas de compte? <a href="{{route('register_step1')}}" class="t">s'inscrire</a></p>
                        </div>
                    </div>

                    <button type="submit" class="auth-btn">
                        <span>Se connecter</span>
                        <i class="fas fa-arrow-right"></i>
                    </button>
                </form>
@endsection