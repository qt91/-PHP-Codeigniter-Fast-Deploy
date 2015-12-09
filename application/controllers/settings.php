<?php

defined("BASEPATH") or exit("No direct script access allowed");

class Settings extends AM_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('Mdl_settings');
	}

	public function GET($page_number = 0){
		$page_number = (int)$page_number;
		$this->setting_info['pagination_per_page'] = 20;

		//Search All Field
		$id = $this->input->get('id');
		$name = $this->input->get('name');
		$value = $this->input->get('value');
		$description = $this->input->get('description');
		$type = $this->input->get('type');
		$state = $this->input->get('state');

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

		if($name != false){
			$arg_where[]  = array(  
								'field'=> 'name',
								'operator'=>'=',
								'value'=> $name,
								'connect'=>'AND',
								'group'=> 1,
								'type'=>'id'
		                    );
			$this->data['name'] = $name;
			if($config['suffix'] == '/'){
		        $config['suffix'] .= '?'.$field.'=$'.$field
		    }else{
		        $config['suffix'] .= '&'.$field.'=$'.$field;
		    }
		}

		if($value != false){
			$arg_where[]  = array(  
								'field'=> 'value',
								'operator'=>'=',
								'value'=> $value,
								'connect'=>'AND',
								'group'=> 1,
								'type'=>'id'
		                    );
			$this->data['value'] = $value;
			if($config['suffix'] == '/'){
		        $config['suffix'] .= '?'.$field.'=$'.$field
		    }else{
		        $config['suffix'] .= '&'.$field.'=$'.$field;
		    }
		}

		if($description != false){
			$arg_where[]  = array(  
								'field'=> 'description',
								'operator'=>'=',
								'value'=> $description,
								'connect'=>'AND',
								'group'=> 1,
								'type'=>'id'
		                    );
			$this->data['description'] = $description;
			if($config['suffix'] == '/'){
		        $config['suffix'] .= '?'.$field.'=$'.$field
		    }else{
		        $config['suffix'] .= '&'.$field.'=$'.$field;
		    }
		}

		if($type != false){
			$arg_where[]  = array(  
								'field'=> 'type',
								'operator'=>'=',
								'value'=> $type,
								'connect'=>'AND',
								'group'=> 1,
								'type'=>'id'
		                    );
			$this->data['type'] = $type;
			if($config['suffix'] == '/'){
		        $config['suffix'] .= '?'.$field.'=$'.$field
		    }else{
		        $config['suffix'] .= '&'.$field.'=$'.$field;
		    }
		}

		if($state != false){
			$arg_where[]  = array(  
								'field'=> 'state',
								'operator'=>'=',
								'value'=> $state,
								'connect'=>'AND',
								'group'=> 1,
								'type'=>'id'
		                    );
			$this->data['state'] = $state;
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
		$config['base_url'] = base_url('settings/get');
		
		$config['total_rows'] = $this->data['data']['count'];
		
		//Get pagination_per_page from setting
		$this->data['data']['page'] = $page_number;
		$this->data['data']['per_page'] = $this->setting_info['pagination_per_page'];
		$config['per_page'] = $this->setting_info['pagination_per_page'];
		$this->pagination->initialize($config); 

	}
  //Add new row
    public function POST(){
  
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
          //Form validation       
            $this->form_validation->set_rules_val('id','Mã','required,integer',$this->form_fields);
            $this->form_validation->set_rules_val('name','name','required,alpha_numericmin_length[2]|max_length[12]|exact_length[120]|greater_than[212]|greater_than_equal_to[43254]|less_than[158]|less_than_equal_to[245]',$this->form_fields);
            $this->form_validation->set_rules_val('value','value','required',$this->form_fields);
            $this->form_validation->set_rules_val('description','description','required',$this->form_fields);
            $this->form_validation->set_rules_val('type','type','required',$this->form_fields);
            $this->form_validation->set_rules_val('state','state','required',$this->form_fields);
            //Run from validation
              if($this->form_validation->run()){
                  $fields = $this->form_validation->get_field_value($this->form_fields);
                      extract($fields);
  
                    if($this->mdl_companies->insert($fields,1)){
                        $this->qt_success('Thêm mới thành công!');
                   }else{
                       $this->qt_error('Thêm mới không thành công!');
                   }
           }else{
               //show validate
                $this->qt_error_validate();
             }
          }else{
           $this->load->view('Post', $this->data);
       }
    }
}