 <?php

include 'common/head.php';

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
			   					<h1 class="heading-section">Register user</h1>
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
							<input type="text" name="name" class="form-control" placeholder="Your name">
						</div>
					</div>

					<div class="row form-group">
						<div class="col-md-12">
							<!-- <label for="adress">Adress</label> -->
							<input type="text" name="adress" class="form-control" placeholder="Your address">
						</div>
					</div>

					<div class="row form-group">
						<div class="col-md-12">
							<label for="birthdate">Birth date</label>
							<input type="date" name="birthdate" class="form-control" placeholder="Your birth date">
						</div>
					</div>

					<div class="row form-group">
						<div class="col-md-12">
							<!-- <label for="email">Email</label> -->
							<input type="text" name="email" class="form-control" placeholder="Your email address">
						</div>
					</div>

					<div class="row form-group">
						<div class="col-md-12">
							<!-- <label for="password">Password</label> -->
							<input type="text" name="password" class="form-control" placeholder="Password">
						</div>
					</div>

					<div class="row form-group">
						<div class="col-md-12">
							<!-- <label for="conpass">Confirm Password</label> -->
							<input type="text" name="conpass" class="form-control" placeholder="Confirm password">
						</div>
					</div>

          <div class="form-group">
                <label>Photo</label>
                <input type="file" name="profilepic">
            </div>
					<div class="form-group">
						<input type="submit" name="submit" value="Sign Up" class="btn btn-primary">
					</div>
				</form>
				<?php
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $adress = $_POST['adress'];
    $birthdate = $_POST['birthdate'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $conpass = $_POST['conpass'];
    // $picture = $_POST['picture'];

//file upload
    $target_dir = "user_images/";
    $target_file = $target_dir . basename($_FILES['profilepic']['name']);
    $tmp_name = $_FILES['profilepic']['tmp_name'];

    $register = new User;
    $register->insert($name, $adress, $birthdate, $email, $password, $conpass, $target_dir, $target_file, $tmp_name);
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
