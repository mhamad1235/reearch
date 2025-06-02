<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

		<title>HTML Education Template</title>

		<!-- Google font -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link href="https://fonts.googleapis.com/css?family=Lato:700%7CMontserrat:400,600" rel="stylesheet">

		<!-- Bootstrap RTL/LTR -->

			<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css" rel="stylesheet" integrity="sha384-dpuaG1suU0eT09tx5plCaHSTWQElEALj4pFo4gXqZnlEokjXRQEiN9HAWBCTeGul" crossorigin="anonymous">

			<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">


		<!-- Font Awesome Icon -->
		<link rel="stylesheet" href="css/font-awesome.min.css">

		<!-- Custom stlylesheet -->

			<link rel="stylesheet" href="{{ asset('assets/css/style-rtl.css') }}">

			<link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

		<style></style>
		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>
	<body>

		<!-- Header -->
		<header style="border: none" id="header" class="transparent-nav">
			<div class="container">
				<div class="navbar-header">
					<!-- Logo -->
					<div class="navbar-brand">
						<a class="logo" href="index.html">
							{{-- <img src="{{ asset('assets/images/logo.png') }}" alt="logo"> --}}
						</a>
					</div>
					<!-- /Logo -->

					<!-- Mobile toggle -->

					<!-- /Mobile toggle -->
				</div>

				<!-- Navigation -->
				{{-- <nav class="navbar navbar-expand-lg">
					<div class="collapse navbar-collapse" id="navbarNav">
						<ul class="navbar-nav {{ app()->getLocale() === 'ar' ? 'me-auto' : 'ms-auto' }}">
							<li class="nav-item"><a class="nav-link" href="#home">__(Home)</a></li>
							<li class="nav-item"><a class="nav-link" href="#About">About</a></li>
							<li class="nav-item"><a class="nav-link" href="#Courses">Courses</a></li>
							<li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>
							<li class="nav-item"><a class="nav-link" href="login">Login</a></li>
						</ul>
					</div>
				</nav> --}}
				<!-- /Navigation -->
			</div>
		</header>
	<body>

		<!-- Header -->
		<header id="header" class="transparent-nav">
			<div class="container">

				<div class="navbar-header">
    <!-- Logo -->
   <div class="navbar-brand" style="text-align: left; width: 100%;">
    <a class="logo" href="{{ route('change.language', app()->getLocale() === 'ar' ? 'en' : 'ar') }}" style="display: inline-block;">
<span style="font-size: 24px;"></span>
@if(app()->getLocale() === 'ar')
    <img src="/assets/images/uk.png" alt="English Flag" />
@else
    <img src="/assets/images/flag.png" alt="Arabic Flag" />
@endif    </a>
</div>

					<!-- /Logo -->


					{{-- <button  style="background: none; border:none;text-decoration:none;height:90px;width:90px" class="navbar-toggle">
							 <a style="height: 100%;width:100%" class="logo" href="{{ route('change.language', app()->getLocale() === 'ar' ? 'en' : 'ar') }}">
                    🌐 {{ app()->getLocale() === 'ar' ? '' : '' }}
                </a>
					</button>  --}}
					<!-- /Mobile toggle -->
				</div>

				<!-- Navigation -->
				<!-- Navigation -->
<nav class="navbar navbar-expand-lg">
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto"> {{-- ms-auto pushes menu to right --}}
            <li class="nav-item"><a class="nav-link" href="index.html">{{ __('Home') }}</a></li>
            <li class="nav-item"><a class="nav-link" href="#about">{{ __('About') }}</a></li>
            <li class="nav-item"><a class="nav-link" href="#courses">{{ __('Courses') }}</a></li>
            <li class="nav-item"><a class="nav-link" href="#footer">{{ __('Contact') }}</a></li>
            <li class="nav-item"><a class="nav-link" href="login">{{ __('Login') }}</a></li>
        </ul>
    </div>
