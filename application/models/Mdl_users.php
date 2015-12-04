<?php

defined("BASEPATH") or exit("No direct script access allowed");
class Mdl_users extends AM_Model {

    public $id;
    public $username;
    public $password;
    public $title;
    public $name;
    public $email;
    public $create_date;
    public $status;

    public $tableName          = 'tbl_users';
    public $primaryColumn      = 'id';

    public    $listField=array(
        "id"=>$this->id,
        "username"=>$this->username,
        "password"=>$this->password,
        "title"=>$this->title,
        "name"=>$this->name,
        "email"=>$this->email,
        "create_date"=>$this->create_date,
        "status"=>$this->status,
    );

    public function __construct(){
        parent::__construct();
        $this->init($this->tableName, $this->primary_column_name);
    }

        
    //START SET ============================================================
    public function getId(){
        return $this->id;
    }

    public function getUsername(){
        return $this->username;
    }

    public function getPassword(){
        return $this->password;
    }

    public function getTitle(){
        return $this->title;
    }

    public function getName(){
        return $this->name;
    }

    public function getEmail(){
        return $this->email;
    }

    public function getCreate_date(){
        return $this->create_date;
    }

    public function getStatus(){
        return $this->status;
    }

    //END SET ============================================================

    //START GET ============================================================
    public function setId($value){
        $this->id=$value;
    }

    public function setUsername($value){
        $this->username=$value;
    }

    public function setPassword($value){
        $this->password=$value;
    }

    public function setTitle($value){
        $this->title=$value;
    }

    public function setName($value){
        $this->name=$value;
    }

    public function setEmail($value){
        $this->email=$value;
    }

    public function setCreate_date($value){
        $this->create_date=$value;
    }

    public function setStatus($value){
        $this->status=$value;
    }

    //END SET ============================================================
}