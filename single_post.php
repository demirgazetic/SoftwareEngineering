<?php  include('config.php'); ?>
<?php  include('includes/public_functions.php'); ?>
<?php 
	if (isset($_GET['post-slug'])) {
		$post = getPost($_GET['post-slug']);
	}
	$topics = getAllTopics();
?>
<?php include('includes/head_section.php'); ?>

<?php

require "Geocoding.php";
use myPHPnotes\Geocoding;

$geo = new Geocoding("AIzaSyDAfH0-cIq1lVrxO7EB0ekmM6kqAqZePdM");

$coordinates = $geo->getCoordinates( $post['location'] );


//$var = json_decode($coordinates, true);
$var = implode(" ",$coordinates);
$arr = explode(' ',trim($var));
$latitude = floatval($arr[0]);
$longitude = floatval($arr[1]);

?>


<title> <?php echo $post['title'] ?> | Real Estate</title>
</head>
<body>
<div class="container">
		<?php include( ROOT_PATH . '/includes/navbar.php'); ?>
	
	<div class="content" >
		<div class="post-wrapper">
			<div class="full-post-div">
			<?php if ($post['published'] == false): ?>
				<h2 class="post-title">Sorry... This post has not been published</h2>
			<?php else: ?>
				<h2 class="post-title"><?php echo $post['title']; ?></h2>
				<div class="post-body-div">
			 <img src="<?php echo BASE_URL . '/static/images/' . $post['image']; ?>" class="post_image" alt="">
				</div>
				<div class="post-body-div">
					<?php echo html_entity_decode($post['body']); ?>
				</div>
			<?php endif ?>
			</div>

			<style>
       /* Set the size of the div element that contains the map */
      #map {
        height: 400px;  /* The height is 400 pixels */
        width: 100%;  /* The width is the width of the web page */
       }
    </style>


			<div id="map"></div>

			<script>
		
		function initMap() {
		  // The location of Uluru
		  var latitude  = '<?php echo $latitude;?>';
		   
		  var longitude  = '<?php echo $longitude;?>';
		  
		  var location = {lat: Number(latitude), lng: Number(longitude) };
	
		  // The map, centered at Uluru
		  var map = new google.maps.Map(
			  document.getElementById('map'), {zoom: 17, center: location});
		  // The marker, positioned at Uluru
		  var marker = new google.maps.Marker({position: location, map: map});
		}
		
			</script>
			
			<script 
			src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDAfH0-cIq1lVrxO7EB0ekmM6kqAqZePdM&callback=initMap">
			</script>
			
		</div>

		<div class="post-sidebar">
			<div class="card">
				<div class="card-header">
					<h2>Topics</h2>
				</div>
				<div class="card-content">
					<?php foreach ($topics as $topic): ?>
						<a 
							href="<?php echo BASE_URL . 'filtered_posts.php?topic=' . $topic['id'] ?>">
							<?php echo $topic['name']; ?>
						</a> 
					<?php endforeach ?>
				</div>
			</div>
		</div>
	</div>
</div>

<?php include( ROOT_PATH . '/includes/footer.php'); ?>