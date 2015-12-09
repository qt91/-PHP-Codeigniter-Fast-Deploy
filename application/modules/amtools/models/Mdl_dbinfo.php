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
        //Using Helper
        $this->load->helper('am_generateModel');
        $this->load->helper('am_generateController');

        $number = array(
            'TINYINT',
            'SMALLINT',
            'MEDIUMINT',
            'INT',
            'INTEGER',
            'BIGINT',
            'FLOAT',
            'DOUBLE',
            'DOUBLE PRECISION',
            'REAL',
            'DECIMAL',
            'NUMERIC',
            'BIT'
        );
        $text   = array(
            'CHAR',
            'VARCHAR',
            'TINYBLOB',
            'TINYTEXT',
            'BLOB',
            'TEXT',
            'MEDIUMBLOB',
            'MEDIUMTEXT',
            'LONGBLOB',
            'LONGTEXT',
            'ENUM',
            'SET'
        );
        $time   = array(
            'DATE',
            'DATETIME',
            'TIMESTAMP',
            'TIME',
            'YEAR'
        );
        //date-int,date-date,date-timestamp,
        
        $this->data['DbType'] = array(
            'number' => $number,
            'text' => $text,
            'time' => $time
        );
    }
    
    /**
     * Get tables name and fields name
     * 
     */
    function getFields()
    {
        $data_result = array();

        $DBName  = (string) $this->db->database;
        $Sql     = "SHOW TABLES FROM $DBName";
        $TblName = $this->db->query($Sql);
        
        $Tbls = $TblName->result_array();
        foreach ($Tbls as $Tbl) {
            //Get Table Name
            $Tbl = $Tbl['Tables_in_' . $DBName];
            $data_result[$Tbl] = array();

            //START Get Field FROM table name ================
            $Sql         = "SHOW FIELDS FROM $DBName.$Tbl";
            $FieldResult = $this->db->query($Sql);
            $Fields      = $FieldResult->result_array();
            foreach ($Fields as $Field) {
                // echo $Field['Field'] . '<br/>';
                //Clean data
                //Check Required
                $temp = $Field;

                $ex = explode('(', $Field['Type']);
                $ex1 = $ex[0];
                if(count($ex) == 2)
                    $ex2 = str_replace(')', '', $ex[1]);
                $validation = '';
                // switch ($ex1) {
                //     case 'int':
                //         $validation .= "integer";
                //         break;
                //     case 'varchar':
                //         $validation .= "max_length[$ex2]";
                //         break;
                //     case 'text':
                //         $validation .= "max_length[$ex2]";
                //         break;
                // }

                if($Field['Null'] == 'NO'){
                    if($validation != '')
                        $validation .='|';
                    $validation .= 'required';
                }

                $Field['Validation'] = $validation;
                $data_result[$Tbl][] = $Field;
            }
            //END Get Field FROM table name ===================
        }
        return $data_result;
    }

    function ganerateFile($validation){
        $data_result = array();

        $DBName  = (string) $this->db->database;
        $Sql     = "SHOW TABLES FROM $DBName";
        $TblName = $this->db->query($Sql);
        
        $Tbls = $TblName->result_array();
        foreach ($Tbls as $Tbl) {
            //Get Table Name
            $Tbl = $Tbl['Tables_in_' . $DBName];
            $data_result[$Tbl] = array();
            
            //Create File =========================
            generateModel($this->db,$Tbl);
            generateController($this->db,$Tbl, $validation);
            ////Create File =========================
        }
        return $data_result;
    }
    
    /**
     * 
     */
    function convert_type($type)
    {
        foreach ($this->data['DbType'] as $key => $Types) {
            foreach ($Types as $Type) {
                if ($Type == strtoupper($type))
                    return $key;
            }
        }
    }
    
    
    
    public function ganerateController($table){

    }
}