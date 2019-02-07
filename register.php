<?php
include 'common/head.php';
include_once 'classes/User.php';
?>
	<aside class="not-slide">
		<div class="flexslider">
			<ul class="slides">
		   	<li style="background-image: url(common/images/img_bg_4.jpg);">
		   		<div class="overlay-gradient"></div>
		   		<div class="container">
		   			<div class="row">
			   			<div class="col-md-8 col-md-offset-2 text-center slider-text">
			   				<div class="slider-text-inner">
			   					<h1 class="heading-section">Registeration Form</h1>
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
				<h3>Registeration Form</h3>
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
    // session_start();
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
				<a href="login.php">Already registred?</a>
			</div>
		</div>

	</div>
</div>
<?php
include 'common/foot.php';
?>