 <?php

include_once 'common/head.php';

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
			   					<h1 class="heading-section">Register Course</h1>
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
          <form action="" method="post" enctype="multipart/form-data">
					<div class="row form-group">
						<div class="col-md-12 align-items-center">
							<!-- <label for="name">Name</label> -->
							<input type="text" name="courseName" class="form-control" placeholder="courseName">
						</div>
					</div>

					<div class="row form-group">
						<div class="col-md-12">
							<!-- <label for="courseDetails">courseDetails</label> -->
							<input type="text" name="courseDetails" class="form-control" placeholder="courseDetails">
						</div>
					</div>

					<div class="row form-group">
						<div class="col-md-12">
							<!-- <label for="coursePrice">coursePrice</label> -->
							<input type="text" name="coursePrice" class="form-control" placeholder="coursePrice">
						</div>
					</div>

        <div class="form-group">
                <label>Course Picture</label>
                <input type="file" name="coursepicture">
        </div>

		<div class="row form-group">
			<div class="col-md-12">
			<select id="auther" name="courseID">
            <option value="">Upload by</option>
            <?php
// $course = new Course;
$result = $user->get_teachers();
foreach ($result as $row) {
    // $courseID = $row['courseID'];
    $studentName = $row['studentName'];
    echo "<option value='$loginID'>$studentName</option>";

}
?>
            </select>
			</div>
			</div>

					<div class="form-group">
						<input type="submit" name="submit" value="Sign Up" class="btn btn-primary">
					</div>
				</form>
				<?php
if (isset($_POST['submit'])) {
    $courseName = $_POST['courseName'];
    $courseDetails = $_POST['courseDetails'];
    $coursePrice = $_POST['coursePrice'];

    //get loginID
    $loginID = $_SESSION['loginID'];
    $user = new User;
    $row = $user->echo_student($loginID);

    // file upload
    $target_dir = "../course_images/";
    $target_file = $target_dir . basename($_FILES['coursepicture']['name']);
    $tmp_name = $_FILES['coursepicture']['tmp_name'];

    $register = new Course;
    $register->insert($courseName, $courseDetails, $coursePrice, $target_dir, $target_file, $tmp_name, $loginID);
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
