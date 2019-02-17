<?php
include 'common/head.php';
include '../classes/Material.php';
include_once '../classes/Course.php';

?>
<aside class="not-slide">
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
				<h3>
					<?php
echo $row['courseName'];
?>
				</h3>
				<p>
					<?php
echo $row['courseDetails'];
?>
					</span>
				</p>
			</div>
		</div>
		<div>Materials</div>


		<div class="accordion" id="accordionExample">
			<ul class="usermaterial">
				<?php
$courseID = $row['courseID'];
$studentID = $_SESSION['studentID'];
$result = $user->get_course_not_enrolled($studentID, $courseID);

if ($result) {

    echo "<a href='course_enroll.php?courseID=$courseID' class='btn btn-primary btn-lg btn-reg'>Enroll</a>";

} else {

    $course = new User;
    $courseID = $_GET['courseID'];
    $result = $course->get_usercourse_material($courseID, $studentID);

    // print_r($result);

    if ($result) {
        $i = 1;
        foreach ($result as $row) {
            $materialID = $row['materialID'];
            $ucID = $row['ucID'];

            echo '<li class="usermaterial-card card">
	<div class="card-header" id="heading' . $i . '">';

            // here!!!
            $get_material_result = $course->get_each_material($ucID, $materialID);

            if ($get_material_result) {

                $umID = $get_material_result['umID'];
                $umID = $get_material_result['umID'];
                $finished = $course->get_finished_material($umID, $ucID);

                if (false) {
                    echo '<form actuon="" method="post">
					<input type="hidden" name="umID" value="' . $get_material_result['umID'] . '">
					<input type="hidden" name="ucID" value="' . $get_material_result['ucID'] . '">
					<button type="submit" name="finish" class="button status notyet">finish<i class="fas fa-check"></i></button>
					</form>';

                } elseif ($finished['status'] == 'studying') {
                    echo '<div class="button status not-now">not yet</div>';

                } elseif ($finished['status'] == 'finished' && $get_material_result['status'] == 'finished') {
                    echo '<div class="button status done">finished<i class="fas fa-check"></i></div>';

                } elseif ($finished['status'] == 'finished' && $get_material_result['status'] == 'studying') {
                    echo '<form actuon="" method="post">
					<input type="hidden" name="umID" value="' . $get_material_result['umID'] . '">
					<input type="hidden" name="ucID" value="' . $get_material_result['ucID'] . '">
					<button type="submit" name="finish" class="button status notyet">finish<i class="fas fa-check"></i></button>
					</form>';

                } elseif ($get_material_result['status'] == 'finished') {

                    echo '<div class="button status done">finished<i class="fas fa-check"></i></div>';

                } else {
                    echo '<form actuon="" method="post">
					<input type="hidden" name="umID" value="' . $get_material_result['umID'] . '">
					<input type="hidden" name="ucID" value="' . $get_material_result['ucID'] . '">
					<button type="submit" name="finish" class="button status notyet">finish<i class="fas fa-check"></i></button>
					</form>';

                }
            }

            echo '<button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapse' . $i . '" aria-expanded="false" aria-controls="collapse' . $i . '">';

            echo $row['materialName'];
            echo '</button>
    </div>
    <div id="collapse' . $i . '" class="collapse" aria-labelledby="heading' . $i . '" data-parent="#accordionExample">
	  <div class="card-body">';
            echo "<img src=../material_images/" . $row['materialImage'] . " alt=''><br><p>" . $row['materialDetails'];
            echo '</p><a href="material_detail.php?ucID=$ucID" class="btn btn-primary btn-lg btn-reg">View</a>';
            echo '</div></div></li>';
            $i++;

        }
        echo '</ul></div>';
    }

    $c = $user->enrolled_course_index($courseID);
    $courseID = $row['courseID'];
    $ucID = $c['ucID'];
    // print_r($c);
    echo "<a href='course_unenroll.php?ucID=$ucID' class='btn border-primary btn-lg btn-reg'>Unenroll</a>";

    $ucID = $row['ucID'];
    $materialID = $row['materialID'];
    $material_finished = new User;
    $result = $material_finished->check_all_material_finished($ucID);
    if ($result) {

        $status = $row['status'];
        if ($status == 'syudying') {
            echo '
		<form action="" method="post">
	<button type="submit" name="finish_all" class="finish btn btn-primary btn-lg btn-reg">finish the course<i class="fas fa-check"></i></button>
	</form>

	';
        } else {
            echo '
    <div class="btn not-now btn-lg btn-reg">Already Finished!</div>';
        }

    } else {
        echo '
	<div class="btn not-now btn-lg btn-reg">Finish all the material first</div>';
    }
}

if (isset($_POST['finish'])) {
    // echo 'aaaa';
    $umID = $_POST['umID'];
    $ucID = $_POST['ucID'];
    $material = new User;
    $result = $material->change_material_status($umID, $ucID);

}

if (isset($_POST['finish_all'])) {

    $ucID = $row['ucID'];
    $course_finish = new User;
    $result = $course_finish->change_course_status($ucID);
    if ($result) {
        echo '
        <form>
    <button type="submit" name="finish_all" class="finish btn btn-primary btn-lg btn-reg">You completed!<i class="fas fa-check"></i></button>
    </form>

    ';
    } else {
        echo '
    <div class="btn not-now btn-lg btn-reg">Finish the course</div>';
    }

}

?>


</div></div></div>

								<!-- <a href="course.php" class="btn border-primary btn-lg btn-reg">Enrolled</a> -->

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