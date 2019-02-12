 <?php
session_start();
include '../classes/User.php';
$users = new User;
$studentID = 1;
$courseID = 1;
$result = $users->course_enroll($studentID, $courseID);

?>