</nav>
<!-- /Navigation -->

				<!-- /Navigation -->

			</div>
		</header>
		<!-- /Header -->

		<!-- Home -->
		<div id="home" class="hero-area">

			<!-- Backgound Image -->
			<div class="bg-image bg-parallax overlay" style="background-image:url(/assets/images/slider-image1.jpg)"></div>
			<!-- /Backgound Image -->

			<div class="home-wrapper">
				<div class="container">
					<div class="row">
						<div class="col-md-8">
							<h1 class="white-text">{{__('Empowering your future with free')}}</h1>
							<p class="lead white-text"> {{__('high-quality online training courses.')}}</p>
							<a class="main-button icon-button" href="#">{{__('Get Started')}}!</a>
						</div>
					</div>
				</div>
			</div>

		</div>
		<!-- /Home -->

		<!-- About -->
        <section class="posts-section py-5 bg-light">
    <div class="container">
        <div class="section-header text-center mb-5">
            <h2>{{ __('Latest News & Updates') }}</h2>
            <p class="lead text-muted">{{ __('Stay informed with the latest articles and updates from Edusite.') }}</p>
        </div>

        <div class="row g-4">
            @forelse($posts as $post)
                <div class="col-12">
                    <article class="card shadow-sm border-0 rounded-3 d-flex flex-row align-items-start" style="min-height: 250px;">
                        @if($post->image)
                            <img src="{{ asset($post->image) }}" alt="{{ $post->name }}"
                                style="width: 350px; height: 250px; object-fit: cover; border-top-left-radius: .75rem; border-bottom-left-radius: .75rem;">
                        @endif
                        <div class="card-body d-flex flex-column ms-3">
                            <h4 class="card-title">{{ $post->name }}</h4>
                            <p class="card-text flex-grow-1">{{ Str::limit($post->description, 300) }}</p>

                        </div>
                    </article>
                </div>
            @empty
                <p class="text-center text-muted">{{ __('No posts available at the moment.') }}</p>
            @endforelse
        </div>
    </div>
</section>

		<div id="about" class="section">

			<!-- container -->
			<div class="container">

				<!-- row -->
				<div class="row">


                    <div class="col-md-6">


    <div class="section-header">
        <h2>{{ __('Welcome to Edusite') }}</h2>
        <p class="lead">{{ __('Libris vivendo eloquentiam ex ius, nec id splendide abhorreant.') }}</p>
    </div>

    <!-- feature -->
    <div class="feature">
        <i class="feature-icon fa fa-flask"></i>
        <div class="feature-content">
            <h4>{{ __('Online Courses') }}</h4>
            <p>{{ __('Ceteros fuisset mei no, soleat epicurei adipiscing ne vis. Et his suas veniam nominati.') }}</p>
        </div>
    </div>
    <!-- /feature -->

    <!-- feature -->
    <div class="feature">
        <i class="feature-icon fa fa-users"></i>
        <div class="feature-content">
            <h4>{{ __('Expert Teachers') }}</h4>
            <p>{{ __('Ceteros fuisset mei no, soleat epicurei adipiscing ne vis. Et his suas veniam nominati._2') }}</p>
        </div>
    </div>
    <!-- /feature -->

    <!-- feature -->
    <div class="feature">
        <i class="feature-icon fa fa-comments"></i>
        <div class="feature-content">
            <h4>{{ __('Community') }}</h4>
            <p>{{ __('Ceteros fuisset mei no, soleat epicurei adipiscing ne vis. Et his suas veniam nominati._3') }}</p>
        </div>
    </div>
    <!-- /feature -->
