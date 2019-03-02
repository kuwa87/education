<?php
include 'common/head.php';
include 'classes/Course.php';
include_once 'classes/Feedback.php';

?>
<aside class="not-slide selectedcourse">
	<div class="flexslider">
		<ul class="slides">
			<li style="background-image: <?php
$course = new Course;
$courseID = $_GET['courseID'];
$row = $course->get_course_by_courseID($courseID);

echo 'url(' . $row['coursePicture'] . ')';?>
;">
				<div class="overlay-gradient"></div>
				<div class="container">
					<div class="row">
						<div class="col-md-8 col-md-offset-2 text-center slider-text">
							<div class="slider-text-inner">
								<h1 class="heading-section">
									<?php
echo $row['courseName'];

?> Course<br>
									<span class="price">
										Price:
										<?php
echo $row['coursePrice'];

?>PHP</span>
<span class="score_etc">


<?php
$feedback_avg = new Feedback;
// $courseID = $_GET['courseID'];
$feedback_avg = $feedback_avg->avarage_feedback($courseID);

if ($feedback_avg) {

    echo "Avarage score" . $feedback_avg . " ";

    if ($feedback_avg == 5) {
        echo '<i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>';
    } elseif ($feedback_avg > 4) {
        echo '<i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i>';
    } elseif ($feedback_avg > 3) {
        echo '<i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i>';
    } elseif ($feedback_avg > 2) {
        echo '<i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i>';
    } elseif ($feedback_avg > 1) {
        echo '<i class="fas fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i>';
    } else {
        echo '';
    }
    echo '( ';
    $feedback_count = new Course;
// $courseID = $_GET['courseID'];
    $feedback_num = $feedback_count->count_feedback_by_courseID($courseID);

    echo ' ratings ) ';

} else {
    echo "This course has not been rated yet.  ";
}

$course_count = new Course;
$courseID = $_GET['courseID'];
$student_num = $course_count->count_usercourse_by_courseID($courseID);

?>
 students enrolled

</span>
								</h1>

							</div>
						</div>
					</div>
				</div>
			</li>
		</ul>
	</div>
</aside>

<div class="container">
	<div class="col-lg-12 col-md-12">
		<div class="fh5co-blog animate-box">

			<div class="blog-text">
				<h3><?php
echo $row['courseName'];
?>
</h3>
				<p><?php
echo $row['courseDetails'];
?></p>
			</div>
		</div>
		<!-- <h2>Materials</h2> -->
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
				</div>
		</footer>
	<!-- </div> -->

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
