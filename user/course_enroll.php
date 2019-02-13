 <?php
session_start();
include '../classes/User.php';
$loginID = $_SESSION['loginID'];
$user = new User;
$row = $user->echo_student($loginID);

$studentID = $row['studentID'];
$courseID = $_GET['courseID'];

$result = $user->course_enroll($studentID, $courseID);

?>