</div>


					<div class="col-md-6">
						<div class="about-img">
							<img src="{{ asset('assets/images/about.png') }}" alt="">
						</div>
					</div>

				</div>
				<!-- row -->

			</div>
			<!-- container -->
		</div>
		<!-- /About -->

		<!-- Courses -->
	<div id="courses" class="section">
	<div class="container">

		<!-- row -->
		<div class="row">
			<div class="section-header text-center">
				<h2>{{ __('Explore Courses') }}</h2>
				<p class="lead">{{ __('Libris vivendo eloquentiam ex ius, nec id splendide abhorreant.') }}</p>
			</div>
		</div>
		<!-- /row -->

		<!-- courses -->
		<div id="courses-wrapper">

			<!-- row -->
			<div class="row">
				@php
					$courses = [
						[
							'image' => 'blog01.jpg',
							'title' => 'Beginner to Pro in Excel: Financial Modeling and Valuation',
							'category' => 'Business',
							'price' => 'Free'
						],
						[
							'image' => 'blog02.jpg',
							'title' => 'Introduction to CSS',
							'category' => 'Web Design',
							'price' => 'Premium'
						],
						[
							'image' => 'blog03.jpg',
							'title' => 'The Ultimate Drawing Course | From Beginner To Advanced',
							'category' => 'Drawing',
							'price' => 'Premium'
						],
						[
							'image' => 'blog04.jpg',
							'title' => 'The Complete Web Development Course',
							'category' => 'Web Development',
							'price' => 'Free'
						],
						[
							'image' => 'course01.jpg',
							'title' => 'PHP Tips, Tricks, and Techniques',
							'category' => 'Web Development',
							'price' => 'Free'
						],
						[
							'image' => 'course02.jpg',
							'title' => 'All You Need To Know About Web Design',
							'category' => 'Web Design',
							'price' => 'Free'
						],
						[
							'image' => 'course03.jpg',
							'title' => 'How to Get Started in Photography',
							'category' => 'Photography',
							'price' => 'Free'
						],
						[
							'image' => 'course04.jpg',
							'title' => 'Typography From A to Z',
							'category' => 'Typography',
							'price' => 'Free'
						]
					];
				@endphp

				@foreach ($courses as $course)
					<div class="col-md-3 col-sm-6 col-xs-6">
						<div class="course">
							<a href="#" class="course-img">
								<img src="{{ asset('assets/images/' . $course['image']) }}" alt="">
								<i class="course-link-icon fa fa-link"></i>
							</a>
							<a class="course-title" href="#">{{ __($course['title']) }}</a>
							<div class="course-details">
								<span class="course-category">{{ __($course['category']) }}</span>
								<span class="course-price {{ $course['price'] === 'Free' ? 'course-free' : 'course-premium' }}">
									{{ __($course['price']) }}
								</span>
							</div>
						</div>
					</div>
				@endforeach
			</div>
			<!-- /row -->

		</div>
		<!-- /courses -->

		<div class="row">
			<div class="center-btn">
				<a class="main-button icon-button" href="#">{{ __('More Courses') }}</a>
			</div>
		</div>

	</div>
</div>

		<!-- /Courses -->

		<!-- Call To Action -->
		<div id="cta" class="section">

			<!-- Backgound Image -->
			<div class="bg-image bg-parallax overlay" style="background-image:url(/assets/images/cta1-background.jpg)"></div>
			<!-- /Backgound Image -->

			<!-- container -->
			<div class="container">

				<!-- row -->
				<div class="row">

					<div class="col-md-6">
						<h2 class="white-text">Ceteros fuisset mei no, soleat epicurei adipiscing ne vis.</h2>
						<p class="lead white-text">Ceteros fuisset mei no, soleat epicurei adipiscing ne vis. Et his suas veniam nominati.</p>
						<a class="main-button icon-button" href="#">{{__('Get Started')}}</a>
					</div>

				</div>
				<!-- /row -->

			</div>
			<!-- /container -->

		</div>
		<!-- /Call To Action -->

		<!-- Why us -->
		<div id="why-us" class="section">

		<!-- container -->
<div class="container">

	<!-- row -->
	<div class="row">
		<div class="section-header text-center">
			<h2>{{ __('Why Edusite') }}</h2>
			<p class="lead">{{ __('Libris vivendo eloquentiam ex ius, nec id splendide abhorreant.') }}</p>
		</div>

		<!-- feature -->
		<div class="col-md-4">
			<div class="feature">
				<i class="feature-icon fa fa-flask"></i>
				<div class="feature-content">
					<h4>{{ __('Online Courses') }}</h4>
					<p>{{ __('Ceteros fuisset mei no, soleat epicurei adipiscing ne vis. Et his suas veniam nominati.') }}</p>
				</div>
			</div>
		</div>
		<!-- /feature -->

		<!-- feature -->
		<div class="col-md-4">
			<div class="feature">
				<i class="feature-icon fa fa-users"></i>
				<div class="feature-content">
					<h4>{{ __('Expert Teachers') }}</h4>
					<p>{{ __('Ceteros fuisset mei no, soleat epicurei adipiscing ne vis. Et his suas veniam nominati.') }}</p>
				</div>
			</div>
		</div>
		<!-- /feature -->

		<!-- feature -->
		<div class="col-md-4">
			<div class="feature">
				<i class="feature-icon fa fa-comments"></i>
				<div class="feature-content">
					<h4>{{ __('Community') }}</h4>
					<p>{{ __('Ceteros fuisset mei no, soleat epicurei adipiscing ne vis. Et his suas veniam nominati.') }}</p>
				</div>
			</div>
		</div>
		<!-- /feature -->

	</div>
	<!-- /row -->

	<hr class="section-hr">

	<!-- row -->
	<div class="row">

		<div class="col-md-6">
			<h3>{{ __('Persius imperdiet incorrupte et qui, munere nusquam et nec.') }}</h3>
			<p class="lead">{{ __('Libris vivendo eloquentiam ex ius, nec id splendide abhorreant.') }}</p>
			<p>{{ __('No vel facete sententiae, quodsi dolores no quo, pri ex tamquam interesset necessitatibus. Te denique cotidieque delicatissimi sed. Eu doming epicurei duo. Sit ea perfecto deseruisse theophrastus. At sed malis hendrerit, elitr deseruisse in sit, sit ei facilisi mediocrem.') }}</p>
		</div>

		<div class="col-md-5 col-md-offset-1">
			<a class="about-video" href="#">
				<img src="{{ asset('assets/images/about-video.jpg') }}" alt="">
				<i class="play-icon fa fa-play"></i>
			</a>
		</div>

	</div>
	<!-- /row -->

