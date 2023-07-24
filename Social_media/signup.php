<?php  
	require "functions.php";

	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		$username = addslashes($_POST['username']);
		$email = addslashes($_POST['email']);
		$password = addslashes($_POST['password']);
		$date = date('Y-m-d H:i:s');

		$query = "insert into users (username,email,password,date) values ('$username','$email','$password','$date')";

		$result = mysqli_query($con,$query);

		header("Location: login.php");
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Social Media / Sign up</title>
</head>
<body>

	<?php require "header.php" ?>

	<div class="container my-5">
		<div class="row justify-content-center">
			<div class="col-md-6">
				<div class="card login-card">
					<div class="card-body text-center">

						<form action="" method="post">
							<fieldset>
								<legend>Sign up <br><span>To Use Social Media </span></legend>

								<div class="form-group mt-5">
									<input type="text" name="username" class="form-control" placeholder="Username" required>
								</div>

								<div class="form-group">
									<input type="email" name="email" class="form-control" placeholder="Email" required>
								</div>

								<div class="form-group">
									<div class="input-group">
										<input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
										<div class="input-group-append">
											<span class="input-group-text password-toggle-icon" style="background-color: white; border: none;">
												<i class="far fa-eye"></i>
											</span>
										</div>
									</div>
								</div><br>

								<div class="form-group">
									<button>Sign up</button>
								</div>

								<!-- this box will be shown if worng login -->
								<div class="text-danger text-center my-5"> </div> 

								<div>
									<hr>
									<p>If you have an account <br><a href="login.php">Login here</a></p>
								</div>
							</fieldset>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

	<?php require "footer.php" ?>
	<?php require "showpassword.php" ?>

</body>
</html>