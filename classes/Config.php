<?php

class Config {
    private $servername = 'localhost';
    private $username = 'root';
    private $password = '';
    private $database = 'elearning';

    public $conn;
    
    public function __construct(){
        
        $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->database);

        if($this->conn->error){
            echo "Connection error: ". $this->conn->connect_error;
        }
    }

    // public function redirect($url){
    //     #ob_clean - remove all output before header
    //     ob_clean();
    //     header("Location: $url");
    //     exit;
    // }

    public function redirect_js($url){
        echo "<script>window.location.replace('$url')</script>";
        exit;
    }
}
