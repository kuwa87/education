 <?php
include 'common/head.php';

?>
	<aside class="not-slide">
		<div class="flexslider">
			<ul class="slides">
		   	<li style="background-image: url(../common/images/img_bg_4.jpg);">
		   		<div class="overlay-gradient"></div>
		   		<div class="container">
		   			<div class="row">
			   			<div class="col-md-8 col-md-offset-2 text-center slider-text">
			   				<div class="slider-text-inner">
			   					<h1 class="heading-section">Your Course</h1>
			   				</div>
			   			</div>
			   		</div>
		   		</div>
		   	</li>
		  	</ul>
	  	</div>
	</aside>

			<div class="container">
				<div class="row">
				<div class="row">
<?php

$course = new Course;
$result = $course->get_course();

// print_r($result);

if ($result) {
    foreach ($result as $row) {
        $courseID = $row['courseID'];

        echo "<div class='col-lg-4 col-md-4'>";
        echo "<div class='fh5co-blog animate-box'>";
        echo "<a href='article.php' class='blog-img-holder' style='background-image: url(" . $row['coursePicture'] . ");'></a>";
        // echo "<a href='article.php' class='blog-img-holder'></a>";
        echo "<div class='blog-text'>";
        echo "<h3><a href='article.php'>" . $row['courseName'] . "</a></h3>";
        echo "<span class='posted_on'>" . $row['coursePrice'] . "</span>";
        echo "<span class='comment'><a href=''>21<i class='icon-speech-bubble'></i></a></span>";
        echo "<p>" . $row['courseDetails'] . "</p>";
        echo "</div></div></div>";

    }
}
?>

</div>


					<!-- <div class="col-md-6 animate-box">
						<div class="course">
							<a href="#" class="course-img" style="background-image: url(../common/images/project-1.jpg);">
							</a>
							<div class="desc" id="design">
								<h3><a href="#">Web Master</a></h3>
								<p>Dignissimos asperiores vitae velit veniam totam fuga molestias accusamus alias autem provident. Odit ab
									aliquam dolor eius molestias accusamus alias autem provident. Odit ab aliquam dolor eius.</p>
								<span><a href="#" class="btn btn-primary btn-sm btn-course">Enter</a></span>
							</div>
						</div>
					</div> -->
				</div>
			</div>
		</div>

		<div id="fh5co-testimonial" style="background-image: url(../common/images/school.jpg);">
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
										<div class="user" style="background-image: url(../common/images/person1.jpg);"></div>
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
	<script src="../common/js/jquery.min.js"></script>
	<!-- jQuery Easing -->
	<script src="../common/js/jquery.easing.1.3.js"></script>
	<!-- Bootstrap -->
	<script src="../common/js/bootstrap.min.js"></script>
	<!-- Waypoints -->
	<script src="../common/js/jquery.waypoints.min.js"></script>
	<!-- Stellar Parallax -->
	<script src="../common/js/jquery.stellar.min.js"></script>
	<!-- Carousel -->
	<script src="../common/js/owl.carousel.min.js"></script>
	<!-- Flexslider -->
	<script src="../common/js/jquery.flexslider-min.js"></script>
	<!-- countTo -->
	<script src="../common/js/jquery.countTo.js"></script>
	<!-- Magnific Popup -->
	<script src="../common/js/jquery.magnific-popup.min.js"></script>
	<script src="../common/js/magnific-popup-options.js"></script>
	<!-- Count Down -->
	<!-- <script src="../common/js/simplyCountdown.js"></script> -->
	<!-- Main -->
	<script src="../common/js/main.js"></script>
</body>

</html>