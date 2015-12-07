<?php

defined("BASEPATH") or exit("No direct script access allowed");

class Fields extends AM_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('Mdl_fields');
	}

	public function GET($page_number = 0){
		$page_number = (int)$page_number;
		$this->setting_info['pagination_per_page'] = 20;

		//Search All Field
		$id = $this->input->get('id');
		$json = $this->input->get('json');

		$config['suffix'] = "/";

		if($id != false){
			$arg_where[]  = array(  
								'field'=> 'id',
								'operator'=>'=',
								'value'=> $id,
								'connect'=>'AND',
								'group'=> 1,
								'type'=>'id'
		                    );
			$this->data['id'] = $id;
			if($config['suffix'] == '/'){
		        $config['suffix'] .= '?'.$field.'=$'.$field
		    }else{
		        $config['suffix'] .= '&'.$field.'=$'.$field;
		    }
		}

		if($json != false){
			$arg_where[]  = array(  
								'field'=> 'json',
								'operator'=>'=',
								'value'=> $json,
								'connect'=>'AND',
								'group'=> 1,
								'type'=>'id'
		                    );
			$this->data['json'] = $json;
			if($config['suffix'] == '/'){
		        $config['suffix'] .= '?'.$field.'=$'.$field
		    }else{
		        $config['suffix'] .= '&'.$field.'=$'.$field;
		    }
		}

		$arg_default = array('where'=> $arg_where,
		                     'limit_start' => 0,
		                     'limit_offset' => 99,
		                     'order' => 'DESC',
		                     'order_field' => 'id',
		                     'result'=>'rows',
		                     'debug'=> false
		                    );

		$this->data['data'] = $this->mdl_company->select($arg_default);
		$config['base_url'] = base_url('fields/get');
		
		$config['total_rows'] = $this->data['data']['count'];
		
		//Get pagination_per_page from setting
		$this->data['data']['page'] = $page_number;
		$this->data['data']['per_page'] = $this->setting_info['pagination_per_page'];
		$config['per_page'] = $this->setting_info['pagination_per_page'];
		$this->pagination->initialize($config); 

	}
}