<?php
$servername = "mysql.hostinger.in";
$username = "u767234582_m"; // username for your database	
$password = "Mohamed4IoT";
$dbname = "u767234582_data"; // Name of database
$now = new DateTime();
$CRLF = "\n\r";

$fieldToGet = $_GET['PersonID'];

$conn = @mysql_connect($servername,$username,$password);

if (!$conn)
{
    die('Could not connect: ' . mysql_error());
}
$con_result = mysql_select_db($dbname, $conn);
mysql_set_charset('utf8');
mysql_query("SET NAMES 'utf8'"); 
mysql_query('SET CHARACTER SET utf8');

if(!$con_result)
{
	die('Could not connect to specific database: ' . mysql_error());
}

/*
 *  Database was created with a table called "DataTable" and has
 *  a column called "field" and a column called "value" and a 
 *  column called "logdata"
 */
 $sql = "SELECT * FROM Persons WHERE PersonID = '".$fieldToGet."' ";
//$sql = "SELECT * FROM Persons WHERE PersonID = '".$fieldToGet."' ";
$result = mysql_query($sql);
if (!$result) {
	die('Invalid query: ' . mysql_error());
}
else if($row = mysql_fetch_array($result, MYSQL_ASSOC))
{
	echo " ".$row["City"]." ";
	echo "<h1>Found!!!</h1>";
}
else
{
	echo "<h1>NOT Found!!!</h1>";
}

/*while($row = mysql_fetch_array($result, MYSQL_ASSOC))
{
echo "timedate: " . $row["logdata"]. " - field: " . $row["field"]. " - value: " . $row["value"]. "<br>";
}*/

mysql_close($conn);
?>