<?php
include 'common/head.php';
include '../classes/Material.php';
include_once '../classes/Course.php';
include_once '../classes/Feedback.php';

?>
<aside class="not-slide selectedcourse">
	<div class="flexslider">
		<ul class="slides">
			<li style="background-image: <?php
$course = new Course;
$courseID = $_GET['courseID'];
$row = $course->get_course_by_courseID($courseID);

echo 'url(../' . $row['coursePicture'] . ')';?>
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
    } elseif ($$feedback_avg > 1) {
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
        <div class="animate-box blog
        ">
		<!-- <div class="fh5co-blog animate-box"> -->

			<div class="blog-text">
				<h2>
					<?php
// echo $row['courseName'];
?>
				</h2>
				<p class="intro-text">
					<?php
echo $row['courseDetails'];
?>
					</span>
				</p>
			</div>
		</div>



		<div class="accordion" id="accordionExample">
			<ul class="usermaterial">
				<?php
//申し込みしてないコースを選択
$courseID = $row['courseID'];
$studentID = $_SESSION['studentID'];
$result = $user->get_course_not_enrolled($studentID, $courseID);

if ($result) {
    $studentID = $_SESSION['studentID'];
    $result_limit = $user->course_limit($studentID);

    //コースリミット範囲内
    if ($result_limit) {
        echo "<a href='index.php' class='btn btn-primary btn-lg btn-reg'>Back to the list</a>";
        echo "<a href='course_enroll.php?courseID=$courseID' class='btn btn-primary btn-lg btn-reg'>Enroll</a>";
    } else {

        //コースリミット範囲外
        echo "<a href='index.php' class='btn btn-primary btn-lg btn-reg'>Back to the list</a>";
        echo "<div class='btn btn-white border-primary btn-lg btn-reg notyet'>You cannot enroll now</div>";

    }
} else {

    echo '<h2>Materials</h2>';

    //usercourse materialを表示
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

            // materialを個別に取得
            $get_material_result = $course->get_each_material($ucID, $materialID);

            if ($get_material_result) {

                $umID = $get_material_result['umID'];
                $umID = $get_material_result['umID'];
                $finished = $course->get_finished_material($umID, $ucID);

                //form
                if (false) {
                    echo '<form actuon="" method="post">
					<input type="hidden" name="umID" value="' . $get_material_result['umID'] . '">
					<input type="hidden" name="ucID" value="' . $get_material_result['ucID'] . '">
					<button type="submit" name="finish" class="button status notyet">finish<i class="fas fa-check"></i></button>
					</form>';

                    //status が studyingかどうかをチェック
                } elseif ($finished['mt_status'] == 'studying') {
                    echo '<div class="button status not-now">not yet</div>';

                } elseif ($finished['mt_status'] == 'finished' && $get_material_result['mt_status'] == 'finished') {
                    echo '<div class="button status done">finished<i class="fas fa-check"></i></div>';

                } elseif ($finished['mt_status'] == 'finished' && $get_material_result['mt_status'] == 'studying') {
                    echo '<form actuon="" method="post">
					<input type="hidden" name="umID" value="' . $get_material_result['umID'] . '">
					<input type="hidden" name="ucID" value="' . $get_material_result['ucID'] . '">
					<button type="submit" name="finish" class="button status notyet">finish<i class="fas fa-check"></i></button>
					</form>';

                } elseif ($get_material_result['mt_status'] == 'finished') {

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
            echo "</p><a href='../material_contents/" . $row['materialContent'] . " ' target='_blank' class='btn btn-primary btn-lg btn-reg'>View</a>";

            echo '</p><a href="../material_contents/" ' . $row['materialContent'] . ' "  target="_blank" class="btn btn-primary btn-lg btn-reg">View</a>';
            echo '</div></div></li>';
            $i++;

        }
        echo '</ul></div>';
    }

    //update course button
    $new_material = new User;
    $result_new = $new_material->count_new_material($courseID, $ucID);
    if ($result_new) {
        echo '
        <div class="update-course">
		<form method="post" aciton="">
		<button type="submit" name="update">Update Course</button>
        </form>
        </div>
		';
    }

    $c = $user->enrolled_course_index($courseID);
    $courseID = $row['courseID'];
    $ucID = $c['ucID'];
    // print_r($c);

    //unenrollする
    echo "<a href='index.php' class='btn btn-primary btn-lg btn-reg'>Back to the list</a>";
    echo "<a href='course_unenroll.php?ucID=$ucID' class='btn border-primary btn-lg btn-reg'>Unenroll</a>";

    // $materialID = $c['materialID'];
    $material_finished = new User;
    $result = $material_finished->check_all_material_finished($ucID);
    if ($result) {

        $status = $result['status'];
        if ($status == 'studying') {
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

if (isset($_POST['update'])) {

    $update = new User;
    $result = $update->update_my_course($courseID, $ucID);
    // echo $courseID . "<br>";
    // echo $ucID;
}

?>


<!-- </div> -->
</div>

<div class="col-lg-12 col-md-12" id="review-box">
	<h2>Reviews</h2>

	<?php

//reviewを書き終わっているかを確認
$check_feedback = new Feedback;
$result_check = $check_feedback->check_feedback($studentID, $courseID);
if ($result_check) {
    echo '<p>Thank you for your feedback!</p>';

} else {
    //reviewを書く
    echo '	<h3>Write a review</h3>
          <form action="" method="post" enctype="multipart/form-data">
					<div class="row form-group">
						<div class="col-md-12">
						<label for="birthdate">Rating:</label>
							<select id="course" name="rating">
								<option value="5">5</option>
								<option value="4">4</option>
								<option value="3">3</option>
								<option value="2">2</option>
								<option value="1">1</option>
           					</select>
						</div>
					</div>

					<div class="row form-group">
						<div class="col-md-12">
							<label for="birthdate">Message</label>
							<input type="text" name="message" class="form-control" placeholder="Your message here">
						</div>
					</div>

					<div class="form-group">
						<input type="submit" name="review" value="Submit" class="btn btn-primary">
					</div>
				</form>



	';
}
//投稿済みのreviewをみる
echo '
	<h3>Check Reviews</h3>
';
$courseID = $_GET['courseID'];
$get_feedback = new Feedback;
$result_feedback = $get_feedback->get_feedback($courseID);
if ($result_feedback) {
    // print_r($result_feedback);
    foreach ($result_feedback as $row) {
        echo '

		<div class="card review-box" class="w-100 border-primary">
		  <h4><span class="studentpic"><img src="../' . $row['studentPicture'] . '" class="studentpic"></span>'
            . $row['studentName'] . '</h4>
		<span class="time">' . $row['dateAdded'] . '</span>
  <div class="card-body">
  <span>';
        if ($row['rating'] == 5) {
            echo '<i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>';
        } elseif ($row['rating'] == 4) {
            echo '<i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i>';
        } elseif ($row['rating'] == 3) {
            echo '<i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i>';
        } elseif ($row['rating'] == 2) {
            echo '<i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i>';
        } elseif ($row['rating'] == 1) {
            echo '<i class="fas fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i>';
        } else {
            echo '<i class="fas fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i>';
        }

        echo '
   </span>
    <p class="card-text">' . $row['message'] . '</p>
  </div>
</div>



		';
    }

} else {
    echo 'No reviews yet.';
}

?>

				<?php
if (isset($_POST['review'])) {
    $rating = $_POST['rating'];
    $message = $_POST['message'];
    $studentID = $_SESSION['studentID'];
    $courseID = $_GET['courseID'];

    $feedback = new Feedback;
    $feedback->insert_feedback($rating, $message, $studentID, $courseID);
}

?>

        </form>
</div>
</div>

</div>

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