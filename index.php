<!DOCTYPE html>
<html>
<head>
<title>Heroes</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript" src="findName.js"></script> 
<link rel="icon" href="assets/dota2logo.png" type="image/gif" sizes="16x16">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<?php
include 'sqlclass.php';
$conn = new MySql();
$conn->dbConnect();
?>

<div class="container">
    <div class="row justify-content-md-center">
        <div class="col-sm-10">
            <div class="card text-center">
                <div class="card-header">
                    <ul class="nav nav-pills card-header-pills">
                        <li class="nav-item">
                            <a class="nav-link active" href="index.php">All heroes</a>
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
                    </ul>
                </div>
                <div class="card-body">
                    <h5 class="card-title">New hero has arrived!</h5>
                    <p class="card-text">Don't waste your time and add him to your collection</p>
                    <a href="addNew.php" class="btn btn-primary">Add new hero</a>
                </div>
            </div>
            <h1>STRENGTH</h1>
            <hr>
            <p>Strength heroes tend to have more health and health regeneration than other heroes, making them more resilient to both physical attacks and spells.</p>
    
            <?php
                if (!$q=$conn->selectAllHeroesStrength())
                {               
                    echo "<p>Nastala je greska pri izvodenju upita</p>";
                    die();
                }
                if (mysqli_num_rows($q)==0)
                {
                    echo "Nema heroja";
                } 
                else {
                    while ($red=mysqli_fetch_array($q))
                    {
            ?>
            <div class="content_img">
                <a href = "profile.php?name=<?php echo str_replace(' ', '_', $red["heroName"]);?>"><img src="<?php echo $red["imageSrc"]; ?>"></a>
                <div><?php echo $red["heroName"]; ?></div>
            </div>
            <?php
                    }
                }
            ?>
        </div>
        <div class="col-sm-4"></div>
    </div>
   <div class="row justify-content-md-center">
        <div class="col-sm-10">
            <h1>AGILITY</h1>
            <hr>
            <p>Agility heroes are the only class of heroes to gain both damage and attack speed as their primary attribute increases, they tend to have the highest physical damage output as the game progresses</p>
    
            <?php
                if (!$q=$conn->selectAllHeroesAgility())
                {
                    echo "<p>Nastala je greska pri izvodenju upita</p>";
                    die();
                }
                if (mysqli_num_rows($q)==0)
                {
                    echo "Nema heroja";
                } 
                else {
                    while ($red=mysqli_fetch_array($q))
                    {
            ?>
            <div class="content_img">
                <a href = "profile.php?name=<?php echo str_replace(' ', '_', $red["heroName"]);?>"><img src="<?php echo $red["imageSrc"]; ?>"></a>
                <div><?php echo $red["heroName"]; ?></div>
            </div>
            <?php
                    }
                }
            ?>
        </div>
        <div class="col-sm-4"></div>
    </div>
    <div class="row justify-content-md-center">
        <div class="col-sm-10">
            <h1>INTELLIGENCE</h1>
            <hr>
            <p>Intelligence heroes tend to have a greater number of active abilities compared to other heroes; all intelligence heroes have at least three active abilities, with a large number of them having all four of their abilities being actives, and some even having 5 or more. </p>
            <hr>
            <?php
                if (!$q=$conn->selectAllHeroesIntelligence())
                {
                    echo "<p>Nastala je greska pri izvodenju upita</p>";
                    die();
                }
                if (mysqli_num_rows($q)==0)
                {
                    echo "Nema heroja";
                } 
                else {
                    while ($red=mysqli_fetch_array($q))
                    {
            ?>
            <div class="content_img">
                <a href = "profile.php?name=<?php echo str_replace(' ', '_', $red["heroName"]);?>"><img src="<?php echo $red["imageSrc"]; ?>"></a>
                <div><?php echo $red["heroName"]; ?></div>
            </div>
            <?php
                    }
                }
            ?>
        </div>
        <div class="col-sm-4"></div>
    </div>
</div>
<footer>
  <p>Posted by: Vanja Vlahovic</p>
  <p>December 2019. Belgrade</p>

</footer>
<?php
    $conn->dbDisconnect();
?>
</body>
</html>
