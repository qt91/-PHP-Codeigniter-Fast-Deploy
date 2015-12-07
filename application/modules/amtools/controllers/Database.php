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
			$this->load->model('Mdl_dbinfo');

			$db = $this->load->database('dbname');
			$data_result = $this->Mdl_dbinfo->getFields();
			$this->data['data_result'] = $data_result;
			$this->load->view('amtools/fieldInfo', $this->data);
		}

		
	}