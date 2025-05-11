@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Student Dashboard - {{ config('app.name') }}</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <style>
        .dashboard-card {
            transition: transform 0.3s;
        }
        .dashboard-card:hover {
            transform: translateY(-5px);
        }
        .profile-header {
            background: linear-gradient(135deg, #3a6073, #3a7bd5);
            color: white;
        }
    </style>
</head>
<body>
    <!-- Student Dashboard Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="{{ route('student.dashboard') }}">Student Portal</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                            {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="">My Profile</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item">Logout</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Dashboard Content -->
    <div class="container-fluid mt-4">
        <div class="row">
            <!-- Sidebar -->
            <nav class="col-md-2 d-none d-md-block bg-light sidebar">
                <div class="position-sticky pt-3">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link active" href="#">
                                <i class="fas fa-home"></i>
                                Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="fas fa-book-open"></i>
                                My Courses
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="fas fa-calendar-alt"></i>
                                Schedule
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="fas fa-chart-line"></i>
                                Grades
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- Main Content -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <!-- Welcome Header -->
                <div class="profile-header rounded-3 p-4 mb-4">
                    <div class="row align-items-center">
                        <div class="col-md-2">
                            <img src="{{ Auth::user()->avatar ?? asset('images/default-avatar.png') }}"
                                 class="img-thumbnail rounded-circle"
                                 alt="Profile Photo"
                                 style="width: 100px; height: 100px;">
                        </div>
                        <div class="col-md-10">
                            <h2>Welcome, {{ Auth::user()->name }}</h2>
                            <p class="mb-0">Student ID: {{ Auth::user()->student_id }}</p>
                            <p class="mb-0">Department: {{ Auth::user()->department->name }}</p>
                        </div>
                    </div>
                </div>

                <!-- Quick Stats -->
                <div class="row mb-4">
                    <div class="col-md-4">
                        <div class="card dashboard-card text-white bg-success">
                            <div class="card-body">
                                <h5 class="card-title">Enrolled Courses</h5>
                                <h2 class="card-text">5</h2>
                                <a href="#" class="text-white">View Details →</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card dashboard-card text-white bg-info">
                            <div class="card-body">
                                <h5 class="card-title">Upcoming Assignments</h5>
                                <h2 class="card-text">3</h2>
                                <a href="#" class="text-white">View Calendar →</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card dashboard-card text-white bg-warning">
                            <div class="card-body">
                                <h5 class="card-title">Current GPA</h5>
                                <h2 class="card-text">3.75</h2>
                                <a href="#" class="text-white">View Grades →</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- My Courses Section -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h4 class="mb-0">My Current Courses</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            {{-- @foreach($courses as $course)
                            <div class="col-md-4 mb-4">
                                <div class="card h-100">
                                    <img src="{{ asset($course->thumbnail) }}" class="card-img-top" alt="{{ $course->name }}">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $course->code }}: {{ $course->name }}</h5>
                                        <p class="card-text">{{ Str::limit($course->description, 100) }}</p>
                                        <div class="progress mb-3">
                                            <div class="progress-bar" role="progressbar"
                                                 style="width: {{ $course->progress }}%;"
                                                 aria-valuenow="{{ $course->progress }}"
                                                 aria-valuemin="0"
                                                 aria-valuemax="100">
                                                {{ $course->progress }}%
                                            </div>
                                        </div>
                                        <a href="{{ route('courses.show', $course->id) }}" class="btn btn-primary">
                                            View Course
                                        </a>
                                    </div>
                                </div>
                            </div>
                            @endforeach --}}
                        </div>
                    </div>
                </div>

                <!-- Academic Calendar -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h4 class="mb-0">Academic Calendar</h4>
                    </div>
                    <div class="card-body">
                        <div id="calendar"></div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer mt-auto py-3 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <span class="text-muted">&copy; {{ date('Y') }} {{ config('app.name') }} - Student Portal</span>
                </div>
                <div class="col-md-6 text-end">
                    <a href="#" class="text-muted me-3">Privacy Policy</a>
                    <a href="#" class="text-muted">Terms of Service</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    @vite(['resources/js/app.js'])
    <script>
        // Initialize calendar
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                events:[]
            });
            calendar.render();
        });
    </script>
</body>
</html>
@endsection
