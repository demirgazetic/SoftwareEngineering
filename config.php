
<?php

class Database 
{
    public $handler;

    public function __construct()
    {
        $host = 'ol5tz0yvwp930510.cbetxkdyhwsb.us-east-1.rds.amazonaws.com';
        $db   = 'sxl0a8ry4y96pg9z';
        $user = 'ybkfqgepc6hqneq4';
        $pass = 'lsfhkpboog9go3ro';
        $dsn = "mysql:host=$host;port=3306;dbname=$db;";
        
        

        $opt = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];

        $this->handler = new PDO($dsn, $user, $pass, $opt);        
    }
}

?>

