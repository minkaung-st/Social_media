<?php
	require "functions.php";

	check_login();
?>

<!DOCTYPE html>
<html>
<head>
	<title>Social Media / Home</title>
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>

	<?php require_once "header.php";?>

	<div class="container mt-4">
		<div class="title">T i m e L i n e</div>

		<div class="row justify-content-center">
			<div class="col-md-8">

				<?php $query = "select * from posts order by id desc limit 10";
				$result = mysqli_query($con, $query);?>

				<?php if(mysqli_num_rows($result) > 0): ?>

					<?php while ($row = mysqli_fetch_assoc($result)): ?>

						<?php 
							$user_id = $row['user_id'];
							$query = "select username,image from users where id = '$user_id' limit 1";
							$result2 = mysqli_query($con, $query);
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
								</div><hr>
								<div>
									<?php if(file_exists($row['image'])): ?>
										<img src="<?=$row['image']?>" class="img-fluid mb-2"><br><br>

									<?php endif ?>
									<?php echo nl2br(htmlspecialchars($row['post'])) ?> <br><br> 
								</div>
							</div>
						</div>

					<?php endwhile ?>
				<?php endif ?>
			</div>
		</div>
	</div>

	<?php require "footer.php" ?>

</body>
</html>



