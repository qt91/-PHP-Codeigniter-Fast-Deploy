<?php

defined("BASEPATH") or exit("No direct script access allowed");
class Mdl_settings extends AM_Model {

    public $id;
    public $name;
    public $value;
    public $description;
    public $type;
    public $state;

    public $tableName          = 'tbl_settings';
    public $primaryColumn      = 'id';

    public    $listField=array(
        "id"=>$this->id,
        "name"=>$this->name,
        "value"=>$this->value,
        "description"=>$this->description,
        "type"=>$this->type,
        "state"=>$this->state,
    );

    public function __construct(){
        parent::__construct();
        $this->init($this->tableName, $this->primary_column_name);
    }

        
    //START SET ============================================================
    public function getId(){
        return $this->id;
    }

    public function getName(){
        return $this->name;
    }

    public function getValue(){
        return $this->value;
    }

    public function getDescription(){
        return $this->description;
    }

    public function getType(){
        return $this->type;
    }

    public function getState(){
        return $this->state;
    }

    //END SET ============================================================

    //START GET ============================================================
    public function setId($value){
        $this->id=$value;
    }

    public function setName($value){
        $this->name=$value;
    }

    public function setValue($value){
        $this->value=$value;
    }

    public function setDescription($value){
        $this->description=$value;
    }

    public function setType($value){
        $this->type=$value;
    }

    public function setState($value){
        $this->state=$value;
    }

    //END SET ============================================================
}