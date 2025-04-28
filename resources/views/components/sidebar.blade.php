@php
    $locale = app()->getLocale();
    $isArabic = $locale === 'ar';
    $role = auth()->check() ? auth()->user()->getRoleNames()->first() : null;
@endphp

<div class="card h-100 shadow-sm" dir="{{ $isArabic ? 'rtl' : 'ltr' }}">
    <div class="card-header text-white bg-primary">
        {{ __('Menu') }}
    </div>
    <ul class="list-group list-group-flush">
        <li class="list-group-item">
            <a href="{{ route('home') }}">🏠 {{ $isArabic ? 'الصفحة الرئيسية' : 'Home' }}</a>
        </li>

        @if($role)
            @if($role === 'admin')
                <li class="list-group-item"><a href="{{ route('admin.departments') }}">🏢 Departments</a></li>
                <li class="list-group-item"><a href="{{ route('head_of_department_users.index') }}">👨‍💼 Manage Heads of Department</a></li>
            @elseif($role === 'head_of_department')
                <li class="list-group-item"><a href="{{ route('admin.teachers.index') }}">👨‍🏫 Teachers</a></li>
                <li class="list-group-item"><a href="{{ route('teacher.users.index') }}">👨‍🏫 Students</a></li>
            @elseif($role === 'teacher')
                <li class="list-group-item"><a href="{{ route('teacher.courses') }}">📚 My Courses</a></li>
            @elseif($role === 'user')
                <li class="list-group-item"><a href="{{ route('student.subject') }}">📖 My Courses</a></li>
            @else
                <li class="list-group-item text-muted">{{ __('No menu available') }}</li>
            @endif
        @else
            <li class="list-group-item text-muted">{{ __('Please log in to see the menu') }}</li>
        @endif
    </ul>
</div>
