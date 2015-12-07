<?php

defined("BASEPATH") or exit("No direct script access allowed");
class Mdl_fields extends AM_Model {

    public $id;
    public $json;

    public $tableName          = 'tbl_fields';
    public $primaryColumn      = 'id';

    public    $listField=array(
        "id"=>$this->id,
        "json"=>$this->json,
    );

    public function __construct(){
        parent::__construct();
        $this->init($this->tableName, $this->primary_column_name);
    }

        
    //START SET ============================================================
    public function getId(){
        return $this->id;
    }

    public function getJson(){
        return $this->json;
    }

    //END SET ============================================================

    //START GET ============================================================
    public function setId($value){
        $this->id=$value;
    }

    public function setJson($value){
        $this->json=$value;
    }

    //END SET ============================================================
}