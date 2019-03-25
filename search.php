<?php header('Access-Control-Allow-Origin: *');
require_once 'common.php';
require_once 'config.php';

$_POST['keyword']="body";
$connection = new PDO($dsn, $username, $password, $options);
$keyWord=$_POST['keyword'];

$sql = "SELECT * FROM service WHERE service_name LIKE '%%$keyWord%%' LIMIT 10";
$stmt=$connection->prepare($sql);
$stmt->execute();
//$result=$stmt->fetchAll(PDO::FETCH_ASSOC);
$output="";
echo "<table>";
echo "<tr><td>Service Name</td><td>Cost</td></tr>";
while ($row = $stmt->fetch()) {
    echo "<tr><td>";
    echo $row["service_name"];
    echo "</td><td>";
    echo $row["cost"];
    echo "</td></tr>";
}
echo "</table>";
