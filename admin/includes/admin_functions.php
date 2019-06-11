<?php 
$admin_id = 0;
$isEditingUser = false;
$username = "";
$role = "";
$email = "";
$errors = [];


if (isset($_POST['create_admin'])) {
	createAdmin($_POST);
}
// if user clicks the Edit admin button
if (isset($_GET['edit-admin'])) {
	$isEditingUser = true;
	$admin_id = $_GET['edit-admin'];
	editAdmin($admin_id);
}
// if user clicks the update admin button
if (isset($_POST['update_admin'])) {
	updateAdmin($_POST);
}
// if user clicks the Delete admin button
if (isset($_GET['delete-admin'])) {
	$admin_id = $_GET['delete-admin'];
	deleteAdmin($admin_id);
}



function createAdmin($request_values){
	global $conn, $errors, $role, $username, $email, $number;
	$username = ($request_values['username']);
	$email = ($request_values['email']);
	$number =($request_values['number']);
	$password = ($request_values['password']);
	$passwordConfirmation = ($request_values['passwordConfirmation']);

	if(isset($request_values['role'])){
		$role = ($request_values['role']);
	}
	if (empty($username)) { array_push($errors, "Uhmm...We gonna need the username"); }
	if (empty($email)) { array_push($errors, "Oops.. Email is missing"); }
	if (empty($number)) { array_push($errors, "Number is required ");}
	if (empty($role)) { array_push($errors, "Role is required ");}
	if (empty($password)) { array_push($errors, "uh-oh you forgot the password"); }
	if ($password != $passwordConfirmation) { array_push($errors, "The two passwords do not match"); }

	$user_check_query = "SELECT * FROM users WHERE username='$username' 
							OR email='$email' LIMIT 1";
	$result = mysqli_query($conn, $user_check_query);
	$user = mysqli_fetch_assoc($result);
	if ($user) { // if user exists
		if ($user['username'] === $username) {
		  array_push($errors, "Username already exists");
		}

		if ($user['email'] === $email) {
		  array_push($errors, "Email already exists");
		}
		
		if ($user['number'] === $number) {
			array_push($errors, "Phone already exists");
		  }
	}
	$id = rand(1,100);
	
	if (count($errors) == 0) {
		$password = md5($password);//encrypt the password before saving in the database
		$query = "INSERT INTO users (id, username, email, number, role, password, created_at, updated_at) 
				  VALUES('$id','$username', '$email', '$number','$role', '$password', now(), now())";
		mysqli_query($conn, $query);

		$_SESSION['message'] = "Admin user created successfully";
		header('location: users.php');
		exit(0);
	}
}

function editAdmin($admin_id)
{
	global $conn, $username, $number, $role, $isEditingUser, $admin_id, $email;

	$sql = "SELECT * FROM users WHERE id=$admin_id LIMIT 1";
	$result = mysqli_query($conn, $sql);
	$admin = mysqli_fetch_assoc($result);

	$username = $admin['username'];
	$email = $admin['email'];
}


function updateAdmin($request_values){
	global $conn, $errors, $role, $number,$username, $isEditingUser, $admin_id, $email;
	$admin_id = $request_values['admin_id'];
	$isEditingUser = false;


	$username = ($request_values['username']);
	$email = ($request_values['email']);
	$number = ($request_values['number']);
	$password = ($request_values['password']);
	$passwordConfirmation = ($request_values['passwordConfirmation']);
	if(isset($request_values['role'])){
		$role = $request_values['role'];
	}
	if (count($errors) == 0) {
		$password = md5($password);

		$query = "UPDATE users SET username='$username', email='$email',  number='$number',role='$role', password='$password' WHERE id=$admin_id";
		mysqli_query($conn, $query);

		$_SESSION['message'] = "Admin user updated successfully";
		header('location: users.php');
		exit(0);
	}
}
function deleteAdmin($admin_id) {
	global $conn;
	$sql = "DELETE FROM users WHERE id=$admin_id";
	if (mysqli_query($conn, $sql)) {
		$_SESSION['message'] = "User successfully deleted";
		header("location: users.php");
		exit(0);
	}
}