</div>

			<!-- /container -->

		</div>
		<!-- /Why us -->

		<!-- Contact CTA -->
		<div id="contact-cta" class="section">

			<!-- Backgound Image -->
			<div class="bg-image bg-parallax overlay" style="background-image:url(/assets/images/cta2-background.jpg)"></div>
			<!-- Backgound Image -->

			<!-- container -->
			<div class="container">

				<!-- row -->
				<div class="row">

					<div class="col-md-8 col-md-offset-2 text-center">
						<h2 class="white-text">Contact</h2>
						<p class="lead white-text">Libris vivendo eloquentiam ex ius, nec id splendide abhorreant.</p>
						<a class="main-button icon-button" href="#">{{__('Contact')}}</a>
					</div>

				</div>
				<!-- /row -->

			</div>
			<!-- /container -->

		</div>
		<!-- /Contact CTA -->

		<!-- Footer -->
		<footer id="footer" class="section">

			<!-- container -->
			<div class="container">

				<!-- row -->
				<div class="row">

					<!-- footer logo -->
					<div class="col-md-6">
						<div class="footer-logo">
							<a class="logo" href="index.html">
								{{-- <img src="/assets/images/logo.png" alt="logo"> --}}
							</a>
						</div>
					</div>
					<!-- footer logo -->

					<!-- footer nav -->
					<div class="col-md-6">
						<ul class="footer-nav">
							<li><a href="index.html">{{__('Home')}}</a></li>
							<li><a href="#">{{__('About')}}</a></li>
							<li><a href="#">{{__('Courses')}}</a></li>

							<li><a href="contact.html">{{__('Contact')}}</a></li>
						</ul>
					</div>
					<!-- /footer nav -->

				</div>
				<!-- /row -->

				<!-- row -->
				<div id="bottom-footer" class="row">

					<!-- social -->
					<div class="col-md-4 col-md-push-8">
						<ul class="footer-social">
							<li><a href="#" class="facebook"><i class="fa fa-facebook"></i></a></li>
							<li><a href="#" class="twitter"><i class="fa fa-twitter"></i></a></li>
							<li><a href="#" class="google-plus"><i class="fa fa-google-plus"></i></a></li>
							<li><a href="#" class="instagram"><i class="fa fa-instagram"></i></a></li>
							<li><a href="#" class="youtube"><i class="fa fa-youtube"></i></a></li>
							<li><a href="#" class="linkedin"><i class="fa fa-linkedin"></i></a></li>
						</ul>
					</div>
					<!-- /social -->

					<!-- copyright -->
					<div class="col-md-8 col-md-pull-4">
						<div class="footer-copyright">
						</div>
					</div>
					<!-- /copyright -->

				</div>
				<!-- row -->

			</div>
			<!-- /container -->

		</footer>
		<!-- /Footer -->


		<!-- /preloader -->


		<!-- jQuery Plugins -->
		<script type="text/javascript" src="js/jquery.min.js"></script>
		<script type="text/javascript" src="js/bootstrap.min.js"></script>
		<script type="text/javascript" src="js/main.js"></script>

	</body>
</html>
