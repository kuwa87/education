<?php
require_once "Config.php";

class User extends Config
{

    //login

    public function login($email, $password)
    {
        // $sql = "SELECT * FROM student WHERE loginID = '$loginID' AND password = '$password'";
        $sql = "SELECT * FROM login WHERE emailAdress = '$email' AND password = '$password'";
        $result = $this->conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $_SESSION['loginID'] = $row['loginID'];

            if ($result->num_rows > 0) {
                if ($row['status'] == 'a') {
                    $this->redirect_js("admin/index.php");
                } else {
                    $this->redirect_js("user/index.php");
                }
                // header("Location: user/index.php");
            } else {
                echo 'Username and Password error.';
            }
        } else {
            echo 'Username and Password error.';

        }
    }

    //get student

    public function get_students()
    {
        //query
        $sql = "SELECT * FROM student";
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

    //get teachers
    public function get_teachers()
    {
        //query
        $sql = "SELECT * FROM student INNER JOIN login ON login.loginID = student.loginID WHERE login.status = 'a'";
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

    //echo username
    public function echo_student($loginID)
    {
        $sql = "SELECT * FROM student WHERE loginID='$loginID'";
        $result = $this->conn->query($sql);
        // $row = array();
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row;
        }

    }

    //get student by ID
    public function get_student_by_loginID($login_id)
    {
        $sql = "SELECT * FROM student INNER JOIN login ON student.loginID=login.loginID WHERE student.loginID='$login_id'";

        $result = $this->conn->query($sql);

        if ($result->num_rows > 0) {
            $rows = array();
            $row = $result->fetch_assoc();
            return $row;
        } else {
            echo $this->conn->error;
        }
    }

    //logout
    public function logout()
    {
        // session_start();
        session_destroy();
        header("Location: ../login.php");
        exit;

    }

    //change
    public function change($loginID, $studentName, $studentAdress, $studentBirthdate, $studentBiography, $emailAdress, $password)
    {

        $sqlFirst = "SELECT * FROM login WHERE emailAdress = '$emailAdress' AND emailAdress!= '$emailAdress'";
        $result = $this->conn->query($sqlFirst);

        if ($result->num_rows > 0) {
            echo 'Email is already taken.';
        } else {

            $sql = "UPDATE student SET studentName='$studentName',studentAdress='$studentAdress',studentBirthdate='$studentBirthdate',studentBiography='$studentBiography' WHERE loginID='$loginID'";

            $result = $this->conn->query($sql);

            if ($result) {
                echo "<script>window.location.replace('index.php')</script>";
            } else {
                echo "Error: " . $this->conn->error;
            }
        }
    }

    //delete
    public function delete($loginID)
    {

        $sql = "DELETE FROM student WHERE loginID=$loginID";
        $result = $this->conn->query($sql);

        if ($result) {
            $sql = "DELETE FROM login WHERE loginID=$loginID";
            $result = $this->conn->query($sql);
            if ($result) {
                echo "<script>window.location.replace('index.php')</script>";
            }
        } else {
            echo "Error: " . $this->conn->error;
        }
    }

    //insert
    public function insert($name, $adress, $birthdate, $email, $password, $conpass, $target_dir, $target_file, $tmp_name, $admin_file)
    {
        if ($password !== $conpass) {
            echo 'Password is not same as confrim password';
        } else {

            $sqlFirst = "SELECT * FROM login WHERE emailAdress = '$email'";
            $result = $this->conn->query($sqlFirst);

            if ($result->num_rows > 0) {
                echo 'Email is already taken.';
            } else {

                if (move_uploaded_file($tmp_name, $admin_file)) {

                    $sql = "INSERT INTO login(emailAdress,password,status) VALUES ('$email','$password','u')";
                    $result = $this->conn->query($sql);

                    if ($result) {

                        // $loginID = mysqli_insert_id($this->conn);
                        $loginID = $this->conn->insert_id;

                        $sql = "INSERT INTO student(studentName,studentAdress,studentBirthdate,loginID,studentPicture) VALUES ('$name','$adress','$birthdate','$loginID','$target_file')";
                        $result = $this->conn->query($sql);
                        if ($result) {

                            echo "<script>window.location.replace('index.php')</script>";
                        } else {
                            echo 'error';
                        }
                    } else {
                        echo 'Error in inserting record' . $this->conn->error;
                        exit;
                    }

                } else {
                    echo "Error uploading file";
                }
            }

        }
    }

    // login_required
    public function login_required()
    {
        // session_start();
        if (!isset($_SESSION['loginID'])) {
            // header('Location: ../login.php');
            $this->redirect_js('../login.php');

        } else {
            // echo 'Error in inserting record' . $this->conn->error;
        }
    }

    //loged in
    public function logged_in()
    {
        // session_start();
        if (isset($_SESSION['loginID'])) {
            // header('Location: javascript://history.go(-1)');
            $this->redirect_js('javascript:history.go(-1)');
            //「://」が削除された理由・・・上記のコードはすでにJSであるから。

            // header("Location: ". $_SERVER['HTTP_REFERER']);
            // exit;
        }
    }

    //insertfile
    public function insertfile($studentName, $target_dir, $target_file, $admin_file, $tmp_name, $loginID)
    {

        $sqlFirst = "SELECT * FROM student WHERE loginID = '$loginID'";
        $result = $this->conn->query($sqlFirst);

        if (move_uploaded_file($tmp_name, $admin_file)) {

            $sql = "UPDATE student SET studentPicture = '$target_file' WHERE loginID ='$loginID'";
            $result = $this->conn->query($sql);

            if ($result == true) {

                // echo "<script>location.reload()</script>";
                // exit;

                $this->redirect_js("edituser.php?loginID=$loginID&action=1");
            } else {
                echo 'Error in inserting record' . $this->conn->error;
            }

        }

    }

    // User course functions

    //course_enroll (similar to insert)
    public function course_enroll($studentID, $courseID)
    {

        $sql = "INSERT INTO usercourse(studentID,courseID) VALUES ('$studentID','$courseID')";
        $result = $this->conn->query($sql);

        if ($result) {
            $this->redirect_js('javascript:history.go(-1)');

            // echo "<script>window.location.replace('courses.php')</script>";
        } else {
            echo 'error';
        }

    }

    //enrolled_corse
    public function enrolled_course($courseID)
    {
        //query
        $loginID = $_SESSION['loginID'];
        $sql = "SELECT * FROM usercourse
                INNER JOIN student ON usercourse.studentID = student.studentID
                INNER JOIN course ON course.courseID = usercourse.courseID
                WHERE student.loginID = '$loginID'";
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
    //remove_enroll
    public function remove_enroll($ucID)
    {

        $sql = "DELETE FROM usercourse WHERE ucID=$ucID";
        $result = $this->conn->query($sql);

        if ($result) {
            $this->redirect_js('javascript:history.go(-1)');

            // echo "<script>window.location.replace('courses.php')</script>";
        } else {
            echo "Error: " . $this->conn->error;
        }
    }

    //enrolled_corse
    public function get_course_not_enrolled($studentID, $courseID)
    {
        //query

        $sql = "SELECT * FROM course WHERE courseID = $courseID AND courseID NOT IN
                (SELECT courseID FROM usercourse WHERE studentID = $studentID AND courseID = $courseID)";
        $result = $this->conn->query($sql);
        //initialize an array
        $rows = array();
        if ($result->num_rows == 0) {
            return false;

        } else {
            return true;
        }

    }

    public function get_all_courses($studentID)
    {
        $sql = "SELECT * FROM course INNER JOIN usercourse ON course.courseID = usercourse.courseID
                ";
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

    //index
    public function enrolled_course_index($courseID)
    {
        //query
        $loginID = $_SESSION['loginID'];
        $sql = "SELECT * FROM usercourse
                INNER JOIN student ON usercourse.studentID = student.studentID
                INNER JOIN course ON course.courseID = usercourse.courseID
                WHERE student.loginID = $loginID AND usercourse.courseID = $courseID";
        $result = $this->conn->query($sql);

        //initialize an array
        $rows = array();
        if ($result->num_rows > 0) {
            return $result->fetch_assoc();

        } else {
            return $this->conn->error;
        }

    }

}
