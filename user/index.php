 <?php

include 'common/head.php';
include '../classes/Course.php';

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
			   					<h1 class="heading-section">All Courses</h1>
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
<?php

$studentID = $_SESSION['studentID'];
$course = new Course;
$result = $course->get_course();

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
        $result = $user->get_course_not_enrolled($studentID, $courseID);

        if ($result) {
            echo "<a href='course_enroll.php?courseID=$courseID' class='btn btn-primary btn-lg btn-reg'>Enroll</a>";

        } else {
            $c = $user->enrolled_course_index($courseID);
            $courseID = $row['courseID'];
            $ucID = $c['ucID'];
            // print_r($c);
            echo "<a href='course_unenroll.php?ucID=$ucID' class='btn border-primary btn-lg btn-reg'>Unenroll</a>";

        }

        echo "</div></div></div>";

    }
}
?>
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
