<?php

class Hero{
    
    private $name;
    private $src;
    private $roles;
    private $type;
    private $attack_type;
    private $bio;
    private $message;

    public function __construct($name, $src, $type, $attack_type, $bio){
        $this->name=$name;
        $this->src=$src;
        $this->attack_type=$attack_type;
        $this->type=$type;
        $this->bio=$bio;
    }

    public function addHero($db){
        if(empty($this->name)){
            $this->message = 'Hero name is required';
        }
        else{    
            $this->message=$db->insert($this->name, $this->src, $this->attack_type, $this->type, $this->bio);
        }
    }

    public function updateHero($db, $id){
        $this->message=$db->update($id, $this->name, $this->src, $this->attack_type, $this->type, $this->bio);
    }

    public function getMessage(){
        return $this->message;
	}
}


?>