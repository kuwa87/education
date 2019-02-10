<?php
require_once "Config.php";
class material extends Config
{

    //get material
    public function get_material()
    {
        //query
        $sql = "SELECT * FROM material INNER JOIN course ON material.courseID=course.courseID";

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

    //echo material
    public function echo_material($materialID)
    {
        $sql = "SELECT * FROM material WHERE materialID=$materialID";
        $result = $this->conn->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row;

        } else {
            return $this->conn->error;
        }

    }

    public function get_material_by_materialID($materialID)
    {
        $sql = "SELECT * FROM material WHERE materialID=$materialID";

        // $sql = "SELECT * FROM material INNER JOIN login ON material.materialID=login.loginID WHERE material.materialID='$materialID'";

        $result = $this->conn->query($sql);

        if ($result->num_rows > 0) {
            $rows = array();
            $row = $result->fetch_assoc();
            return $row;
        } else {
            echo $this->conn->error;
        }
    }

    //get materials by course
    public function get_material_by_course($courseID)
    {
        //query
        $sql = "SELECT * FROM material INNER JOIN course ON course.courseID=material.courseID WHERE material.courseID=$courseID";
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

    //change
    public function change($materialName, $materialDetails, $materialContent, $courseID, $materialID)
    {

        $sqlFirst = "SELECT * FROM material WHERE materialName = '$materialName' AND materialID!= '$materialID'";
        $result = $this->conn->query($sqlFirst);

        if ($result->num_rows > 0) {
            echo 'material_name is already taken.';
        } else {

            $sql = "UPDATE material SET materialName='$materialName', materialDetails='$materialDetails', courseID='$courseID', materialID='$materialID', materialContent='$materialContent' WHERE materialID=$materialID";

            $result = $this->conn->query($sql);

            if ($result) {
                // header("Location: dashboard.php");
                echo "<script>window.location.replace('materials.php')</script>";
            } else {
                echo "Error: " . $this->conn->error;
            }
        }
    }

    //delete
    public function delete($materialID)
    {

        $sql = "DELETE FROM material WHERE materialID=$materialID";
        $result = $this->conn->query($sql);

        if ($result) {
            echo "<script>window.location.replace('materials.php')</script>";
        } else {
            echo "Error: " . $this->conn->error;
        }
    }

    //insert
    public function insert($materialName, $materialDetails, $target_dir, $target_file, $tmp_name, $courseID)
    {

        $sqlFirst = "SELECT * FROM material WHERE materialName = '$materialName'";
        $result = $this->conn->query($sqlFirst);

        if ($result->num_rows > 0) {
            echo 'material_name is already taken.';
        } else {

            $sql = "INSERT INTO material(materialName, materialDetails, materialContent, courseID) VALUES ('$materialName', '$materialDetails', '$target_file','$courseID')";
            $result = $this->conn->query($sql);

            if ($result == true) {
                $this->redirect_js("materials.php");
            } else {
                echo 'Error in inserting record' . $this->conn->error;
            }

        }

    }

}