function getAdminUsers(){
	global $conn, $roles;
	$sql = "SELECT * FROM users WHERE role IS NOT NULL";
	$result = mysqli_query($conn, $sql);
	$users = mysqli_fetch_all($result, MYSQLI_ASSOC);

	return $users;
}

// Receives a string like 'Some Sample String'
// and returns 'some-sample-string'

 
// function makeSlug(String $string){
// 	$string = strtolower($string);
    
// 	return $slug;
// }
?>


<?php 

$topic_id = 0;
$isEditingTopic = false;
$topic_name = "";


if (isset($_POST['create_topic'])) { createTopic($_POST); }
if (isset($_GET['edit-topic'])) {
	$isEditingTopic = true;
	$topic_id = $_GET['edit-topic'];
	editTopic($topic_id);
}
if (isset($_POST['update_topic'])) {
	updateTopic($_POST);
}
if (isset($_GET['delete-topic'])) {
	$topic_id = $_GET['delete-topic'];
	deleteTopic($topic_id);
}



function getAllTopics() {
	global $conn;
	$sql = "SELECT * FROM topics";
	$result = mysqli_query($conn, $sql);
	$topics = mysqli_fetch_all($result, MYSQLI_ASSOC);
	return $topics;
}
function createTopic($request_values){
	global $conn, $errors, $topic_name;
	$topic_name = ($request_values['topic_name']);
	
	//  $topic_slug = makeSlug($topic_name);
	$slugg = strtolower($topic_name);
	 $topic_slug = preg_replace('/[^A-Za-z0-9-]+/', '-', $slugg);
	
	if (empty($topic_name)) { 
		array_push($errors, "Topic name required"); 
	}
	$topic_check_query = "SELECT * FROM topics WHERE slug='$topic_slug' LIMIT 1";
	$result = mysqli_query($conn, $topic_check_query);
	if (mysqli_num_rows($result) > 0) { // if topic exists
		array_push($errors, "Topic already exists");
	}
	$id = rand(1,1000);
	if (count($errors) == 0) {
		$query = "INSERT INTO topics (id, name, slug) 
				  VALUES('$id' ,'$topic_name', '$topic_slug')";
		mysqli_query($conn, $query);
		

		$_SESSION['message'] = "Topic created successfully";
		header('location: topics.php');
		exit(0);
	}

}

function editTopic($topic_id) {
	global $conn, $topic_name, $isEditingTopic, $topic_id;
	$sql = "SELECT * FROM topics WHERE id=$topic_id LIMIT 1";
	$result = mysqli_query($conn, $sql);
	$topic = mysqli_fetch_assoc($result);
	$topic_name = $topic['name'];
}
function updateTopic($request_values) {
	global $conn, $errors, $topic_name, $topic_id;
	$topic_name = ($request_values['topic_name']);
	$topic_id = ($request_values['topic_id']);
	
	// $topic_slug = makeSlug($topic_name);
	
	// validate form
	if (empty($topic_name)) { 
		array_push($errors, "Topic name required"); 
	}
	// register topic if there are no errors in the form
	if (count($errors) == 0) {
		$query = "UPDATE topics SET name='$topic_name', slug='$topic_slug' WHERE id=$topic_id";
		mysqli_query($conn, $query);

		$_SESSION['message'] = "Topic updated successfully";
		header('location: topics.php');
		exit(0);
	}
}
// delete topic 
function deleteTopic($topic_id) {
	global $conn;
	$sql = "DELETE FROM topics WHERE id=$topic_id";
	if (mysqli_query($conn, $sql)) {
		$_SESSION['message'] = "Topic successfully deleted";
		header("location: topics.php");
		exit(0);
	}
}