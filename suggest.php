<?php
if (!isset ($_GET["in"])){
echo "Parameter input not passed!";
} else {
$p=$_GET["in"];
include 'sqlclass.php';
$conn = new MySql();
$conn->dbConnect();
$result=$conn->selectAllHeroesByNameSuggest($p);

if ($result->num_rows==0){
echo "Database doesn't have name like this " . $p;
} else {
while($row = $result->fetch_object()){
?>
<a href="#" onclick="place(this)"><?php  echo $row->heroName;?></a>
<br/>
<?php
}
}
$conn->dbDisconnect();
}
?>
