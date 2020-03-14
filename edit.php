<!DOCTYPE html>
<?php
include 'sqlclass.php';
include 'hero.php';
$conn = new MySql();
$conn->dbConnect();
$type=$conn->selectAllTypes();
$attack_type=$conn->selectAllAttackTypes();
$message='';
$nameErr="";
$selected='';
$id=$_GET['id'];
$result =$conn->returnHero($id);
$hero=mysqli_fetch_object($result);
$name=$hero->heroName;
$src=$hero->imageSrc;
$bio=$hero->biography;
function get_optionsAttackType(){
  $conn = new MySql();
  $conn->dbConnect();
  $attack_type=$conn->selectAllAttackTypes();
  $id=$_GET['id'];
  $result =$conn->returnHero($id);
  $hero=mysqli_fetch_object($result);
  $attack_typeS=$hero->attack_typeID;
  $options='';
  foreach($attack_type as $at):
        if($attack_typeS==$at["typeID"])
            $options.='<option value="'.$at['typeID'].'" selected>'.$at['typeName'].'</option>';
        else    
            $options.='<option value="'.$at['typeID'].'">'.$at['typeName'].'</option>';
  endforeach;
  $conn->dbDisconnect();
  return $options;
}
function get_optionsType(){
  $conn = new MySql();
  $conn->dbConnect();
  $type=$conn->selectAllTypes();
  $id=$_GET['id'];
  $result =$conn->returnHero($id);
  $hero=mysqli_fetch_object($result);
  $typeS=$hero->typeID;
  
  $options='';
  foreach($type as $t):
    if($t["typeid"]==$typeS)
        $options.='<option value="'.$t['typeid'].'" selected>'.$t['typename'].'</option>';
    else
        $options.='<option value="'.$t['typeid'].'">'.$t['typename'].'</option>';
  endforeach;
  $conn->dbDisconnect();
  return $options;
}
  if($_SERVER["REQUEST_METHOD"] == "POST"){
    if (empty($_POST["name"])) {
      $nameErr = "Name is required";
    } else {
      $name =$_POST["name"];
    }
      $src=$_POST['src'];
      $attack_type=$_POST['attack_type'];
      $type=$_POST['type'];
      $bio=$_POST['bio'];

      $heroNew = new Hero($name, $src, $type, $attack_type, $bio);

      $heroNew->updateHero($conn, $id);
          
      $message = $heroNew->getMessage();

  }
?>
<html>
<head>
<title>Edit hero</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="icon" href="assets/dota2logo.png" type="image/gif" sizes="16x16">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<div class="container">
  <div class="row justify-content-md-center">
    <div class="col-sm-10">
      <div class="card text-center">
        <div class="card-header">
          <ul class="nav nav-pills card-header-pills">
            <li class="nav-item">
              <a class="nav-link" href="index.php">All heroes</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="table.php">Table heroes</a>
            </li>
            <li class="nav-item">
              <a class="nav-link " href="addNew.php">Add new hero</a>
            </li>
            <li class="nav-item">
             <a class="nav-link" href="find.php">Find hero by name</a>
            </li>
            <li class="nav-item">
             <a class="nav-link active" href="edit.php">Edit hero</a>
            </li>
          </ul>
        </div>
      </div>

      <form method ="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <div class="form-group">
          <label>Hero name *</label><span class="error"> 
            <?php echo "<p>".$nameErr."</p>"?></span>
          <input type="text" class="form-control" id="formGroupExampleInput" name="name" value="<?php echo $name;?>">
        </div>
        <div class="form-group">
          <label >Image src</label>
          <input type="text" class="form-control" id="formGroupExampleInput" name="src" value="<?php echo $src;?>">
        </div>
        <div class="form-group">
          <label >Attack type</label>
            <select class="form-control"name="attack_type">
              <?php echo get_optionsAttackType()?>
            </select>
        </div>
        <div class="form-group">
          <label >Type</label>
            <select class="form-control"  name="type">
              <?php echo get_optionsType()?>
            </select>
        </div>
        <div class="form-group">
          <label>Biography</label>
          <textarea type="text" class="form-control" id="exampleFormControlTextarea1" rows="5" name="bio"><?php echo ($bio); ?></textarea>
        </div>
        <?php echo "<p>". $message."</p>"?>
        <div class="form-group"> 
          <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" formaction="edit.php?id=<?php echo($id)?>" id="edit" name="edit" class="btn btn-success">Edit</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
<footer>
  <p>Posted by: Vanja Vlahovic</p>
  <p>12.2019. Belgrade</p>
</footer>
</body>
</html>