 <?php

include 'common/head.php';
include '../classes/Material.php';

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
			   					<h1 class="heading-section">
								   <?php
$course = new Course;
$courseID = $_GET['courseID'];
$row = $course->get_course_by_courseID($courseID);
echo $row['courseName'];

?> Course Materials
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
 <div class="table-wrap pt-5 pb-5 wide-table">
                 <table class="table">
            <thead>
                <tr>
                    <th>material<br>ID</th>
                    <th>material<br>Name</th>
                    <th>material<br>Details</th>
                    <th>Course<br>Name</th>
                    <th>action</th>
                </tr>
            </thead>
            <tbody>
<?php
// $loginID = $_SESSION['loginID'];

// $material = new Material;
// $result = $material->get_material();
// print_r($result);

$course = new Material;
$courseID = $_GET['courseID'];
$result = $course->get_material_by_course($courseID);

if ($result) {
    foreach ($result as $row) {
        $materialID = $row['materialID'];

        echo "<tr>";
        echo "<td>" . $row['materialID'] . "</td>";
        echo "<td>" . $row['materialName'] . "</td>";
        echo "<td>" . $row['materialDetails'] . "</td>";
        echo "<td>" . $row['courseName'] . "</td>";
        echo "<td>
<a href='editmaterial.php?materialID=$materialID&action=1' class='btn btn-sm btn-success'>Edit</a> <a href='deleteMaterial.php?materialID=$materialID&action=3' class='btn btn-sm btn-danger text-white'>Delete</a></td>";
        echo "</tr>";
    }
}

?>
            </tbody>
        </table>
        <a href="creatematerial.php" class="btn btn-primary">Add Materials</a>
        <a href="materials.php" class="btn btn-primary">View All Courses</a>
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
