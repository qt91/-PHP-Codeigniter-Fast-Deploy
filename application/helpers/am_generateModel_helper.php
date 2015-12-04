<?php
//Create Module with table name
    function generateModel($db, $table)
    {
        // if(file_exists(APPPATH."/models/".$table."model.php")){
        //     if(readline("The model ".$table."model.php already exists. Overwrite (Y/n)?")==="Y"){
        //         exit(PHP_EOL);
        //     }
        // }
        
        if (!$db->table_exists($table)) {
            die("This table doesn't exist. Please create first." . PHP_EOL);
        }
        //Reset name model
        $modelName = explode('_', $table);
        $modelName = 'Mdl_' . $modelName[1];
        
        
        $file = '<?php' . PHP_EOL;
        $file .= PHP_EOL; //New Line
        $file .= 'defined("BASEPATH") or exit("No direct script access allowed");' . PHP_EOL;
        
        $file .= 'class ' . ucfirst($modelName) . ' extends AM_Model {' . PHP_EOL;
        $file .= PHP_EOL; //New Line
        foreach ($db->field_data($table) as $fdata) {
            if ($fdata->primary_key == 1) {
                $pk = $fdata->name;
            }
        }
        
        isset($pk) or die("Error: no primary key." . PHP_EOL);
        
        $fields = $db->list_fields($table);
        
        foreach ($fields as $field) {
            $file .= '    public $' . $field . ';' . PHP_EOL;
        }
        
        $file .= PHP_EOL; //New Line
        $file .= '    public $tableName          = \'' . $table . '\';' . PHP_EOL;
        $file .= '    public $primaryColumn      = \'' . $pk . '\';' . PHP_EOL;
        $file .= PHP_EOL; //New Line
        
        
        $file .= '    public    $listField=array(' . PHP_EOL;
        foreach ($fields as $field) {
            $file .= '        "' . $field . '"=>$this->' . $field . ',' . PHP_EOL;
        }
        $file .= '    );' . PHP_EOL;
        $file .= PHP_EOL; //New Line
        
        //START Create Function Construct
        $file .= '    public function __construct(){' . PHP_EOL;
        $file .= '        parent::__construct();' . PHP_EOL;
        $file .= '        $this->init($this->tableName, $this->primary_column_name);' . PHP_EOL;
        $file .= '    }

        ' . PHP_EOL;
        //END Create Function Construct
        $file .= '    //START SET ============================================================' . PHP_EOL; //New Line
        foreach ($fields as $field) {
            $file .= '    public function get' . ucfirst($field) . '(){' . PHP_EOL;
            $file .= '        return $this->' . $field . ';' . PHP_EOL;
            $file .= '    }' . PHP_EOL;
            $file .= PHP_EOL;
        }
        $file .= '    //END SET ============================================================' . PHP_EOL; //New Line
        
        $file .= PHP_EOL;
        $file .= '    //START GET ============================================================' . PHP_EOL; //New Line
        foreach ($fields as $field) {
            $file .= '    public function set' . ucfirst($field) . '($value){' . PHP_EOL;
            $file .= '        $this->' . $field . '=$value;' . PHP_EOL;
            $file .= '    }' . PHP_EOL;
            $file .= PHP_EOL;
        }
        $file .= '    //END SET ============================================================' . PHP_EOL; //New Line
        
        $file .= '}'; //End Class
        
        file_put_contents(APPPATH . "/models/" . $modelName . ".php", $file);
    }