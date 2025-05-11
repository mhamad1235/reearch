@extends('layouts.app')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

<style>
    :root {
        --university-primary: #003366;
        --university-secondary: #E57200;
        --university-light: #f8f9fa;
    }

    body {
        font-family: 'Roboto', sans-serif;
    }

    .auth-container {
        min-height: 100vh;
        background-color: var(--university-light);
        padding: 2rem;
        display: flex;
        align-items: center;
    }

    .auth-card {
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        border: 1px solid #e0e0e0;
    }

    .auth-illustration {
        background: linear-gradient(135deg, var(--university-primary) 0%, #004080 100%);
        padding: 3rem;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        color: white;
    }

    .university-logo {
        max-width: 180px;
        margin-bottom: 2rem;
    }

    .auth-content {
        padding: 3rem;
        background: #fff;
    }

    .auth-title {
        font-weight: 600;
        color: var(--university-primary);
        margin-bottom: 1.5rem;
        font-size: 1.75rem;
        position: relative;
        padding-bottom: 0.75rem;
    }

    .auth-title:after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 60px;
        height: 3px;
        background-color: var(--university-secondary);
    }

    .form-control {
        border-radius: 4px;
        padding: 0.75rem 1.25rem;
        border: 1px solid #ced4da;
        transition: all 0.3s ease;
    }

    .form-control:focus {
        box-shadow: 0 0 0 3px rgba(0, 51, 102, 0.1);
        border-color: var(--university-primary);
    }

    .input-icon {
        position: absolute;
        left: 1rem;
        top: 50%;
        transform: translateY(-50%);
        color: #6c757d;
    }

    .btn-primary {
        background-color: var(--university-primary);
        border-color: var(--university-primary);
        padding: 0.75rem;
        font-weight: 500;
        letter-spacing: 0.5px;
    }

    .btn-primary:hover {
        background-color: #002244;
        border-color: #002244;
    }

    .forgot-link {
        color: var(--university-secondary);
        text-decoration: none;
        font-weight: 500;
    }

    .forgot-link:hover {
        color: #c25e00;
        text-decoration: underline;
    }

    .auth-footer {
        margin-top: 2rem;
        padding-top: 1.5rem;
        border-top: 1px solid #eee;
        font-size: 0.875rem;
        color: #6c757d;
    }
</style>

<div class="auth-container">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="auth-card">
                    <div class="row g-0">
                        <!-- University Branding Section -->
                        <div class="col-md-5 auth-illustration d-none d-md-flex">
                            <img src="/assets/images/slider-image1.jpg" alt="University Logo" class="university-logo">
                            <div class="text-center">
                                <h3 class="mt-4 fw-semibold"> Authentication System</h3>
                                <p class="mb-0">Secure access to academic resources</p>
                            </div>
                            <div class="mt-auto">
                                <p class="small mb-0">© {{ date('Y') }}  All rights reserved.</p>
                            </div>
                        </div>

                        <!-- Form Section -->
                        <div class="col-md-7">
                            <div class="auth-content">
                                <h1 class="auth-title">{{ __('Login') }}</h1>
                                <p class="text-muted mb-4">Please enter your credentials to access the portal</p>

                                <form method="POST" action="{{ route('login') }}">
                                    @csrf

                                    <!-- Email Input -->
                                    <div class="mb-4 position-relative">
                                        <i class="bi bi-person-fill input-icon"></i>
                                        <input id="email" type="email"
                                               class="form-control ps-5 @error('email') is-invalid @enderror"
                                               name="email" value="{{ old('email') }}"
                                               placeholder="{{ __('University Email') }}"
                                               required autocomplete="email" autofocus>
                                        @error('email')
                                            <div class="invalid-feedback d-block mt-1">
                                                <i class="bi bi-exclamation-circle me-1"></i> {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <!-- Password Input -->
                                    <div class="mb-4 position-relative">
                                        <i class="bi bi-lock-fill input-icon"></i>
                                        <input id="password" type="password"
                                               class="form-control ps-5 @error('password') is-invalid @enderror"
                                               name="password"
                                               placeholder="{{ __('Password') }}"
                                               required autocomplete="current-password">
                                        @error('password')
                                            <div class="invalid-feedback d-block mt-1">
                                                <i class="bi bi-exclamation-circle me-1"></i> {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <!-- Remember Me & Forgot Password -->
                                    <div class="d-flex justify-content-between align-items-center mb-4">
                                        <div class="form-check">
                                            {{-- <input class="form-check-input" type="checkbox"
                                                   name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                            <label class="form-check-label text-muted" for="remember">
                                                {{ __('Remember Me') }}
                                            </label> --}}
                                        </div>
                                        @if (Route::has('password.request'))
                                            <a href="{{ route('password.request') }}" class="forgot-link">
                                                {{ __('Forgot Password') }}
                                            </a>
                                        @endif
                                    </div>

                                    <!-- Submit Button -->
                                    <button type="submit" class="btn btn-primary w-100 mb-3">
                                        {{ __('Login') }}
                                        <i class="bi bi-box-arrow-in-right ms-2"></i>
                                    </button>

                                    <!-- Help Text -->
                                    <div class="text-center small text-muted mb-3">
                                        Trouble logging in? Contact the <a href="#" class="text-decoration-none">IT Help Desk</a>
                                    </div>

                                    <!-- Footer -->
                                    <div class="auth-footer">
                                        <div class="d-flex justify-content-between">
                                            <span>Secure login</span>
                                            <span><i class="bi bi-shield-lock-fill text-success me-1"></i> Encrypted</span>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
