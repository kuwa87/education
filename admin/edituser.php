 <?php

include 'common/head.php';
$login_id = $_GET['loginID'];
$user = new User;
$row = $user->get_student_by_loginID($login_id);

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
			   					<h1 class="heading-section">Edit user</h1>
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
           <form action="" method="post" class="p-5">
            <div class="form-group">
            <label for="name">name</label>
            <input type="text" name="studentName" class="form-control" id="name" value="<?php echo $row['studentName']; ?>">
            </div>
            <div class="form-group">
            <label for="adress">adress</label>
            <input type="text" name="studentAdress" class="form-control" id="adress" value="<?php echo $row['studentAdress']; ?>">
            </div>
            <div class="form-group">
            <label for="birthdate">Birth date</label>
            <input type="text" name="studentBirthdate" class="form-control" id="birthdate" value="<?php echo $row['studentBirthdate']; ?>">
            </div>
            <div class="form-group">
            <label for="biography">Biography</label>
            <input type="text" name="studentBiography" class="form-control" id="biography" value="<?php echo $row['studentBiography']; ?>">
            </div>
            <div class="form-group">
            <label for="emailAdress">email</label>
            <input type="text" name="emailAdress" class="form-control" id="emailAdress" value="<?php echo $row['emailAdress']; ?>">
            </div>
            <div class="form-group">
            <label for="password">password</label>
            <input type="text" name="password" class="form-control" id="password" value="<?php echo $row['password']; ?>">
            </div>
            <div class="">
            <label for="password">profilepic</label>
            <input type="file" name="profilepic" id="profilepic" value="<?php echo $row['profilepic']; ?>">
            </div>
            <input type="hidden" name="loginID" value="<?php echo $row['loginID']; ?>">
            <input type="submit" value="submit" name="submit" class="btn btn-primary btn-block">

            <?php
if (isset($_POST['submit'])) {
    $studentName = $_POST['studentName'];
    $studentAdress = $_POST['studentAdress'];
    $studentBirthdate = $_POST['studentBirthdate'];
    $studentBiography = $_POST['studentBiography'];
    $emailAdress = $_POST['emailAdress'];
    $password = $_POST['password'];
    $profilepic = $_POST['profilepic'];
    $loginID = $_POST['loginID'];

    $user = new User();

    $user->change($loginID, $studentName, $studentAdress, $studentBirthdate, $studentBiography, $emailAdress, $password, $profilepic);

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
