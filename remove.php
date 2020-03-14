<?php
include 'sqlclass.php';
$conn = new MySql();
$conn->dbConnect();
$id=$_GET['id'];
$conn->delete($id);
header("Location:table.php");
 ?>