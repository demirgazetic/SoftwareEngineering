<div class="header">
	<div class="logo">
		<a href="<?php echo BASE_URL .'admin/dashboard.php' ?>">
			<h1>Real Estate - Admin</h1>
			<div> <a style="color:white; font-size: 1rem;" href="../index.php">Home</a></div>

		</a>
	</div>
	<div class="user-info">
	<span><?php echo $_SESSION['user']['username'] ?></span> &nbsp; &nbsp; 
				<a href="<?php echo BASE_URL . '/logout.php'; ?>" class="logout-btn">logout</a>	</div>

</div>

