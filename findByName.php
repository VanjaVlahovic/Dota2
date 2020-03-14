<?php
if (!isset ($_GET["name"])){
echo "Parameter name not passed!";
} else {
$p=$_GET["name"];
include 'sqlclass.php';
$conn = new MySql();
$conn->dbConnect();
$result=$conn->selectAllHeroesByName($p);
while($row = $result->fetch_object()){
echo " <div id='profile'>
        <h1>". $row->heroName ."</h1>
        <img id='profileImg' src='".$row->imageSrc."'>
        <p>Type: " .$row->typename ."</p>
        <p>Attack type: " .$row->typeName ."</p>
        <h2> Biography </h2>
        <h6>". $row->biography. "</h6>
        <hr>
        <br>
        <br>
        </div>";
}
$conn->dbDisconnect();
}
?>
