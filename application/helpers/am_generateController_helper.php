<?php
//Create Module with table name
    function generateController($db, $table)
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
        $controllerName = explode('_', $table);
        $modelName = 'Mdl_' . $controllerName[1];
        $controllerName = $controllerName[1];
        
        
        $file = '<?php' . PHP_EOL;
        $file .= PHP_EOL; //New Line
        $file .= 'defined("BASEPATH") or exit("No direct script access allowed");' . PHP_EOL;
        $file .= PHP_EOL; //New Line
        $file .= 'class ' . ucfirst($controllerName) . ' extends AM_Controller {' . PHP_EOL;
        $file .= PHP_EOL; //New Line

        //START Construct ========================================================
        $file.='	public function __construct(){'.PHP_EOL;
		$file.='		parent::__construct();'.PHP_EOL;
		$file.='		$this->load->model(\''.$modelName.'\');'.PHP_EOL;
		$file.='	}'.PHP_EOL;
        //END Construct ========================================================
        
		//START GET ========================================================
		$file .= PHP_EOL; //New Line
		$file.='	public function GET($page_number = 0){'.PHP_EOL;
		$file.='		$page_number = (int)$page_number;'.PHP_EOL;
		$file.='		$this->setting_info[\'pagination_per_page\'] = 20;'.PHP_EOL;
		$file.=''.PHP_EOL;
		$file.='		//Search All Field'.PHP_EOL;


		$fields = $db->list_fields($table);
        
        foreach ($fields as $field) {
            $file.='		$' . $field . ' = $this->input->get(\'' . $field . '\');'.PHP_EOL;
        }
        $file .= PHP_EOL; //New Line
        $file.='		$config[\'suffix\'] = "/";'.PHP_EOL;
        $file .= PHP_EOL; //New Line
        foreach ($fields as $field) {
		
			$file.='		if($'.$field.' != false){'.PHP_EOL;
			$file.='			$arg_where[]  = array(  '.PHP_EOL;
			$file.='								\'field\'=> \''.$field.'\','.PHP_EOL;
			$file.='								\'operator\'=>\'=\','.PHP_EOL;
			$file.='								\'value\'=> $'.$field.','.PHP_EOL;
			$file.='								\'connect\'=>\'AND\','.PHP_EOL;
			$file.='								\'group\'=> 1,'.PHP_EOL;
			$file.='								\'type\'=>\'id\''.PHP_EOL;
	        $file.='		                    );'.PHP_EOL;
			$file.='			$this->data[\''.$field.'\'] = $'.$field.';'.PHP_EOL;
			$file.='			if($config[\'suffix\'] == \'/\'){'.PHP_EOL;
	        $file.='		        $config[\'suffix\'] .= \'?\'.$field.\'=$\'.$field'.PHP_EOL;
	        $file.='		    }else{'.PHP_EOL;
	        $file.='		        $config[\'suffix\'] .= \'&\'.$field.\'=$\'.$field;'.PHP_EOL;
	        $file.='		    }'.PHP_EOL;
			$file.='		}'.PHP_EOL;
			$file .= PHP_EOL; //New Line
		}

		$file.='		$arg_default = array(\'where\'=> $arg_where,'.PHP_EOL;
        $file.='		                     \'limit_start\' => 0,'.PHP_EOL;
        $file.='		                     \'limit_offset\' => 99,'.PHP_EOL;
        $file.='		                     \'order\' => \'DESC\','.PHP_EOL;
        $file.='		                     \'order_field\' => \'id\','.PHP_EOL;
        $file.='		                     \'result\'=>\'rows\','.PHP_EOL;
        $file.='		                     \'debug\'=> false'.PHP_EOL;
        $file.='		                    );'.PHP_EOL;

		$file.=''.PHP_EOL;
        $file.='		$this->data[\'data\'] = $this->mdl_company->select($arg_default);'.PHP_EOL;

        //Pagination
        $file.='		$config[\'base_url\'] = base_url(\''.$controllerName.'/get\');'.PHP_EOL;
		$file.='		'.PHP_EOL;
        $file.='		$config[\'total_rows\'] = $this->data[\'data\'][\'count\'];'.PHP_EOL;
		$file.='		'.PHP_EOL;
        $file.='		//Get pagination_per_page from setting'.PHP_EOL;
        $file.='		$this->data[\'data\'][\'page\'] = $page_number;'.PHP_EOL;
        $file.='		$this->data[\'data\'][\'per_page\'] = $this->setting_info[\'pagination_per_page\'];'.PHP_EOL;
        $file.='		$config[\'per_page\'] = $this->setting_info[\'pagination_per_page\'];'.PHP_EOL;
        $file.='		$this->pagination->initialize($config); '.PHP_EOL;

		
		$file.=''.PHP_EOL;
		$file.='	}'.PHP_EOL;
        //END GET ========================================================
        
        $file .= '}'; //End Class
        
        file_put_contents(APPPATH . "/controllers/" . $controllerName . ".php", $file);
    }