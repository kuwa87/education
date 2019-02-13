<?php
session_start();
include '../classes/User.php';
$ucID = $_GET['ucID'];
$course = new User;
$row = $course->remove_enroll($ucID);
$delete = $course->delete($ucID);

//history back
