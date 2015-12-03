<?php

class Mdl_dbinfo extends CI_Model
{
    
    var $data;
    var $config;
    var $connect;
    var $new_db;
    function __construct()
    {
        parent::__construct();
        
        $number = array('TINYINT','SMALLINT','MEDIUMINT','INT','INTEGER','BIGINT','FLOAT','DOUBLE','DOUBLE PRECISION','REAL','DECIMAL','NUMERIC','BIT');
        $text = array('CHAR','VARCHAR','TINYBLOB','TINYTEXT','BLOB','TEXT','MEDIUMBLOB','MEDIUMTEXT','LONGBLOB','LONGTEXT','ENUM','SET');
        $time = array('DATE','DATETIME','TIMESTAMP','TIME','YEAR');
        //date-int,date-date,date-timestamp,
        
        $this->data['DbType'] = array('number'=>$number,
                                      'text'=>$text,
                                      'time'=>$time);
        // $this->load->model('m_db_table');
    }   

    public function Setup($Connect)
    {
        $this->config['id'] = $Connect->id;
        $this->config['hostname'] = $Connect->host;
        $this->config['username'] = $Connect->user;
        $this->config['password'] = $Connect->pass;
        $this->config['database'] = $Connect->data;
        $this->config['dbdriver'] = "mysql";
        $this->config['dbprefix'] = "";
        $this->config['pconnect'] = FALSE;
        $this->config['db_debug'] = TRUE;
        $this->config['cache_on'] = FALSE;
        $this->config['cachedir'] = "";
        $this->config['char_set'] = "utf8";
        $this->config['dbcollat'] = "utf8_general_ci";
        // Get info database
		
        //$this->new_db = $this->load->database($this->config,TRUE);
    }

    
}