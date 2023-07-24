<?php  

	require "functions.php";

	check_login();

	if($_SERVER['REQUEST_METHOD'] == "POST" && !empty($_POST['action']) && $_POST['action'] == 'post_delete')
	{
		//delete your post
		$id = $_GET['id'] ?? 0;
		$user_id = $_SESSION['info']['id'];

		$query = "select * from posts where id = '$id' && user_id = '$user_id' limit 1";
		$result = mysqli_query($con,$query);
		if(mysqli_num_rows($result) > 0){

			$row = mysqli_fetch_assoc($result);
			if(file_exists($row['image'])){
				unlink($row['image']);
			}

		}

		$query = "delete from posts where id = '$id' && user_id = '$user_id' limit 1";
		$result = mysqli_query($con,$query);

		header("Location: profile.php");
	}

	elseif($_SERVER['REQUEST_METHOD'] == "POST" && !empty($_POST['action']) && $_POST['action'] == "post_edit") {
		//post edit
		$id = $_GET['id'] ?? 0;
		$user_id = $_SESSION['info']['id'];

		$image_added = false;
		if(!empty($_FILES['image']['name']) && $_FILES['image']['error'] == 0 && $_FILES['image']['type'] == "image/jpeg"){
			//file was uploaded
			$folder = "uploads/";
			if(!file_exists($folder))
			{
				mkdir($folder,0777,true);
			}

			$image = $folder . $_FILES['image']['name'];
			move_uploaded_file($_FILES['image']['tmp_name'], $image);

				$query = "select * from posts where id = '$id' && user_id = '$user_id' limit 1";
				$result = mysqli_query($con,$query);
				if(mysqli_num_rows($result) > 0){

					$row = mysqli_fetch_assoc($result);
					if(file_exists($row['image'])){
						unlink($row['image']);
					}

				}

			$image_added = true;
		}

		$post = addslashes($_POST['post']);

		if($image_added == true){
			$query = "update posts set post = '$post',image = '$image' where id = '$id' && user_id = '$user_id' limit 1";
		}else{
			$query = "update posts set post = '$post' where id = '$id' && user_id = '$user_id' limit 1";
		}

		$result = mysqli_query($con,$query);
 
		header("Location: profile.php");
	}
	elseif($_SERVER['REQUEST_METHOD'] == "POST" && !empty($_POST['action']) && $_POST['action'] == 'delete')
	{
		//delete your profile
		$id = $_SESSION['info']['id'];
		$query = "delete from users where id = '$id' limit 1";
		$result = mysqli_query($con,$query);

		if(file_exists($_SESSION['info']['image'])){
			unlink($_SESSION['info']['image']);
		}

		$query = "delete from posts where user_id = '$id'";
		$result = mysqli_query($con,$query);

		header("Location: logout.php");

	}
	elseif($_SERVER['REQUEST_METHOD'] == "POST" && !empty($_POST['username']))
	{
		//profile edit
		$image_added = false;
		if(!empty($_FILES['image']['name']) && $_FILES['image']['error'] == 0 && $_FILES['image']['type'] == "image/jpeg"){
			//file was uploaded
			$folder = "uploads/";
			if(!file_exists($folder))
			{
				mkdir($folder,0777,true);
			}

			$image = $folder . $_FILES['image']['name'];
			move_uploaded_file($_FILES['image']['tmp_name'], $image);

			if(file_exists($_SESSION['info']['image'])){
				unlink($_SESSION['info']['image']);
			}

			$image_added = true;
		}

		$username = addslashes($_POST['username']);
		$email = addslashes($_POST['email']);
		$password = addslashes($_POST['password']);
		$id = $_SESSION['info']['id'];

		if($image_added == true){
			$query = "update users set username = '$username',email = '$email',password = '$password',image = '$image' where id = '$id' limit 1";
		}else{
			$query = "update users set username = '$username',email = '$email',password = '$password' where id = '$id' limit 1";
		}

		$result = mysqli_query($con,$query);

		$query = "select * from users where id = '$id' limit 1";
		$result = mysqli_query($con,$query);

		if(mysqli_num_rows($result) > 0){

			$_SESSION['info'] = mysqli_fetch_assoc($result);
		}

		header("Location: profile.php");
	}
	elseif($_SERVER['REQUEST_METHOD'] == "POST" && !empty($_POST['post']))
	{
		//adding post
		$image = "";
		if(!empty($_FILES['image']['name']) && $_FILES['image']['error'] == 0 && $_FILES['image']['type'] == "image/jpeg"){
			//file was uploaded
			$folder = "uploads/";
			if(!file_exists($folder))
			{
				mkdir($folder,0777,true);
			}

			$image = $folder . $_FILES['image']['name'];
			move_uploaded_file($_FILES['image']['tmp_name'], $image);
 
		}

		$post = addslashes($_POST['post']);
		$user_id = $_SESSION['info']['id'];
		$date = date('Y-m-d H:i:s');

		$query = "insert into posts (user_id,post,image,date) values ('$user_id','$post','$image','$date')";

		$result = mysqli_query($con,$query);
 
		header("Location: profile.php");
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Social Media / Profile</title>
</head>
<body>

	<?php require "header.php";?>

		<div class="container">
			<div class="col-md-8 mx-auto">

<!-- DELETE Post -->
			<?php if(!empty($_GET['action']) && $_GET['action'] == 'post_delete' && !empty($_GET['id'])):?>
				
				<?php
					$id = (int)$_GET['id'];
					$query = "select * from posts where id = '$id' limit 1";
					$result = mysqli_query($con,$query);
				?>

				<?php if(mysqli_num_rows($result) > 0):?>
					<?php $row = mysqli_fetch_assoc($result) ?>
					
					<div class="title">Delete Post <br> Are you sure you want to delete this post ?!</div>
					<form method="post" enctype="multipart/form-data">
						
						<div class="delete-post">
							<img src="<?=$row['image']?>"><br><br>

							<div><?=$row['post']?></div><br>

							<input type="hidden" name="action" value="post_delete">

							<button>Delete</button>

							<a href="profile.php">
								<button type="button">Cancel</button>
							</a>
						</div>
					</form>
				<?php endif ?>

<!-- EDIT Post -->
			<?php elseif(!empty($_GET['action']) && $_GET['action'] == 'post_edit' && !empty($_GET['id'])):?>

				<?php 
					$id = (int)$_GET['id'];
					$query = "select * from posts where id = '$id' limit 1";
					$result = mysqli_query($con,$query);
				?>

				<?php if(mysqli_num_rows($result) > 0):?>
					<?php $row = mysqli_fetch_assoc($result) ?>
					
					<div class="title">Edit Post</div>
					<form method="post" enctype="multipart/form-data">

						<div class="edit-post">
							<img src="<?=$row['image']?>"><br><br>

							<div class="form-group">
								Update image <input type="file" name="image" class="form-control py-2">
							</div>

							<div class="form-group">
								<textarea name="post" class="form-control" rows="15"><?=$row['post']?></textarea>
							</div>

							<input type="hidden" name="action" value="post_edit">

							<button>Save</button>

							<a href="profile.php">
								<button type="button">Cancel</button>
							</a>
						</div>
					</form>
				<?php endif ?>

<!-- EDIT Profile -->
			<?php elseif(!empty($_GET['action']) && $_GET['action'] == 'edit'):?>

				<div class="title">Edit profile</div>
				<form method="post" enctype="multipart/form-data" style="margin: auto;padding:10px;">

					<div class="edit-profile">
						<img src="<?php echo $_SESSION['info']['image']?>"><br><br>

						<div class="form-group">
							Change Profile Image <input type="file" name="image" class="form-control py-2">
						</div>

						<div class="form-group">
							<input value="<?php echo $_SESSION['info']['username']?>" type="text" name="username" class="form-control" required>
						</div>
						
						<div class="form-group">
							<input value="<?php echo $_SESSION['info']['email']?>" type="email" name="email" class="form-control" required>
						</div>
						
						<div class="form-group">
							<input value="<?php echo $_SESSION['info']['password']?>" type="text" name="password" class="form-control" required>
						</div>
						
					
						<button>Save</button>
					
						<a href="profile.php">
							<button type="button">Cancel</button>
						</a>
					</div>	
				</form>

<!-- DELETE Profile -->
			<?php elseif(!empty($_GET['action']) && $_GET['action'] == 'delete'): ?>

				<h2 style="text-align: center;">Are you sure you want to delete your profile??</h2>

				<div style="margin: auto;max-width: 600px;text-align: center;">
					<form method="post" style="margin: auto;padding:10px;">
						
						<img src="<?php echo $_SESSION['info']['image']?>">

						<div><?php echo $_SESSION['info']['username']?></div>

						<div><?php echo $_SESSION['info']['email']?></div>

						<input type="hidden" name="action" value="delete">

						<button>Delete</button>

						<a href="profile.php">
							<button type="button">Cancel</button>
						</a>
					</form>
				</div>

<!-- USER Profile -->
			<?php else: ?>

				<div class="title">My Profile</div><br>

				<div class="profile">
					<div>
						<img src="<?php echo $_SESSION['info']['image']?>">
					</div>
					<div>
						<p><?php echo $_SESSION['info']['username']?></p>
					</div>

					<a href="profile.php?action=edit">
						<button>Edit profile</button>
					</a>

					<a href="profile.php?action=delete">
						<button>Delete profile</button>
					</a>
				</div><br>

<!-- CREATE Post -->
				<div class="create-post">Create a post</div>

				<form method="post" enctype="multipart/form-data" style="margin: auto;padding:10px;">
					
					<div class="form-group"> 
						<textarea name="post" class="form-control" cols="15" rows="4" placeholder="What's on your mind ?"></textarea>
					</div>
					<input type="file" name="image"><br><br>

					<button>Post</button>
				</form><br><hr><br>

<!-- POST -->
				<posts>
					<div class="title">My Posts</div>

					<?php
						$id = $_SESSION['info']['id'];
						$query = "select * from posts where user_id = '$id' order by id desc limit 10";

						$result = mysqli_query($con,$query);
					?>

					<?php if(mysqli_num_rows($result) > 0):?>

						<?php while ($row = mysqli_fetch_assoc($result)):?>

							<?php 
								$user_id = $row['user_id'];
								$query = "select username,image from users where id = '$user_id' limit 1";
								$result2 = mysqli_query($con,$query);

								$user_row = mysqli_fetch_assoc($result2);
							?>

							<div class="card mb-4">
								<div class="card-body">
									<div class="row">
										<div class="col-auto"> 
											<img src="<?=$user_row['image']?>" class="img-fluid rounded-circle" width="70">
										</div>

										<div class="col"> 
											<div class="usr">
												<?=$user_row['username']?> <br>
												<?=date("jS M, Y", strtotime($row['date']))?>
											</div>
										</div>

										<div class="option dropdown col">
											<img src="img/dots.png" class="dropdown-toggle" data-bs-toggle="dropdown">
											<div class="dropdown-menu">
												<li>
													<a href="profile.php?action=post_edit&id=<?= $row['id']?>" class="dropdown-item">
														Edit</a>
												</li>
												<li>
													<a href="profile.php?action=post_delete&id=<?= $row['id']?>" class="dropdown-item">
														Delete</a>
												</li>
											</div>
										</div>
									</div><hr>

									<div>
										<?php if(file_exists($row['image'])): ?>
											<img src="<?=$row['image']?>" class="img-fluid mb-2">

										<?php endif ?>
										<?php echo nl2br(htmlspecialchars($row['post'])) ?> <br><br> 
									</div>
								</div>
							</div>

						<?php endwhile ?>
					<?php endif ?>

				</posts>
			<?php endif ?>
			
			</div>
		</div>
	<?php require "footer.php";?>

</body>
</html>