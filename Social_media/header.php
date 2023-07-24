
<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

<!-- Fontawesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"> 

<style>

/* NAVIGATION Bar */
label {
	font-size: 30px;
}

/* LOGIN Style */  
.login-card {
    width: 100%;
    max-width: 400px;
    margin: 0 auto;
    padding: 20px;
    border-radius: 5px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    background-color: rgba(137, 50, 109, 0.13);
    border: none;
}
legend {
    font-size: 24px;
    margin-bottom: 20px;
}
legend > span {
    font-size: 18px;
}
.form-group {
    margin-bottom: 20px;
}
.line {
    margin-top: 20px;
    margin-bottom: 20px;
    border: 0;
    border-top: 1px solid #ddd;
}
button {
    background-color: rgba(137, 50, 109, 0.65);
    border: none;
    border-radius: 20px;
    padding: 7px 15px;
    color: white;
}
button:hover {
    background-color: rgba(137, 50, 109, 0.9);
    color: white;
} 

/* USER Profile */
.title {
	font-size: 25px;
	text-align: center;
	margin: 20px 0 50px 0;
}
.profile {
	margin: auto;
	text-align: center;
}
.profile img {
	width: 130px;
	border-radius: 50%;
}
.profile p {
	font-size: 20px;
	margin: 10px 0 20px 0;
}

/* CREATE Post */
.create-post {
	font-size: 25px;
	margin: 20px 0 30px 0;
}

/* EDIT Profile */
.edit-profile img {
	width: 130px;
	border-radius: 50%;
}

/* DELETE Post */	/* EDIT Post */
.delete-post ,
.edit-post {
	margin: 0 0 50px 0;
}
.delete-post img ,
.edit-post img {
	width: 100%;
	border-radius: 20px;
}

/* POST */
.post {
	padding: 15px;
	margin-bottom: 80px;
}
.post-img {
	width: 100%;
	height: 100%;
	border-radius: 20px;
}
.post-owner {
	display: flex;
	margin: 0 0 10px 0;
}
.post-owner-img > img {
	width: 70px;
	border-radius: 50%;
}
.usr {
	margin: 10px 0 0 10px;
}
.option {
	flex-grow: 1; 
    display: flex;
    justify-content: flex-end;
	padding: 10px 10px 0 0;
}
.option img {
	width: 20px;
	height: 20px;
	cursor: pointer;
}
.option img:hover {
	background-color: gray;
	border-radius: 50%;
	padding: 3px;
}


</style>

<!-- Navigation Bar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark"> 
	<div class="container">

		<label class="text-white">Social Media</label>
  
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>

		<div class="collapse navbar-collapse justify-content-end" id="navbarNav"> <!-- Add the class "justify-content-end" to float the nav items to the right -->
			<ul class="navbar-nav">
				<li class="nav-item">
					<a class="nav-link" href="index.php">Home</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="profile.php">Profile</a>
				</li>
				<li class="nav-item disabled">
					<a class="nav-link disabled" href="">Friend</a>
				</li>
				<li class="nav-item disabled">
					<a class="nav-link disabled" href="">Chat</a>
				</li>
				<li class="nav-item disabled">
					<a class="nav-link disabled">||</a>
				</li>

				<?php if(empty($_SESSION['info'])):?>
					<li class="nav-item">
						<a class="nav-link" href="login.php">Login</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="signup.php">Signup</a>
					</li>

				<?php else:?>
					<li class="nav-item">
						<a class="nav-link" href="logout.php">Logout</a>
					</li>

				<?php endif;?>
			</ul>
		</div>
	</div>
</nav>
