<?php
session_start();
include_once 'classes/User.php';
$user = new User;
$user->logged_in();
?>
<!DOCTYPE HTML>
<html><head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Education &mdash; Free Website Template, Free HTML5 Template by freehtml5.co</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Free HTML5 Website Template by freehtml5.co" />
	<meta name="keywords" content="free website templates, free html5, free template, free bootstrap, free website template, html5, css3, mobile first, responsive" />
	<meta name="author" content="freehtml5.co" />

	<!--
	//////////////////////////////////////////////////////

	FREE HTML5 TEMPLATE
	DESIGNED & DEVELOPED by FreeHTML5.co

	Website: 		http://freehtml5.co/
	Email: 			info@freehtml5.co
	Twitter: 		http://twitter.com/fh5co
	Facebook: 		https://www.facebook.com/fh5co

	//////////////////////////////////////////////////////
	 -->

	<!-- Facebook and Twitter integration -->
	<meta property="og:title" content="" />
	<meta property="og:image" content="" />
	<meta property="og:url" content="" />
	<meta property="og:site_name" content="" />
	<meta property="og:description" content="" />
	<meta name="twitter:title" content="" />
	<meta name="twitter:image" content="" />
	<meta name="twitter:url" content="" />
	<meta name="twitter:card" content="" />

	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Roboto+Slab:300,400" rel="stylesheet">

	<!-- Animate.css -->
	<link rel="stylesheet" href="common/css/animate.css">
	<!-- Icomoon Icon Fonts-->
	<link rel="stylesheet" href="common/css/icomoon.css">
	<!-- Bootstrap  -->
	<link rel="stylesheet" href="common/css/bootstrap.css">

	<!-- Magnific Popup -->
	<link rel="stylesheet" href="common/css/magnific-popup.css">

	<!-- Owl Carousel  -->
	<!-- <link rel="stylesheet" href="common/css/owl.carousel.min.css">  -->
	<!-- <link rel="stylesheet" href="common/css/owl.theme.default.min.css">  -->

	<!-- Flexslider  -->
	<link rel="stylesheet" href="common/css/flexslider.css">

	<!-- Pricing -->
	<link rel="stylesheet" href="common/css/pricing.css">

	<!-- Theme style  -->
	<link rel="stylesheet" href="common/css/style.css">
	<link rel="stylesheet" href="common/css/common.css">

	<!-- Theme style  -->
	<link rel="stylesheet" href="common/css/common.css">

	<!-- Modernizr JS -->
	<!-- <script src="common/js/modernizr-2.6.2.min.js"></script> -->
	<!-- FOR IE9 below -->
	<!--[if lt IE 9]>
	<script src="common/js/respond.min.js"></script>
    <![endif]-->



</head>
<body>

	<div class="fh5co-loader"></div>

	<div id="page">
		<nav class="fh5co-nav" role="navigation">
			<div class="top">
				<div class="container">
					<div class="row">
						<div class="col-xs-12 text-right">
							<!-- <p class="num">Call: +01 123 456 7890</p> -->
							<ul class="fh5co-social">
								<li><a href="#"><i class="icon-facebook2"></i></a></li>
								<li><a href="#"><i class="icon-twitter2"></i></a></li>
								<li><a href="#"><i class="icon-dribbble2"></i></a></li>
								<li><a href="#"><i class="icon-github"></i></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
			<div class="top-menu">
				<div class="container">
					<div class="row">
						<div class="col-xs-2">
							<div id="fh5co-logo"><a href="index.php"><i class="icon-study"></i>Educ<span>.</span></a></div>
						</div>
						<div class="col-xs-10 text-right menu-1">
							<ul>
								<li class="active"><a href="index.php">Home</a></li>
								<!-- <li><a href="courses.html">Courses</a></li>
								<li><a href="teacher.html">Teacher</a></li>
								<li><a href="about.html">About</a></li>
								<li><a href="pricing.html">Pricing</a></li> -->
								<li class="has-dropdown">
									<a href="index.php#course">Courses</a>
									<!-- <ul class="dropdown">
										<li><a href="#design">Web Design</a></li>
										<li><a href="#commerce">eCommerce</a></li>
									</ul> -->
								</li>
								<li><a href="contact.php">Contact</a></li>
								<li class="btn-cta"><a href="login.php"><span>Login</span></a></li>
								<li class="btn-cta"><a href="register.php"><span>Register</span></a></li>
							</ul>
						</div>
					</div>

				</div>
			</div>
		</nav>
		<aside id="fh5co-hero">
			<div class="flexslider">
				<ul class="slides">
					<li style="background-image: url(common/images/study.jpg);">
						<!-- <div class="overlay-gradient"></div> -->
						<div class="container">
							<div class="row">
								<div class="col-md-8 col-md-offset-2 text-center slider-text w-100">
									<div class="slider-text-inner">
										<h1 class="text-center">You can learn ONLINE.</h1>
										<!-- <h1>The Roots of Education are Bitter, But the Fruit is Sweet</h1> -->
										<!-- <h2>Brought to you by <a href="http://freehtml5.co/" target="_blank">freehtml5.co</a></h2> -->
										<p><a class="btn btn-primary btn-lg" href="register.php">Start Learning Now!</a></p>
									</div>
								</div>
							</div>
						</div>
					</li>
				</ul>
			</div>
		</aside>

		<div id="fh5co-course">
			<div class="container" id="course">
				<div class="row animate-box">
					<div class="col-md-6 col-md-offset-3 text-center fh5co-heading">
						<h2>Our Course</h2>
						<p>Dignissimos asperiores vitae velit veniam totam fuga molestias accusamus alias autem provident. Odit ab
							aliquam dolor eius.</p>
					</div>
				</div>
				<div class="row">
