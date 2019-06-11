<?php
// used to get mysql database connection
class Database{
 
    // specify your own database credentials
    private $host = "ol5tz0yvwp930510.cbetxkdyhwsb.us-east-1.rds.amazonaws.com:3306";
    private $db_name = "sxl0a8ry4y96pg9z";
    private $username = "ybkfqgepc6hqneq4";
    private $password = "lsfhkpboog9go3ro";
    public $conn;
 
    // get the database connection
    public function getConnection(){
 
        $this->conn = null;
 
        try{
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
        }catch(PDOException $exception){
            echo "Connection error: " . $exception->getMessage();
        }
 
        return $this->conn;
    }
}
?>
