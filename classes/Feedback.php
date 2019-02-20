<?php
require_once "Config.php";
class Feedback extends Config
{

    //ratigng, reviews

    //insert feedback
    public function insert_feedback($rating, $message, $studentID, $courseID)
    {

        $sql = "INSERT INTO feedback(rating,message,studentID,courseID) VALUES ('$rating','$message','$studentID','$courseID')";
        $result = $this->conn->query($sql);

        if ($result) {
            $this->redirect_js("selectedcourse.php?courseID=$courseID");
        }
        echo $this->conn->error;
    }

    //check feedback already inserted or not
    public function check_feedback($studentID, $courseID)
    {

        $sql = "SELECT * FROM feedback WHERE studentID = '$studentID' AND courseID = '$courseID'";
        $result = $this->conn->query($sql);

        if ($result->num_rows > 0) {
            return true;
        }
        return false;
    }

    public function get_feedback($courseID)
    {
        //query
        $sql = "SELECT * FROM feedback
        INNER JOIN student ON student.studentID = feedback.studentID WHERE feedback.courseID = $courseID ORDER BY dateAdded DESC";
        //DESC descending
        //ASC ascending

        $result = $this->conn->query($sql);

        //initialize an array

        if ($result->num_rows > 0) {
            $rows = array();
            while ($row = $result->fetch_assoc()) {
                $rows[] = $row;
            }
            return $rows;

        } else {
            echo $this->conn->error;
        }
    }

}
