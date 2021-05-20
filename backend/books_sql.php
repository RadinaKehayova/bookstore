<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

$conn = new mysqli("localhost", "root", "", "bookshop");
$conn->set_charset("utf8");

$result = $conn->query("SELECT isbn, title, created_at FROM books");

$outp = "";
while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
  if ($outp != "") {$outp .= ",";}
  $outp .= '{"isbn":"'  . $rs["isbn"] . '",';
  $outp .= '"title":"'   . $rs["title"]        . '",';
  $outp .= '"created_at":"'. $rs["created_at"]     . '"}';
}
$outp ='{"records":['.$outp.']}';
$conn->close();

echo($outp);
?>