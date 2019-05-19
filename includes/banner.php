<?php if (isset($_SESSION['user']['username'])) { ?>

	<div class="logged_in_info">
		<span>welcome <?php echo $_SESSION['user']['username'] ?></span>
		|
		<span><a href="logout.php">logout</a></span>

	</div>

<?php }else{ ?>
	<div class="banner">
		<div class="welcome_msg">
			
			<a href="register.php" class="btn btnJoin">Join us!</a>
		</div>
		

		
	</div>
<?php } ?>