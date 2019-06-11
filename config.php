

<?php

$link = mysqli_connect("ol5tz0yvwp930510.cbetxkdyhwsb.us-east-1.rds.amazonaws.com", "ybkfqgepc6hqneq4", "lsfhkpboog9go3ro", "sxl0a8ry4y96pg9z", 3306);

if (!$link) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}

echo "Success: A proper connection to MySQL was made! The my_db database is great." . PHP_EOL;
echo "Host information: " . mysqli_get_host_info($link) . PHP_EOL;

mysqli_close($link);
?>