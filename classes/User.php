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
        if ($_SESSION['loginID'] == false) {
            // header('Location: ../login.php');
            $this->redirect_js('../login.php');

        }
    }

    public function logged_in()
    {
        // session_start();
        if (isset($_SESSION['emailAdress'])) {
            // header('Location: javascript://history.go(-1)');
            $this->redirect_js('javascript:history.go(-1)');
            //「://」が削除された理由・・・上記のコードはすでにJSであるから。

            // header("Location: ". $_SERVER['HTTP_REFERER']);
            // exit;
        }
    }

    //login_required
    // public function login_required()
    // {
    //     session_start();
    //     if ($_SESSION['loginID']) {
    //         header('Location: ' . $_SERVER['REQUEST_URI']);
    //     } else {
    //         header('Location: ../login.php');
    //     }
    // }

}
