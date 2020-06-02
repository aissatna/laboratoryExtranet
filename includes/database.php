<?php
require_once ("config.php");
class Mysqli_DB{
    private $conn;
    function __construct()
    {
        $this->db_connect();
    }
    /*--------------------------------------------------------------*/
    /* Function for Open database connection
    /*--------------------------------------------------------------*/
    public function db_connect(){
        $this->conn=mysqli_connect(DB_HOST,DB_USER,DB_PASS);
        if ($this->conn){
            die(" Database connection failed:". mysqli_connect_error());
        }else{
            $select_db = $this->conn->select_db(DB_NAME);
         if (!$select_db){
             die("Failed to Select Database". mysqli_connect_error());
         }
        }
    }
    /*--------------------------------------------------------------*/
    /* Function for Close database connection
    /*--------------------------------------------------------------*/
    public function db_disconnect(){
        if (isset($this->conn)){
            mysqli_close($this->conn);
            unset($this->conn);
        }
    }
}
$db= new Mysqli_DB();



?>
