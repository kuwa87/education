 <?php

include 'common/head.php';
// include '../classes/Course.php';
$courseID = $_GET['courseID'];
$course = new Course;
$row = $course->get_course_by_courseID($courseID);
// echo '1';

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
			   					<h1 class="heading-section">Edit Course</h1>
			   				</div>
			   			</div>
			   		</div>
		   		</div>
		   	</li>
		  	</ul>
	  	</div>
	</aside>

<div class="container">
 <div class="table-wrap pt-5 pb-5">
	            <form action="" method="post" class="p-5" enctype="multipart/form-data">

	    	<div class="form-group editpic">
				<img class="" src="<?php echo $row['coursePicture']; ?>" alt=""><br>
				        <div class="form-group">
                <label>Course Picture</label>
                <input type="file" name="coursepicture">
        </div>
				<input type="submit" value="Save Photo" name="photochange" class="btn btn-primary">
			</div>
			<?php
if (isset($_POST['photochange'])) {
    $courseName = $row['courseName'];

    // file upload
    $target_dir = "../course_images/";
    $target_file = $target_dir . basename($_FILES['coursepicture']['name']);
    $tmp_name = $_FILES['coursepicture']['tmp_name'];

    $register = new Course;
    $register->insertfile($courseName, $target_dir, $target_file, $tmp_name, $courseID);
}
?>
			</form>
           <form action="" method="post" class="p-5">
            <div class="form-group">
            <label for="name">name</label>
            <input type="text" name="courseName" class="form-control" id="name" value="<?php echo $row['courseName']; ?>">
            </div>
            <div class="form-group">
            <label for="adress">courseDetails</label>
            <input type="text" name="courseDetails" class="form-control" id="adress" value="<?php echo $row['courseDetails']; ?>">
            </div>
            <div class="form-group">
            <label for="birthdate">coursePrice</label>
            <input type="text" name="coursePrice" class="form-control" id="coursePrice" value="<?php echo $row['coursePrice']; ?>">
            </div>
            <div class="form-group">
            <label for="loginID">Upload by (Auther loginID)</label>
            <input type="text" name="loginID" class="form-control" id="loginID" value="<?php echo $row['loginID']; ?>">
            </div>
			<input type="hidden" name="courseID" value="<?php echo $row['courseID']; ?>">
			<a href='courses.php' class="btn btn-primary">back to courses</a>
            <input type="submit" value="submit" name="submit" class="btn btn-primary">

            <?php
if (isset($_POST['submit'])) {
    $courseName = $_POST['courseName'];
    $courseDetails = $_POST['courseDetails'];
    $coursePrice = $_POST['coursePrice'];
    $loginID = $_POST['loginID'];
    $courseID = $_POST['courseID'];

    $user = new Course();

    $user->change($courseName, $courseDetails, $coursePrice, $loginID, $courseID);

}
?>

        </form>
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
