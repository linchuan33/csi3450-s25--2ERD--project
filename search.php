<?php
// Change username and password to your MySQL account username and password
$server = "127.0.0.1";
$userName = "root";
$pass = "";
$db = "db_store";

//create connection
$con=mysqli_connect($server,$userName,$pass,$db);
// Check connection
if (mysqli_connect_errno())
{
echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

//show result
$result = mysqli_query($con, "SELECT * FROM products WHERE pro_description LIKE '%" . $_POST['query'] . "%'");

echo $_POST['query'];
echo "pro_id | pro_cost | pro_description<br>";

while ($row = mysqli_fetch_array($result))
{
  echo $row['pro_id'] . " " . $row['pro_cost'] . " " . $row['pro_description'];
  echo "<br>";
}

mysqli_close($con);
?>