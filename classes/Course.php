<?php
require_once "Config.php";
class Course extends Config
{

    //get course
    public function get_course()
    {
        //query
        $sql = "SELECT * FROM course INNER JOIN student ON course.loginID = student.loginID";

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
    public function echo_course($courseID)
    {
        $sql = "SELECT * FROM course WHERE courseID=$courseID";
        $result = $this->conn->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row;

        } else {
            return $this->conn->error;
        }

    }

    public function get_course_by_courseID($courseID)
    {
        $sql = "SELECT * FROM course WHERE courseID=$courseID";

        // $sql = "SELECT * FROM course INNER JOIN login ON course.courseID=login.loginID WHERE course.courseID='$courseID'";

        $result = $this->conn->query($sql);

        if ($result->num_rows > 0) {
            $rows = array();
            $row = $result->fetch_assoc();
            return $row;
        } else {
            echo $this->conn->error;
        }
    }

    //change
    public function change($courseName, $courseDetails, $coursePrice, $loginID, $courseID)
    {

        $sqlFirst = "SELECT * FROM categories WHERE courseName = '$courseName' AND courseID!= '$courseID'";
        $result = $this->conn->query($sqlFirst);

        if ($result->num_rows > 0) {
            echo 'course_name is already taken.';
        } else {

            $sql = "UPDATE course SET courseName='$courseName', courseDetails='$courseDetails', coursePrice='$coursePrice', loginID='$loginID', courseID='$courseID' WHERE courseID=$courseID";

            $result = $this->conn->query($sql);

            if ($result) {
                // header("Location: dashboard.php");
                echo "<script>window.location.replace('courses.php')</script>";
            } else {
                echo "Error: " . $this->conn->error;
            }
        }
    }

    //delete
    public function delete($courseID)
    {

        $sql = "DELETE FROM course WHERE courseID=$courseID";
        $result = $this->conn->query($sql);

        if ($result) {
            echo "<script>window.location.replace('courses.php')</script>";
        } else {
            echo "Error: " . $this->conn->error;
        }
    }

    //insert
    public function insert($courseName, $courseDetails, $coursePrice, $target_dir, $target_file, $admin_file, $tmp_name, $loginID)
    {

        $sqlFirst = "SELECT * FROM course WHERE courseName = '$courseName'";
        $result = $this->conn->query($sqlFirst);

        if ($result->num_rows > 0) {
            echo 'course_name is already taken.';
        } else {
            if (move_uploaded_file($tmp_name, $admin_file)) {

                $sql = "INSERT INTO course(courseName, courseDetails, coursePrice, coursePicture, loginID) VALUES ('$courseName', '$courseDetails', '$coursePrice', '$target_file', '$loginID' )";
                $result = $this->conn->query($sql);

                if ($result == true) {
                    $this->redirect_js("courses.php");
                } else {
                    echo 'Error in inserting record' . $this->conn->error;
                }

            } else {
                $sql = "INSERT INTO course(courseName, courseDetails, coursePrice, loginID) VALUES ('$courseName', '$courseDetails', '$coursePrice', '$loginID' )";
                $result = $this->conn->query($sql);

                if ($result == true) {
                    $this->redirect_js("courses.php");
                } else {
                    echo 'Error in inserting record' . $this->conn->error;
                }
            }

        }

    }
    public function insertfile($courseName, $target_dir, $target_file, $tmp_name, $admin_file, $courseID)
    {

        $sqlFirst = "SELECT * FROM course WHERE courseName = '$courseName'";
        $result = $this->conn->query($sqlFirst);
        echo $tmp_name;
        if ($file = move_uploaded_file($tmp_name, $admin_file)) {

            $sql = "UPDATE course SET coursePicture = '$target_file' WHERE courseID ='$courseID'";
            $result = $this->conn->query($sql);

            if ($result == true) {

                // echo "<script>location.reload()</script>";
                // exit;

                $this->redirect_js("editcourse.php?courseID=$courseID&action=1");
            } else {
                echo 'Error in inserting record' . $this->conn->error;
            }

        } else {
            echo "error";
        }

    }

    // SELECT * FROM database WHERE filename LIKE %.jpg OR filename LIKE %.png
    //LIKE その要素をもつものを選択する
    //% はワイルドカードみたいなもの

    //コースに申し込みした人の人数を数える

    public function count_usercourse_by_courseID($courseID)
    {
        $sql = "SELECT count(*) as course_number_by_courseID FROM usercourse WHERE courseID = $courseID";
        $result = $this->conn->query($sql);

        $row = $result->fetch_assoc();

        if ($row) {
            echo $row['course_number_by_courseID'];
        }

    }

    //コースを評価した人の人数を数える

    public function count_feedback_by_courseID($courseID)
    {
        $sql = "SELECT count(*) as feedback_number_by_courseID FROM feedback WHERE courseID = $courseID";
        $result = $this->conn->query($sql);

        $row = $result->fetch_assoc();

        if ($row) {
            echo $row['feedback_number_by_courseID'];
        }

    }

    public function aaaa()
    {
        $sql = "SELECT count(*) as feedback_number_by_courseID FROM feedback WHERE courseID = $courseID";

    }
}
