<!DOCTYPE html>
<html>
<head>
<title>Table of heroes</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
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

function fillTable(){
    $conn = new MySql();
    $conn->dbConnect();
    $heroes;
    $row=0;
    $table = "";
    $option="ASC";
    $data="basic";

    if(isset($_GET['sort'])){
        if($_GET['sort'] === 'up'){    
            $option='ASC';
        }else{
            if($_GET['sort'] === 'down'){
            $option='DESC';
            }
        }
    }
    if(isset($_GET['data'])){
        if($_GET['data'] === 'heroes'){    
            $data='basic';
        }
        if($_GET['data'] === 'names'){    
            $data='names';
        }
        if($_GET['data'] === 'types'){    
            $data='types';
        }
        if($_GET['data'] === 'attack_types'){    
            $data='attack_types';
        }
    }
    switch($data){
        case "basic":
            $heroes= $conn->selectAllHeroesAscDesc($option);
            break;
        case "names":
            $heroes = $conn->selectAllHerosNamesAscDesc($option);
            break;
        case "types":
            $heroes = $conn->selectAllHerosTypeAscDesc($option);
            break;
        case "attack_types":
            $heroes = $conn->selectAllHerosAttackTypeAscDesc($option);
            break;    
    }
    if(!$heroes){
        echo "<p>Error with getting all heroes</p>";
        die();
        }
    else{
        if (mysqli_num_rows($heroes)==0)
            {
               echo "No hero data";
            }
        else{
            while ($row=mysqli_fetch_array($heroes))
                {
                    $table.="<tr><th scope='row'>".$row["heroID"]."</th>
                    <td>
                      <div class='table_img'>
                          <img class='image_class' src='".$row["imageSrc"]."'>
                      </div>
                    </td>
                    <td>".$row["heroName"]."</td>
                    <td>".$row["typeName"]."</td>
                    <td>".$row["typename"]."</td>
                    <td><a href='edit.php?id=".$row['heroID']."'><img class='icon_img' src='assets/edit.png' /></a></td>
                    <td><a href='remove.php?id=".$row['heroID']."'><img class='icon_img' src='assets/remove.png' /></a></td></tr>";
                }
            }
        }
    return $table;
}
?>


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
                        <a class="nav-link active" href="table.php">Table heroes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="addNew.php">Add new hero</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="find.php">Fing hero by name</a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <h5 class="card-title">New hero has arrived!</h5>
                <p class="card-text">Don't waste your time and add him to your collection</p>
                <a href="addNew.php" class="btn btn-primary">Add new hero</a>
           </div>
        </div>
        <div class="table">
            <table class="table table-sm table-hover table-dark">
                <thead>
                    <tr>
                        <th scope="col">#<a href="table.php?sort=up&data=heroes"> &#9650;</a>
                            <a href="table.php?sort=down&data=heroes">  &#9660;</a> </th>
                        <th scope="col">Image</th>
                        <th scope="col">Name<a href="table.php?sort=up&data=names"> &#9650;</a>
                            <a href="table.php?sort=down&data=names">  &#9660;</a> </th>
                        <th scope="col">Attack type<a href="table.php?sort=up&data=attack_types"> &#9650;</a>
                            <a href="table.php?sort=down&data=attack_types">  &#9660;</a> </th>
                        <th scope="col">Type<a href="table.php?sort=up&data=types"> &#9650;</a>
                            <a href="table.php?sort=down&data=types">  &#9660;</a> </th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php echo fillTable();?>
                </tbody>
            </table>
        </div>
    </div>
  </div>
</div>

<footer>
  <p>Posted by: Vanja Vlahovic</p>
  <p>December 2019. Belgrade</p>
</footer>
</body>
</html>
