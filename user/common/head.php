<?php
session_start();
include_once '../classes/User.php';
$user = new User;
// $user->login_required();

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
	<link rel="stylesheet" href="../common/css/animate.css">
	<!-- Icomoon Icon Fonts-->
	<link rel="stylesheet" href="../common/css/icomoon.css">
	<!-- Bootstrap  -->
	<link rel="stylesheet" href="../common/css/bootstrap.css">

	<!-- Magnific Popup -->
	<link rel="stylesheet" href="../common/css/magnific-popup.css">

	<!-- Owl Carousel  -->
	<!-- <link rel="stylesheet" href="../common/css/owl.carousel.min.css">  -->
	<!-- <link rel="stylesheet" href="../common/css/owl.theme.default.min.css">  -->

	<!-- Flexslider  -->
	<link rel="stylesheet" href="../common/css/flexslider.css">

	<!-- Pricing -->
	<link rel="stylesheet" href="../common/css/pricing.css">

	<!-- Theme style  -->
	<link rel="stylesheet" href="../common/css/style.css">
	<link rel="stylesheet" href="../common/css/common.css">

	<!-- Theme style  -->
	<link rel="stylesheet" href="../common/css/common.css">

	<!-- Modernizr JS -->
	<!-- <script src="../common/js/modernizr-2.6.2.min.js"></script> -->
	<!-- FOR IE9 below -->
	<!--[if lt IE 9]>
	<script src="../common/js/respond.min.js"></script>
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
								<li>Welcome
								<?php
$loginID = $_SESSION['loginID'];
$user = new User;
$row = $user->echo_student($loginID);
echo $row['studentName'];

?></li>
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
								<li><a href="index.php">Home</a></li>
								<li><a href="courses.php">Courses</a></li>
								<li><a href="materials.php">Materials</a></li>
								<li class="has-dropdown">
									<a href="">Select Materials</a>
									<ul class="dropdown">
										<!-- <li><a href="#design">Web Design</a></li>
										<li><a href="#commerce">eCommerce</a></li> -->
										<?php
include_once '../classes/Course.php';
$course = new Course;
$result = $course->get_course();
foreach ($result as $row) {
    $courseID = $row['courseID'];
    $courseName = $row['courseName'];
    echo "<li><a class='dropdown-item' href='selectedcourse.php?courseID=$courseID'>" . $row['courseName'] . "</a></li>";
}
?>
									</ul>
								</li>
								<!-- <li><a href="contact.php">Contact</a></li> -->
								<li class="btn-cta"><a href="register.php"><span>Edit profile</span></a></li>
								<li class="btn-cta"><a href="logout.php"><span>Logout</span></a></li>
							</ul>
						</div>
					</div>

				</div>
				</div>
		</nav>