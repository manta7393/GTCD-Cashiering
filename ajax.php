<?php
ob_start();
$action = $_GET['action'];
include 'admin_class.php';
include 'db_connect.php';
$crud = new Action();
if($action == 'login'){
	$login = $crud->login();
	if($login)
		echo $login;
}
if($action == 'login2'){
	$login = $crud->login2();
	if($login)
		echo $login;
}
if($action == 'logout'){
	$logout = $crud->logout();
	if($logout)
		echo $logout;
}
if($action == 'logout2'){
	$logout = $crud->logout2();
	if($logout)
		echo $logout;
}
if ($_GET['action'] == 'save_user') {
  // Get the user data from the request
  $id = isset($_POST['id']) ? (int)$_POST['id'] : 0;
  $name = isset($_POST['name']) ? mysqli_real_escape_string($conn, $_POST['name']) : '';
  $username = isset($_POST['username']) ? mysqli_real_escape_string($conn, $_POST['username']) : '';
  $password = isset($_POST['password']) ? mysqli_real_escape_string($conn, $_POST['password']) : '';
  $type = isset($_POST['type']) ? (int)$_POST['type'] : 0;

  // Check if the user exists
  $user = $conn->query("SELECT * FROM users where id = $id");
  if ($user->num_rows > 0) {
    // User exists, update the user
    $row = $user->fetch_assoc();
    // Check if the username is the same as the existing one
    if ($row['username'] == $username) {
      // Username is the same, allow update
      if (!empty($password)) {
        // Update user with new password
        $password = md5($password);
$conn->query("UPDATE users SET name='$name', username='$username', password='$password', type='$type' WHERE id=$id");

      } else {
        // Update user without changing the password
        $conn->query("UPDATE users SET name='$name', username='$username', type='$type' WHERE id=$id");
      }
      echo 1;
    } else {
      // Username is different, check if the new username already exists
      $result = $conn->query("SELECT * FROM users where username='$username'");
      if ($result->num_rows > 0) {
        // Username already exists, return 0
        echo 0;
      } else {
        // Update user with new username
        if (!empty($password)) {
          // Update user with new password
          $password = md5($password);
$conn->query("UPDATE users SET name='$name', username='$username', password='$password', type='$type' WHERE id=$id");

        } else {
          // Update user without changing the password
          $conn->query("UPDATE users SET name='$name', username='$username', type='$type' WHERE id=$id");
        }
        echo 1;
      }
    }
  } else {
    // User does not exist, insert a new user
    $result = $conn->query("SELECT * FROM users where username='$username'");
    if ($result->num_rows > 0) {
      // Username already exists, return 0
      echo 0;
    } else {
      // Insert new user
      $password = md5($password);
      $conn->query("INSERT INTO users (name, username, password, type) VALUES ('$name', '$username', '$password', '$type')");
      echo 1;
    }
  }
}
if($action == 'delete_user'){
	$save = $crud->delete_user();
	if($save)
		echo $save;
}
if($action == 'signup'){
	$save = $crud->signup();
	if($save)
		echo $save;
}
if($action == 'update_account'){
	$save = $crud->update_account();
	if($save)
		echo $save;
}
if($action == "save_settings"){
	$save = $crud->save_settings();
	if($save)
		echo $save;
}
if($action == "save_course"){
	$save = $crud->save_course();
	if($save)
		echo $save;
}
if($action == "delete_course"){
	$delete = $crud->delete_course();
	if($delete)
		echo $delete;
}
if($action == "save_student"){
	$save = $crud->save_student();
	if($save)
		echo $save;
}
if($action == "delete_student"){
	$delete = $crud->delete_student();
	if($delete)
		echo $delete;
}
if($action == "save_fees"){
	$save = $crud->save_fees();
	if($save)
		echo $save;
}
if($action == "delete_fees"){
	$delete = $crud->delete_fees();
	if($delete)
		echo $delete;
}
if($action == "save_payment"){
	$save = $crud->save_payment();
	if($save)
		echo $save;
}
if($action == "delete_payment"){
	$delete = $crud->delete_payment();
	if($delete)
		echo $delete;
}
ob_end_flush();
?>
