<?php
require_once ("config.php");
class Mysqli_DB{
    private $conn;
    public $query_id;
    function __construct()
    {
        $this->db_connect();
    }
    /*--------------------------------------------------------------*/
    /* Function for Open database connection
    /*--------------------------------------------------------------*/
    public function db_connect(){
        $this->conn=mysqli_connect(DB_HOST,DB_USER,DB_PASS);

        if (!$this->conn){
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
    /*--------------------------------------------------------------*/
    /* Function for mysqli query
    /*--------------------------------------------------------------*/
    public function query($sql)
    {

        if (trim($sql != "")) {
            $this->query_id = $this->conn->query($sql);
        }
        if (!$this->query_id)
            // only for Develope mode
            die("Error on this Query :<pre> " . $sql ."</pre>");
        // For production mode
        //  die("Error on Query");

        return $this->query_id;

    }
    /*--------------------------------------------------------------*/
    /* Function for Query Helper
    /*--------------------------------------------------------------*/
    public function fetch_array($statement)
    {
        return mysqli_fetch_array($statement);
    }
    public function fetch_object($statement)
    {
        return mysqli_fetch_object($statement);
    }
    public function fetch_assoc($statement)
    {
        return mysqli_fetch_assoc($statement);
    }
    public function num_rows($statement)
    {
        return mysqli_num_rows($statement);
    }
    public function insert_id()
    {
        return mysqli_insert_id($this->conn);
    }
    public function affected_rows()
    {
        return mysqli_affected_rows($this->conn);
    }
    /*--------------------------------------------------------------*/
    /* Function for Remove escapes special
    /* characters in a string for use in an SQL statement
    /*--------------------------------------------------------------*/
    public function escape($str){
        return $this->conn->real_escape_string($str);
    }
}
$db= new Mysqli_DB();
?>
