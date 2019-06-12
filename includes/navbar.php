
<style>


@media screen and (min-width: 769px) and (max-width: 1023px) {
	.navbar {
    display: flex;
    padding: 1rem;
    margin: 0 auto;
    overflow: hidden;
    background-color: #1a2451;
    border-radius: 0px 0px 6px 6px;
	}
	.navbar ul {
     margin-left: 0rem; 
    list-style-type: none;
    float: right;
    padding-top: 8px;
}
}
@media screen and (min-width: 480px) and (max-width: 768px) {.navbar {
    display: flex;
    padding: 1rem;
    margin: 0 auto;
    overflow: hidden;
    background-color: #1a2451;
    border-radius: 0px 0px 6px 6px;
	}
	.navbar ul {
     margin-left: 0rem; 
    list-style-type: none;
    float: right;
    padding-top: 8px;
}} 

@media screen and (min-width: 320px) and (max-width: 479px) {.navbar {
    display: flex;
    padding: 1rem;
    margin: 0 auto;
    overflow: hidden;
    background-color: #1a2451;
    border-radius: 0px 0px 6px 6px;
	}
	.navbar ul {
     margin-left: 0rem; 
    list-style-type: none;
    float: right;
    padding-top: 8px;
}}

@media screen and (max-width: 319px) {.navbar {
    display: flex;
    padding: 1rem;
    margin: 0 auto;
    overflow: hidden;
    background-color: #1a2451;
    border-radius: 0px 0px 6px 6px;
	}
	.navbar ul {
     margin-left: 0rem; 
    list-style-type: none;
    float: right;
    padding-top: 8px;
}}

@media screen and (max-width: 768px) {.navbar {
    display: flex;
    padding: 1rem;
    margin: 0 auto;
    overflow: hidden;
    background-color: #1a2451;
    border-radius: 0px 0px 6px 6px;
	}
	.navbar ul {
     margin-left: 0rem; 
    list-style-type: none;
    float: right;
    padding-top: 8px;
}}



@media screen and (min-width: 1024px) and (max-width: 1215px) { { display: flex;
    padding: 1rem;
    margin: 0 auto;
    overflow: hidden;
    background-color: #1a2451;
    border-radius: 0px 0px 6px 6px;
	}
	.navbar ul {
     margin-left: 0rem; 
    list-style-type: none;
    float: right;
    padding-top: 8px;
}

}


</style>

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
