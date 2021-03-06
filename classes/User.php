<?php
require_once "Config.php";

class User extends Config
{

    //login

    public function login($email, $password)
    {
        $sql = "SELECT * FROM student INNER JOIN login ON login.loginID = student.loginID WHERE login.emailAdress = '$email' AND login.password = '$password'";
        $result = $this->conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $_SESSION['loginID'] = $row['loginID'];
            $_SESSION['studentID'] = $row['studentID'];

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
    public function login_required_admin()
    {
        if (!isset($_SESSION['loginID'])) {
            $this->redirect_js('../login.php');

        } else {
            $loginID = $_SESSION['loginID'];
            $sql = "SELECT * FROM login WHERE loginID = '$loginID'";
            $result = $this->conn->query($sql);
            if ($result->num_rows > 0) {

                $row = $result->fetch_assoc();

                if ($row['status'] == 'u') {
                    $this->redirect_js('javascript:history.go(-1)');
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

    //course_enroll (similar to insert) after insertd, it will also add the usermaterial table
    public function course_enroll($studentID, $courseID)
    {

        $sql = "INSERT INTO usercourse(studentID,courseID,status) VALUES ('$studentID','$courseID','studying')";
        $result = $this->conn->query($sql);

        if ($result) {

            $ucID = $this->conn->insert_id;
            $sqlm = "SELECT * FROM material INNER JOIN usercourse ON material.courseID = usercourse.courseID WHERE usercourse.ucID = $ucID";
            $resultm = $this->conn->query($sqlm);
            while ($row = $resultm->fetch_assoc()) {
                $materialID = $row['materialID'];
                $sql = "INSERT INTO usermaterial(ucID,materialID,mt_status) VALUES ('$ucID','$materialID','studying')";
                $result = $this->conn->query($sql);

            }
            if ($result) {
                $this->redirect_js('javascript:history.go(-1)');

            } else {
                echo 'error';
            }

        }

    }

    //enrolled_corse
    public function enrolled_course()
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
            // return $this->conn->error;

        }

    }
    //remove_enroll
    public function remove_enroll($ucID)
    {

        $sql = "DELETE FROM usercourse WHERE ucID=$ucID";
        $result = $this->conn->query($sql);

        if ($result) {
            $sql = "DELETE FROM usermaterial WHERE ucID=$ucID";
            $result = $this->conn->query($sql);

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

    public function get_courses_guest()
    {
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
            // return $this->conn->error;
        }

    }

    //change the status of usermaterial
    // public function get_and_change_material_status($umID, $ucID)
    // {
    //     $sql = "SELECT * FROM usermaterial INNER JOIN usercourse ON usermaterial.ucID = usercourse.ucID";
    //     $result = $this->conn->query($sql);

    //     $sql = "UPDATE usermaterial SET status='$status' WHERE umID='$umID'";

    //     $result = $this->conn->query($sql);

    //     if ($result) {
    //         return true;
    //     } else {
    //         return false;
    //     }
    // }

    //get usermaterial
    public function get_usercourse_material($courseID, $studentID)
    {
        $sql = "SELECT * FROM material
        INNER JOIN usercourse ON material.courseID = usercourse.courseID
        WHERE usercourse.courseID = $courseID AND usercourse.studentID = $studentID";
        $result = $this->conn->query($sql);

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

    //get ucID and materialID inside roop
    public function get_each_material($ucID, $materialID)
    {
        $sql = "SELECT * from usermaterial WHERE ucID = $ucID AND materialID = $materialID";
        $result = $this->conn->query($sql);

        $rows = array();
        if ($result->num_rows > 0) {
            return $result->fetch_assoc();

        } else {
            return $this->conn->error;
        }

    }

    // change the status of usermaterial
    public function change_material_status($umID, $ucID)
    {
        $sql = "SELECT * FROM usermaterial WHERE ucID = $ucID AND mt_status = 'studying'";
        $result = $this->conn->query($sql);

        if ($result->num_rows > 0) {

            if ($row['mt_status'] = 'studying') {
                $sql = "UPDATE usermaterial SET mt_status='finished' WHERE umID='$umID'";
                $result = $this->conn->query($sql);
                $this->redirect_js('javascript:history.go(-1)');
            } else {
                echo $this->conn->error;
            }

        } else {
            return false;
        }
    }

    //どのmaterialが終わったか　最後の一つだけ取得
    public function get_finished_material($umID, $ucID)
    {
        $sql = "SELECT * FROM usermaterial WHERE ucID = $ucID AND umID < $umID ORDER BY umID DESC LIMIT 1";
        $result = $this->conn->query($sql);
        //checking previous conditon

        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        } else {
            echo $this->conn->error;
        }

        //DESC descending
        //LIMIT 1 -only display 1 value
    }
    public function check_all_material_finished($ucID)
    {
        $sql = "SELECT count(*) as total FROM usermaterial WHERE ucID = $ucID";
        $result = $this->conn->query($sql);
        $row = $result->fetch_assoc();

        $sql = "SELECT count(*) as finished FROM usermaterial WHERE ucID = $ucID AND mt_status = 'finished'";
        $result1 = $this->conn->query($sql);
        $row1 = $result1->fetch_assoc();

        if ($row['total'] == $row1['finished']) {
            return true;
        } else {
            return false;
        }

    }

    public function change_course_status($ucID)
    {
        // $sql = "SELECT * FROM usercourse";
        $sql = "SELECT * FROM usercourse WHERE status = 'studying' AND ucID = $ucID";
        $result = $this->conn->query($sql);

        if ($result->num_rows > 0) {

            if ($row['status'] = 'studying') {
                $sql = "UPDATE usercourse SET status='finished' WHERE ucID='$ucID'";
                $result = $this->conn->query($sql);
                $this->redirect_js('javascript:history.go(-1)');
            } else {
                echo $this->conn->error;
            }

        } else {
            return false;
        }
    }

    public function course_limit($studentID)
    {
        $sql = "SELECT count(*) as course_number FROM usercourse WHERE studentID = $studentID AND status = 'studying'";
        $result = $this->conn->query($sql);

        $row = $result->fetch_assoc();

        if ($row['course_number'] < '2') {
            return true;
        } else {
            return false;
        }

    }

    public function count_course($studentID)
    {
        $sql = "SELECT count(*) as course_number FROM usercourse WHERE studentID = $studentID AND status = 'studying'";
        $result = $this->conn->query($sql);

        $row = $result->fetch_assoc();

        if ($row) {

            if ($row['course_number'] == 1) {
                echo "You are studying " . $row['course_number'] . " course. ";
            } else {
                echo "You are studying " . $row['course_number'] . " courses. ";
            }

        }

    }
    public function count_finished_course($studentID)
    {
        $sql = "SELECT count(*) as course_finished_number FROM usercourse WHERE studentID = $studentID AND status = 'finished'";
        $result = $this->conn->query($sql);

        $row = $result->fetch_assoc();

        if ($row) {
            if ($row['course_finished_number'] == 1) {
                echo "You finished " . $row['course_finished_number'] . " course. ";
            } else {
                echo "You finished " . $row['course_finished_number'] . " courses. ";

            }

        }
    }

    public function count_new_material($courseID, $ucID)
    {
        $sql = "SELECT count(*) as all_material_number FROM material WHERE courseID = $courseID";
        $result = $this->conn->query($sql);
        //how many materials belong to the course
        $row = $result->fetch_assoc();

        $sql_all = "SELECT count(*) as inserted_material_number FROM usermaterial WHERE ucID = $ucID";
        $result_all = $this->conn->query($sql_all);
        //selectiing the current materials enrolled

        $row_all = $result_all->fetch_assoc();

        if ($row['all_material_number'] > $row_all['inserted_material_number']) {
            return true;
        } else {
            return false;

        }

    }

    public function update_my_course($courseID, $ucID)
    {
        $sql = "SELECT * FROM material WHERE courseID=$courseID AND materialID
        NOT IN(SELECT materialID FROM usermaterial WHERE ucID=$ucID and courseID=$courseID)";
        $result = $this->conn->query($sql);

        if ($result->num_rows > 0) {
            // $row = $result->fetch_assoc();
            //one only

            while ($row = $result->fetch_assoc()) {
                //not only one
                $materialID = $row['materialID'];
                $sql = "INSERT INTO usermaterial(ucID, materialID, mt_status) VALUES ('$ucID','$materialID','studying')";
                $result_success = $this->conn->query($sql);

            }

            if ($result_success) {
                $this->redirect_js("selectedcourse.php?courseID=$courseID");
            } else {
                echo 'error';
            }

        }

    }

}
