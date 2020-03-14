<?php

include 'dbconfig.php';

class Mysql extends Dbconfig    {

public $connectionString;
public $dataSet;
private $sqlQuery;

    protected $databaseName;
    protected $hostName;
    protected $userName;
    protected $passCode;

function Mysql()    {
    $this->connectionString = NULL;
    $this->sqlQuery = NULL;
    $this->dataSet = NULL;

            $dbPara = new Dbconfig();
            $this->databaseName = $dbPara->dbName;
            $this->hostName = $dbPara->serverName;
            $this->userName = $dbPara->userName;
            $this->passCode = $dbPara->passCode;
            //$dbPara = NULL;
}

function dbConnect()    {
    $this->connectionString = mysqli_connect($this->serverName,$this->userName,$this->passCode);
    mysqli_select_db($this->connectionString, $this->databaseName);
    return $this->connectionString;
}

function dbDisconnect() {
    $this->connectionString = NULL;
    $this->sqlQuery = NULL;
    $this->dataSet = NULL;
            $this->databaseName = NULL;
            $this->hostName = NULL;
            $this->userName = NULL;
            $this->passCode = NULL;
}

function selectAll($tableName)  {
    $this->sqlQuery = 'SELECT * FROM '.$this->databaseName.'.'.$tableName;
    $this->dataSet = mysqli_query($this->connectionString, $this->sqlQuery);
            return $this->dataSet;
}

function selectAllHeroesAscDesc($option)  {
    $this->sqlQuery = 'SELECT hero.heroID, hero.heroName, hero.imageSrc, type.typename, attack_type.typeName  
                    FROM ((hero INNER JOIN type ON hero.typeID = type.typeid) 
                                INNER JOIN attack_type ON hero.attack_typeID = attack_type.typeID)
                                ORDER BY hero.heroID '.$option;
    $this->dataSet = mysqli_query($this->connectionString, $this->sqlQuery);
            return $this->dataSet;
}
function selectAllHerosNamesAscDesc($option) {
    $this->sqlQuery = 'SELECT hero.heroID, hero.heroName, hero.imageSrc, type.typename, attack_type.typeName 
                    FROM ((hero INNER JOIN type ON hero.typeID = type.typeid)
                     INNER JOIN attack_type ON hero.attack_typeID = attack_type.typeID) 
                     ORDER BY hero.heroName '.$option;
    $this->dataSet = mysqli_query($this->connectionString, $this->sqlQuery);
            return $this->dataSet;
}
function selectAllHerosTypeAscDesc($option){
    $this->sqlQuery = 'SELECT hero.heroID, hero.heroName, hero.imageSrc, type.typename, attack_type.typeName  
                    FROM ((hero INNER JOIN type ON hero.typeID = type.typeid) 
                                INNER JOIN attack_type ON hero.attack_typeID = attack_type.typeID)
                                ORDER BY type.typename '.$option;
    $this->dataSet = mysqli_query($this->connectionString, $this->sqlQuery);
            return $this->dataSet;
}
function selectAllHerosAttackTypeAscDesc($option){
    $this->sqlQuery = 'SELECT hero.heroID, hero.heroName, hero.imageSrc, type.typename, attack_type.typeName  
                    FROM ((hero INNER JOIN type ON hero.typeID = type.typeid) 
                                INNER JOIN attack_type ON hero.attack_typeID = attack_type.typeID)
                                ORDER BY attack_type.typeName '.$option;
    $this->dataSet = mysqli_query($this->connectionString, $this->sqlQuery);
            return $this->dataSet;
}

function selectAllHeroesStrength()  {
    $this->sqlQuery ='SELECT * FROM `hero` WHERE typeID=1';
    $this->dataSet = mysqli_query($this->connectionString, $this->sqlQuery);
            return $this->dataSet;
}
function selectAllHeroesAgility()  {
    $this->sqlQuery ='SELECT * FROM `hero` WHERE typeID=2';
    $this->dataSet = mysqli_query($this->connectionString, $this->sqlQuery);
            return $this->dataSet;
}
function selectAllHeroesIntelligence()  {
    $this->sqlQuery ='SELECT * FROM `hero` WHERE typeID=3';
    $this->dataSet = mysqli_query($this->connectionString, $this->sqlQuery);
            return $this->dataSet;
}
function selectAllAttackTypes(){
    $this->sqlQuery = 'SELECT * FROM attack_type';
    $this->dataSet = mysqli_query($this->connectionString, $this->sqlQuery);
    return $this->dataSet;
}

function selectAllHeroesByName($name){
    $this->sqlQuery = "SELECT hero.heroID, hero.heroName, hero.imageSrc, hero.biography, type.typename, attack_type.typeName  
    FROM ((hero INNER JOIN type ON hero.typeID = type.typeid) 
                INNER JOIN attack_type ON hero.attack_typeID = attack_type.typeID) WHERE hero.heroName='".$name."'";
    $this->dataSet = mysqli_query($this->connectionString, $this->sqlQuery);
    return $this->dataSet;
}

function selectAllHeroesByNameSuggest($name){
    $this->sqlQuery = "SELECT * from hero where heroName LIKE '".$name."%'";
    $this->dataSet = mysqli_query($this->connectionString, $this->sqlQuery);
    return $this->dataSet;
}

function selectAllTypes(){
    $this->sqlQuery = 'SELECT * FROM `type`';
    $this->dataSet = mysqli_query($this->connectionString, $this->sqlQuery);
            return $this->dataSet;
}
public function insert($name, $src, $attackId, $typeId, $bio){
    $this->sqlQuery = 'INSERT into hero VALUES (null, "'.$name.'","'.$src.'",'.$attackId.' , '.$typeId.', "'.$bio.'")';
    if (mysqli_query($this->connectionString, $this->sqlQuery)=== TRUE) {
        return "New record created successfully";
    } else {
        return "Error: " . $this->sqlQuery . "<br>";
    }
}

function delete($id){
    $this->sqlQuery="DELETE from hero WHERE heroID=".$id;
    if (mysqli_query($this->connectionString, $this->sqlQuery)=== TRUE) {
        return "You deleted hero with id: ".$id;
    } else {
        return "Error: " . $this->sqlQuery . "<br>";
    }
}

function returnHero($id){
    $this->sqlQuery="SELECT * FROM `hero` WHERE heroID=".$id;
    return mysqli_query($this->connectionString, $this->sqlQuery);
}

function update($id, $name, $src, $atID, $tID, $bio){
    $this->sqlQuery = 'UPDATE hero SET heroName="'.$name.'", imageSrc="'.$src.'", attack_typeID='.$atID.', typeID='.$tID.', biography="'.$bio.'" WHERE heroID='.$id;
    if (mysqli_query($this->connectionString, $this->sqlQuery)=== TRUE) {
        return "Hero has been updated";
    } else {
        return "Error: " . $this->sqlQuery . "<br>";
    }
}

}
?>