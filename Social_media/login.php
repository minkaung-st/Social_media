<?php  
	require "functions.php";

	if($_SERVER['REQUEST_METHOD'] == "POST") {
		
		$email = addslashes($_POST['email']);
		$password = addslashes($_POST['password']);

		$query = "select * from users where email = '$email' && password = '$password' limit 1";

		$result = mysqli_query($con,$query);

		if(mysqli_num_rows($result) > 0){

			$row = mysqli_fetch_assoc($result);

			$_SESSION['info'] = $row;
			header("Location: index.php");
		}
		else{
			$error = " Please Try Again ! <br> Email or Password maybe wrong ";
		}
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Social Media / Login</title>
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
								<legend>Login <br><span>To Your Account</span></legend>

								<div class="form-group mt-5">
									<input type="email" name="email" class="form-control" placeholder="Email" required>
								</div>

								<div class="form-group">
									<div class="input-group">
										<input type="password" class="form-control" id="password" name="password"  placeholder="Password" required>
										<div class="input-group-append">
											<span class="input-group-text password-toggle-icon" style="background-color: white; border: none;">
												<i class="far fa-eye"></i>
											</span>
										</div>
									</div>
								</div><br>

								<div class="form-group">
									<button>Login</button>
								</div>

								<!-- this box will be shown if worng login -->
								<div class="text-danger text-center my-5">
									<?php 
											
										if(!empty($error)){
											echo "<div>".$error."</div>";
										}
									?> 
									</div> 

								<div>
									<p><a href="">Forgot password?</a></p><br>
									<hr>
									<p>Don't have an account? <br><a href="signup.php">Create an account</a></p>
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