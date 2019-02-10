<?php
session_start();
include '../classes/Course.php';
$courseID = $_GET['courseID'];
$course = new Course;
$row = $course->get_course_by_courseID($courseID);
$delete = $course->delete($courseID);
