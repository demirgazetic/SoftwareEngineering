<?php 
// Post variables
$post_id = 0;
$isEditingPost = false;
$published = 0;
$title = "";
$post_slug = "";
$body = "";
$featured_image = "";
$post_topic = "";

/* - - - - - - - - - - 
-  Post functions
- - - - - - - - - - -*/
// get all posts from DB
function getAllPosts()
{
	global $conn;
	

	if ($_SESSION['user']['role'] == "Admin") {
		$sql = "SELECT * FROM posts";
	} elseif ($_SESSION['user']['role'] == "Author") {
		$user_id = $_SESSION['user']['id'];
		$sql = "SELECT * FROM posts WHERE user_id=$user_id";
	}
	$result = mysqli_query($conn, $sql);
	$posts = mysqli_fetch_all($result, MYSQLI_ASSOC);

	$final_posts = array();
	foreach ($posts as $post) {
		$post['author'] = getPostAuthorById($post['user_id']);
		array_push($final_posts, $post);
	}
	return $final_posts;
}
function getPostAuthorById($user_id)
{
	global $conn;
	$sql = "SELECT username FROM users WHERE id=$user_id";
	$result = mysqli_query($conn, $sql);
	if ($result) {
		return mysqli_fetch_assoc($result)['username'];
	} else {
		return null;
	}
}


/* - - - - - - - - - - 
-  Post actions
- - - - - - - - - - -*/
// create post button
if (isset($_POST['create_post'])) { createPost($_POST); }
//  Edit post button
if (isset($_GET['edit-post'])) {
	$isEditingPost = true;
	$post_id = $_GET['edit-post'];
	editPost($post_id);
}
// update post button
if (isset($_POST['update_post'])) {
	updatePost($_POST);
}
//  Delete post button
if (isset($_GET['delete-post'])) {
	$post_id = $_GET['delete-post'];
	deletePost($post_id);
}

/* - - - - - - - - - - 
-  Post functions
- - - - - - - - - - -*/


function createPost($request_values)
	{
		global $conn, $errors, $title, $location, $featured_image, $topic_id, $body, $published;
		$title = ($request_values['title']);
		$location = ($request_values['location']);
		$body = htmlentities(($request_values['body']));
		if (isset($request_values['topic_id'])) {
			$topic_id = ($request_values['topic_id']);
		}
		if (isset($request_values['publish'])) {
			$published = ($request_values['publish']);
		}
	 $slug = strtolower($title);
	 $post_slug = preg_replace('/[^A-Za-z0-9-]+/', '-', $slug);
		if (empty($title)) { array_push($errors, "Post title is required"); }
		if (empty($location)) { array_push($errors, "Post location is required"); }
		if (empty($body)) { array_push($errors, "Post body is required"); }
		if (empty($topic_id)) { array_push($errors, "Post topic is required"); }
	  	$featured_image = $_FILES['featured_image']['name'];
	  	if (empty($featured_image)) { array_push($errors, "Featured image is required"); }
	  	$target = "../static/images/" . basename($featured_image);
	  	if (!move_uploaded_file($_FILES['featured_image']['tmp_name'], $target)) {
	  		array_push($errors, "Failed to upload image. Please check file settings for your server");
	  	}
		$post_check_query = "SELECT * FROM posts WHERE slug='$post_slug' LIMIT 1";
		$result = mysqli_query($conn, $post_check_query);

		if (mysqli_num_rows($result) > 0) { // if post exists
			array_push($errors, "A post already exists with that title.");
		}
	
$id = $_SESSION['user']['id'] ;
$number = $_SESSION['user']['number'] ;



		


		// create post if there are no errors in the form
		if (count($errors) == 0) {
			
			$query = "INSERT INTO posts (user_id,number, title, location, slug, image, body, published, created_at, updated_at) 
			VALUES('$id', '$number' ,'$title','$location', '$post_slug', '$featured_image', '$body', $published, now(), now())";
			if(mysqli_query($conn, $query)){ // if post created successfully
				$inserted_post_id = mysqli_insert_id($conn);
				$randID = rand(1,2000);
				// create relationship between post and topic
				$sql = "INSERT INTO post_topic (id,post_id, topic_id) VALUES('$randID','$inserted_post_id', '$topic_id')";
				mysqli_query($conn, $sql);

				$_SESSION['message'] = "Post created successfully";
				header('location: posts.php');
				exit(0);
			}
		}
	}


	function editPost($role_id)
	{
		global $conn, $title, $post_slug, $body, $published, $isEditingPost, $post_id;
		$sql = "SELECT * FROM posts WHERE id=$role_id LIMIT 1";
		$result = mysqli_query($conn, $sql);
		$post = mysqli_fetch_assoc($result);
		$title = $post['title'];
		$body = $post['body'];
		$published = $post['published'];
	}

	function updatePost($request_values)
	{
		global $conn, $errors, $post_id, $title, $featured_image, $topic_id, $body, $published;

		$title = ($request_values['title']);
		$body = ($request_values['body']);
		$post_id = ($request_values['post_id']);
		if (isset($request_values['topic_id'])) {
			$topic_id = ($request_values['topic_id']);
		}
        
		 $post_slug = strtolower($title);

		if (empty($title)) { array_push($errors, "Post title is required"); }
		if (empty($body)) { array_push($errors, "Post body is required"); }
		if (isset($_POST['featured_image'])) {
		  	$featured_image = $_FILES['featured_image']['name'];
		  	$target = "../static/images/" . basename($featured_image);
		  	if (!move_uploaded_file($_FILES['featured_image']['tmp_name'], $target)) {
		  		array_push($errors, "Failed to upload image. Please check file settings for your server");
		  	}
		}

		if (count($errors) == 0) {
			$query = "UPDATE posts SET title='$title', slug='$post_slug', views=0, image='$featured_image', body='$body', published=$published, updated_at=now() WHERE id=$post_id";
			if(mysqli_query($conn, $query)){ // if post created successfully
				if (isset($topic_id)) {
					$inserted_post_id = mysqli_insert_id($conn);
					$sql = "INSERT INTO post_topic (post_id, topic_id) VALUES($inserted_post_id, $topic_id)";
					mysqli_query($conn, $sql);
					$_SESSION['message'] = "Post created successfully";
					header('location: posts.php');
					exit(0);
				}
			}
			$_SESSION['message'] = "Post updated successfully";
			header('location: posts.php');
			exit(0);
		}
	}
	// delete blog post
	function deletePost($post_id)
	{
		global $conn;
		$sql = "DELETE FROM posts WHERE id=$post_id";
		if (mysqli_query($conn, $sql)) {
			$_SESSION['message'] = "Post successfully deleted";
			header("location: posts.php");
			exit(0);
		}
    }
    
    // if- publish post button
if (isset($_GET['publish']) || isset($_GET['unpublish'])) {
	$message = "";
	if (isset($_GET['publish'])) {
		$message = "Post published successfully";
		$post_id = $_GET['publish'];
	} else if (isset($_GET['unpublish'])) {
		$message = "Post successfully unpublished";
		$post_id = $_GET['unpublish'];
	}
	togglePublishPost($post_id, $message);
}
// delete blog post
function togglePublishPost($post_id, $message)
{
	global $conn;
	$sql = "UPDATE posts SET published=!published WHERE id=$post_id";
	
	if (mysqli_query($conn, $sql)) {
		$_SESSION['message'] = $message;
		header("location: posts.php");
		exit(0);
	}
}
?>

