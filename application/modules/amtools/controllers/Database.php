<?php     
	class Database extends MX_Controller 
	{
		var $data;
		public function __construct(){
			
		}

		function index(){
			$this->load->model('Mdl_dbinfo');
			$this->Mdl_dbinfo->Setup();
		}

		public function Create(){
			
			$db = $this->load->database('dbname');
			$this->load->model('Mdl_dbinfo');
			if($_SERVER['REQUEST_METHOD'] == 'POST'){
				// print_r($_POST);
				$this->Mdl_dbinfo->ganerateFile($_POST);
			}else{
				
				$data_result = $this->Mdl_dbinfo->getFields();

				$this->data['data_result'] = $data_result;
				$this->load->view('amtools/fieldInfo', $this->data);	
			}
		}

		
	}