<?php

defined("BASEPATH") or exit("No direct script access allowed");

class Ex extends Am_controller {

	public function __construct(){
		parent::__construct();
	}

	public function index(){
		$this->data['view'] = array('title'=>'THÊM MỚI');


		$db = $this->load->database('dbname');
		$this->load->model('amtools/Mdl_dbinfo');
		$data_result = $this->Mdl_dbinfo->getFields();
		// print_r($data_result);
		$this->data['data'] = $data_result['tbl_settings'];
		
		$this->load->view('ExViewAdd', $this->data);
	}
}