@php
    $locale = app()->getLocale();
    $isArabic = $locale === 'ar';
    $role = auth()->check() ? auth()->user()->getRoleNames()->first() : null;
@endphp

<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

<style>
    .sidebar-card {
        border-radius: 15px;
        overflow: hidden;
        border: none;
    }

    .sidebar-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        padding: 1.5rem;
        font-size: 1.25rem;
        font-weight: 600;
    }

    .sidebar-item {
        transition: all 0.3s ease;
        border: none;
        padding: 0.75rem 1.5rem;
    }

    .sidebar-item a {
        color: #2d3748;
        text-decoration: none;
        display: flex;
        align-items: center;
        gap: 1rem;
        transition: all 0.3s ease;
    }

    .sidebar-item:hover {
        background-color: #f7fafc;
    }

    .sidebar-item:hover a {
        color: #4a5568;
        transform: translateX(5px);
    }

    .sidebar-icon {
        width: 25px;
        text-align: center;
        color: #667eea;
    }

    /* RTL Adjustments */
    [dir="rtl"] .sidebar-header {
        text-align: right;
    }

    [dir="rtl"] .sidebar-header i {
        margin-left: 0.5rem;
        margin-right: 0;
    }

    [dir="rtl"] .sidebar-item a {
        flex-direction: row-reverse;
    }

    [dir="rtl"] .sidebar-item:hover a {
        transform: translateX(-5px);
    }
</style>

<div class="card h-100 sidebar-card" dir="{{ $isArabic ? 'rtl' : 'ltr' }}">
    <div class="card-header sidebar-header text-white">
        <i class="fas fa-bars {{ $isArabic ? 'ms-2' : 'me-2' }}"></i>{{ __('Menu') }}
    </div>
    <ul class="list-group list-group-flush">
        <li class="list-group-item sidebar-item">
            <a href="{{ route('home') }}">
                <i class="fas fa-home sidebar-icon"></i>
                {{ $isArabic ? 'پەڕەی سەرەکی' : 'Home' }}
            </a>
        </li>

        @if($role)
            @if($role === 'admin')
                <li class="list-group-item sidebar-item">
                    <a href="{{ route('admin.departments') }}">
                        <i class="fas fa-building sidebar-icon"></i>
                        {{ __('Departments') }}
                    </a>
                </li>
                <li class="list-group-item sidebar-item">
                    <a href="{{ route('head_of_department_users.index') }}">
                        <i class="fas fa-user-tie sidebar-icon"></i>
                        {{ __('Manage Heads of Department') }}
                    </a>
                </li>
            @elseif($role === 'head_of_department')
                <li class="list-group-item sidebar-item">
                    <a href="{{ route('admin.teachers.index') }}">
                        <i class="fas fa-chalkboard-teacher sidebar-icon"></i>
                        {{ __('Teachers') }}
                    </a>
                </li>
                <li class="list-group-item sidebar-item">
                    <a href="{{ route('teacher.users.index') }}">
                        <i class="fas fa-users sidebar-icon"></i>
                        {{ __('Students') }}
                    </a>
                </li>
            @elseif($role === 'teacher')
                <li class="list-group-item sidebar-item">
                    <a href="{{ route('teacher.courses') }}">
                        <i class="fas fa-book-open sidebar-icon"></i>
                        {{ __('My Courses') }}
                    </a>
                </li>
                <li class="list-group-item sidebar-item">
                    <a href="{{ route('teacher.students') }}">
                        <i class="fas fa-user-graduate sidebar-icon"></i>
                        {{ __('Students') }}
                    </a>
                </li>
                <li class="list-group-item sidebar-item">
                    <a href="{{ route('teacher.show') }}">
                        <i class="fas fa-calendar-times sidebar-icon"></i>
                        {{ __('Absences') }}
                    </a>
                </li>
            @elseif($role === 'user')
                <li class="list-group-item sidebar-item">
                    <a href="{{ route('student.subject') }}">
                        <i class="fas fa-book sidebar-icon"></i>
                        {{ __('My Courses') }}
                    </a>
                </li>
                <li class="list-group-item sidebar-item">
                    <a href="{{ route('student.absence') }}">
                        <i class="fas fa-user-clock sidebar-icon"></i>
                        {{ __('Absence') }}
                    </a>
                </li>
            @else
                <li class="list-group-item sidebar-item text-muted">
                    <i class="fas fa-exclamation-circle sidebar-icon"></i>
                    {{ __('No menu available') }}
                </li>
            @endif
        @else
            <li class="list-group-item sidebar-item text-muted">
                <i class="fas fa-sign-in-alt sidebar-icon"></i>
                {{ __('Please log in to see the menu') }}
            </li>
        @endif
    </ul>
</div>
