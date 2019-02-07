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
            $_SESSION['loginID'] = $row['loginID'];

            if ($row['status'] == 'a') {
                $this->redirect("user/index.php");
            } elseif ($row['status'] == 'u') {
                $this->redirect('user/index.php');
            }

            $this->redirect_js('user/index.php');
            // echo "<script>window.location.replace('some.php')</script>";
            // header("Location: user/index.php");
        } else {
            echo 'Username and Password error.';

        }
    }

    //get users
    public function get_sutdent()
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

    //echo username
    public function echo_student($loginID)
    {
        $sql = "SELECT * FROM student WHERE loginID= '$loginID'";
        $result = $this->conn->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row;

        } else {
            return $this->conn->error;
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
    public function change($username, $password, $firstname, $lastname, $email, $user_id)
    {

        $sqlFirst = "SELECT * FROM users WHERE username = '$username' AND user_id!= '$user_id'";
        $result = $this->conn->query($sqlFirst);

        if ($result->num_rows > 0) {
            echo 'Username is already taken.';
        } else {

            $sql = "UPDATE users SET username='$username',password='$password',email='$email',firstname='$firstname',lastname='$lastname' WHERE user_id=$user_id";

            $result = $this->conn->query($sql);

            if ($result) {
                // header("Location: index.php");
                echo "<script>window.location.replace('index.php')</script>";
            } else {
                echo "Error: " . $this->conn->error;
            }
        }
    }

    //delete
    public function delete($user_id)
    {

        $sql = "DELETE FROM users WHERE user_id=$user_id";
        $result = $this->conn->query($sql);

        if ($result) {
            echo "<script>window.location.replace('index.php')</script>";
        } else {
            echo "Error: " . $this->conn->error;
        }
    }

    //insert
    public function insert($name, $adress, $birthdate, $email, $password, $conpass, $target_dir, $target_file, $tmp_name)
    {
        if ($password !== $conpass) {
            echo 'Password is not same as confrim password';
        } else {

            $sqlFirst = "SELECT * FROM login WHERE emailAdress = '$email'";
            $result = $this->conn->query($sqlFirst);

            if ($result->num_rows > 0) {
                echo 'Email is already taken.';
            } else {

                if (move_uploaded_file($tmp_name, $target_file)) {

                    $sql = "INSERT INTO login(emailAdress,password,status) VALUES ('$email','$password','u')";
                    $result = $this->conn->query($sql);

                    if ($result) {

                        // $loginID = mysqli_insert_id($this->conn);
                        $loginID = $this->conn->insert_id;

                        $sql = "INSERT INTO student(studentName,studentAdress,studentBirthdate,loginID,studentPicture) VALUES ('$name','$adress','$birthdate','$loginID','$target_file')";
                        $result = $this->conn->query($sql);
                        if ($result) {

                            echo "<script>window.location.replace('login.php')</script>";
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
            header('Location: ../login.php');
            // $this->redirect_js('../login.php');
            echo 'ff';

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
