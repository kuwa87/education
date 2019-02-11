 <?php

include_once 'common/head.php';
include_once '../classes/Material.php';

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
			   					<h1 class="heading-section">Register material</h1>
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
							<input type="text" name="materialName" class="form-control" placeholder="materialName">
						</div>
					</div>

					<div class="row form-group">
						<div class="col-md-12">
							<!-- <label for="materialDetails">materialDetails</label> -->
							<input type="text" name="materialDetails" class="form-control" placeholder="materialDetails">
						</div>
					</div>
				<div class="form-group">
                <label>Course Picture</label>
                <input type="file" name="materialimage">
		        </div>
				<div class="form-group">
                <label>Course Picture</label>
                <input type="file" name="materialcontent">
		        </div>

					<div class="row form-group">
						<div class="col-md-12">
							<select id="course" name="courseID">
            					<option value="">select course</option>
            <?php
include_once '../classes/Course.php';

$course = new Course;
$result = $course->get_course();
foreach ($result as $row) {
    $courseID = $row['courseID'];
    $courseName = $row['courseName'];
    echo "<option value='$courseID'>$courseName</option>";

}
?>
           					</select>
						</div>
					</div>


					<!-- <div class="row form-group">
						<div class="col-md-12">
							<input type="hidden" name="loginID" class="form-control" value="<php? ?>">
						</div>
					</div> -->

					<div class="form-group">
						<input type="submit" name="submit" value="Sign Up" class="btn btn-primary">
					</div>
				</form>
				<?php
if (isset($_POST['submit'])) {
    $materialName = $_POST['materialName'];
    $materialDetails = $_POST['materialDetails'];
    $courseID = $_POST['courseID'];

    // file upload img
    $target_dir = "../material_images/";
    $target_file = $target_dir . basename($_FILES['materialimage']['name']);
    $tmp_name = $_FILES['materialimage']['tmp_name'];

    // file upload content
    $content_dir = "../material_contents/";
    $content_file = $content_dir . basename($_FILES['materialcontent']['name']);
    $content_tmp_name = $_FILES['materialcontent']['tmp_name'];

    $register = new Material;
    $register->insert($materialName, $materialDetails, $target_dir, $target_file, $tmp_name, $content_dir, $content_file, $content_tmp_name, $courseID);
}

?>

        </form>
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
