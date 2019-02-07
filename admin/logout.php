 <?php
session_start();
include '../classes/User.php';
$users = new User;
$result = $users->logout($studentName, $password);

?>