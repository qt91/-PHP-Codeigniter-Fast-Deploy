<?php     
	class Xyz extends MX_Controller 
	{
		
		public function __construct(){
			
		}

		function index(){
			$this->load->model('Mdl_dbinfo');
			$this->Mdl_dbinfo->Setup();
		}

		
	}