<?php
session_start();
include '../classes/User.php';
$loginID = $_GET['loginID'];
$users = new User;
$row = $users->get_student_by_loginID($loginID);
$delete = $users->delete($loginID);