<?php

$guest_display = new User;
$result = $guest_display->get_courses_guest();

// print_r($result);

if ($result) {
    foreach ($result as $row) {
        $courseID = $row['courseID'];

        echo "<div class='col-sm-4 col-md-4'>";
        echo "<div class='fh5co-blog animate-box'>";
        echo "<a href='selectedcourse.php?courseID=$courseID' class='blog-img-holder' style='background-image: url(" . $row['coursePicture'] . ");'></a>";
        // echo "<a href='article.php' class='blog-img-holder'></a>";
        echo "<div class='blog-text'>";
        echo "<h3><a href='article.php'>" . $row['courseName'] . "</a></h3>";
        echo "<span class='posted_on'>Price: " . $row['coursePrice'] . "PHP</span>";
        echo "<span class='comment'><a href=''>21<i class='icon-speech-bubble'></i></a></span>";
        echo "<p>" . $row['courseDetails'] . "</p>";
        echo "</div></div></div>";

    }
}
?>
				</div>
			</div>
		</div>

		<div id="fh5co-testimonial" style="background-image: url(common/images/school.jpg);">
			<div class="overlay"></div>
			<div class="container">
				<div class="row animate-box">
					<div class="col-md-6 col-md-offset-3 text-center fh5co-heading">
						<h2><span>Testimonials</span></h2>
					</div>
				</div>
				<div class="row">
					<div class="col-md-10 col-md-offset-1">
						<div class="row animate-box">
								<div class="item">
									<div class="testimony-slide active text-center">
										<div class="user" style="background-image: url(common/images/person1.jpg);"></div>
										<span>Mary Walker<br><small>Students</small></span>
										<blockquote>
											<p>&ldquo;Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there
												live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large
												language ocean.&rdquo;</p>
										</blockquote>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
<footer>
			<div class="container">
				<div class="row copyright">
					<div class="col-md-12 text-center p-5">
						<p class="">
							<small class="block">&copy; 2016 Free HTML5. All Rights Reserved.</small>
						</p>
					</div>

				</div>
		</footer>
	</div>

	<div class="gototop js-top">
		<a href="#" class="js-gotop"><i class="icon-arrow-up"></i></a>
	</div>

	<!-- jQuery -->
	<script src="common/js/jquery.min.js"></script>
	<!-- jQuery Easing -->
	<script src="common/js/jquery.easing.1.3.js"></script>
	<!-- Bootstrap -->
	<script src="common/js/bootstrap.min.js"></script>
	<!-- Waypoints -->
	<script src="common/js/jquery.waypoints.min.js"></script>
	<!-- Stellar Parallax -->
	<script src="common/js/jquery.stellar.min.js"></script>
	<!-- Carousel -->
	<script src="common/js/owl.carousel.min.js"></script>
	<!-- Flexslider -->
	<script src="common/js/jquery.flexslider-min.js"></script>
	<!-- countTo -->
	<script src="common/js/jquery.countTo.js"></script>
	<!-- Magnific Popup -->
	<script src="common/js/jquery.magnific-popup.min.js"></script>
	<script src="common/js/magnific-popup-options.js"></script>
	<!-- Count Down -->
	<!-- <script src="common/js/simplyCountdown.js"></script> -->
	<!-- Main -->
	<script src="common/js/main.js"></script>
</body>

</html>
