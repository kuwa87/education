<?php
include 'common/head.php';
include_once 'classes/User.php';

// $users = new User;
// $users->logged_in();
?>
<!DOCTYPE html>
<html lang="en">
		<aside class="not-slide">
			<div class="flexslider">
				<ul class="slides">
					<li style="background-image: url(common/images/img_bg_4.jpg);">
						<div class="overlay-gradient"></div>
						<div class="container">
							<div class="row">
								<div class="col-md-8 col-md-offset-2 text-center slider-text">
									<div class="slider-text-inner">
										<h1 class="heading-section">Log-in</h1>
									</div>
								</div>
							</div>
						</div>
					</li>
				</ul>
			</div>
		</aside>


		<div id="fh5co-contact">
			<div class="container">
				<div class="row">
					<div class="col-md-12 form-box">
						<h3>Log-in</h3>
						<form action="" method="post">

							<div class="row form-group">
								<div class="col-md-12">
									<!-- <label for="email">Email</label> -->
									<input type="text" name="email" class="form-control" placeholder="Your email address">
								</div>
							</div>

							<div class="row form-group">
								<div class="col-md-12">
									<!-- <label for="password">Password</label> -->
									<input type="password" name="password" class="form-control" placeholder="Password">
								</div>
							</div>

							<div class="form-group">
								<input type="submit" name="submit" value="Log-in" class="btn btn-primary">
							</div>
						</form>
						<?php
if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    // include_once 'classes/User.php';
    $login = new User;
    $login->login($email, $password);
}
?>
						<a href="register.php">Not registered yet?</a>
					</div>
				</div>

			</div>
		</div>
		<?php
include_once 'common/foot.php';
?>