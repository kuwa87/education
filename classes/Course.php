<?php
// require_once "Config.php";
class Course extends Config
{

    //get course
    public function get_course()
    {
        //query
        $sql = "SELECT * FROM course";
        $result = $this->conn->query($sql);

        //initialize an array
        $rows = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $rows[] = $row;
            }
            return $rows;

        } else {
            return $this->conn->error;
        }
    }

    //echo course
    public function echo_course($course_id)
    {
        $sql = "SELECT * FROM categories WHERE course_id=$course_id";
        $result = $this->conn->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row;

        } else {
            return $this->conn->error;
        }

    }

    //change
    public function change($course_name, $course_id)
    {

        $sqlFirst = "SELECT * FROM categories WHERE course_name = '$course_name' AND course_id!= '$course_id'";
        $result = $this->conn->query($sqlFirst);

        if ($result->num_rows > 0) {
            echo 'course_name is already taken.';
        } else {

            $sql = "UPDATE categories SET course_name='$course_name' WHERE course_id=$course_id";

            $result = $this->conn->query($sql);

            if ($result) {
                // header("Location: dashboard.php");
                echo "<script>window.location.replace('categories.php')</script>";
            } else {
                echo "Error: " . $this->conn->error;
            }
        }
    }

    //delete
    public function delete($course_id)
    {

        $sql = "DELETE FROM categories WHERE course_id=$course_id";
        $result = $this->conn->query($sql);

        if ($result) {
            echo "<script>window.location.replace('categories.php')</script>";
        } else {
            echo "Error: " . $this->conn->error;
        }
    }

    //insert
    public function insert($courseName, $courseDetails, $coursePrice, $loginID)
    {

        $sqlFirst = "SELECT * FROM course WHERE courseName = '$courseName'";
        $result = $this->conn->query($sqlFirst);

        if ($result->num_rows > 0) {
            echo 'course_name is already taken.';
        } else {

            $sql = "INSERT INTO course(courseName, courseDetails, coursePrice, loginID) VALUES ('$courseName', '$courseDetails', '$coursePrice', '$loginID')";
            $result = $this->conn->query($sql);

            if ($result == true) {
                $this->redirect_js("courses.php");
            } else {
                echo 'Error in inserting record' . $this->conn->error;
            }

        }

    }

}
