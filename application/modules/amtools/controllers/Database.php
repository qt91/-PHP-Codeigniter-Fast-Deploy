<?php     
	class Database extends MX_Controller 
	{
		
		public function __construct(){
			
		}

		function index(){
			$this->load->model('Mdl_dbinfo');
			$this->Mdl_dbinfo->Setup();
		}

		public function Create(){
			$this->load->model('Mdl_dbinfo');

			$db = $this->load->database('dbname');
			$this->Mdl_dbinfo->getFields();
		}

		
	}