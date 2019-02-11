 <?php

include 'common/head.php';
include '../classes/Material.php';
$materialID = $_GET['materialID'];
$material = new Material;
$row = $material->get_material_by_materialID($materialID);

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
			   					<h1 class="heading-section">Edit Material</h1>
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
				<img class="" src="<?php echo $row['materialImages']; ?>" alt=""><br>
				        <div class="form-group">
                <label>Material Images</label>
                <input type="file" name="materialImages">
        </div>
				<input type="submit" value="Save Photo" name="photochange" class="btn btn-primary">
			</div>
			<?php
if (isset($_POST['photochange'])) {
    $materialName = $row['materialName'];

    // file upload
    $target_dir = "../material_Imagess/";
    $target_file = $target_dir . basename($_FILES['materialImages']['name']);
    $tmp_name = $_FILES['materialImages']['tmp_name'];

    $register = new Material;
    $register->insertfile($courseName, $target_dir, $target_file, $tmp_name, $materialID);
}
?>
			</form>
			<form action="" method="post" class="p-5" enctype="multipart/form-data">

	    	<div class="form-group editpic">
				<img class="" src="<?php echo $row['materialContent']; ?>" alt=""><br>
				        <div class="form-group">
                <label>Material Content</label>
                <input type="file" name="materialContent">
        </div>
				<input type="submit" value="Save Photo" name="photochange" class="btn btn-primary">
			</div>
			<?php
if (isset($_POST['photochange'])) {
    $materialName = $row['materialName'];

    // file upload
    $target_dir = "../material_contents/";
    $target_file = $target_dir . basename($_FILES['materialContent']['name']);
    $tmp_name = $_FILES['materialContent']['tmp_name'];

    $register = new Material;
    $register->insertfile($courseName, $target_dir, $target_file, $tmp_name, $materialID);
}
?>
			</form>
           <form action="" method="post" class="p-5">
            <div class="form-group">
            <label for="name">name</label>
            <input type="text" name="materialName" class="form-control" id="name" value="<?php echo $row['materialName']; ?>">
            </div>
            <div class="form-group">
            <label for="adress">materialDetails</label>
            <input type="text" name="materialDetails" class="form-control" id="adress" value="<?php echo $row['materialDetails']; ?>">
            </div>
					<div class="row form-group">
						<div class="col-md-12">
							<select id="course" name="courseID">
            					<!-- <option value="">select course</option> -->
            <?php
include_once '../classes/Course.php';

$course = new Course;
$result = $course->get_course();
foreach ($result as $rows) {
    $courseID = $rows['courseID'];
    $courseName = $rows['courseName'];
    ?>
   <option value='<?php echo $courseID; ?>'<?php if ($courseID == $row['courseID']) {
        echo 'selected';
    }
    ?>><?php echo $courseName; ?></option>
<?php
}
?>
           					</select>
						</div>
					</div>
			<input type="hidden" name="materialID" value="<?php

$materialID = $_GET['materialID'];
$material = new Material;
$row = $material->get_material_by_materialID($materialID);

echo $row['materialID'];?>">
            <input type="submit" value="submit" name="submit" class="btn btn-primary btn-block">

            <?php
if (isset($_POST['submit'])) {
    $materialName = $_POST['materialName'];
    $materialDetails = $_POST['materialDetails'];
    $courseID = $_POST['courseID'];
    $materialID = $_POST['materialID'];

    $material = new Material();

    $material->change($materialName, $materialDetails, $courseID, $materialID);

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
