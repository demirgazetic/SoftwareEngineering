    <div class="navbar">
			<div class="logo_div">
				<a href="index.php"><img class="logoImg" src="./static/images/logo.png" alt=""></a>
			</div>
			
			<ul>
			<li><a class="active" href="index.php">Home</a></li>
			  <li><a href="#news">News</a></li>
			  <li><a href="#contact">Contact</a></li>
				<li><a href="#about">About</a></li>
			
			
	
		<?php 
		
		 if(isset($_SESSION['user'])){


			if($_SESSION['user']['role'] == "Admin"){
				?>	<li><a href="./admin/dashboard.php">Panel</a></li> <?php
			}
				?> <li class="llogin"><a class="alogin" href="./login.php" style="display:none;">Log in</a></li> <?php
			}
        else {
				?>	<li class="llogin"><a class="alogin" href="./login.php" >Log in</a></li> <?php
        }

?>
	</ul>
		</div>
		<div class="hrColor"> </div>
