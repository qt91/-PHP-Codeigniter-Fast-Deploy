<?php

function get_validation($type = ''){
	if($type == ''){
		$out = array(
		'required',
		'alpha',
		'alpha_numeric',
		'alpha_numeric_spaces',
		'numeric',
		'integer',
		'decimal',
		'is_natural',
		'is_natural_no_zero',
		'valid_url',
		'valid_email',
		'valid_emails',
		'valid_ip',
		'valid_base64'
		);
		echo "'".implode("','",$out)."'";
	}
}

function getValidationNumber($type = 0){
	$out = array(
					'min_length' => '',
					'max_length' => '',
					'exact_length'=> '',
					'greater_than'=>'',
					'greater_than_equal_to'=>'',
					'less_than'=>'',
					'less_than_equal_to'=>''
					 );
	$str_out = '';
	if($type == 0){
		foreach ($out as $key => $value) {
			$str_out .= '<div class="editable-address am-editable-address"><label><span>'.$key.': </span><input type="text" name="'.$key.'" class="input-xlarge am-editable-input"></label></div>';
		}
		$str_out = "'".$str_out."'";
	}elseif($type == 1){
		foreach ($out as $key => $value) {
			$str_out .= ''.$key .': this.$input.filter(\'[name="'.$key .'"]\').val(),';
		}
	}elseif($type == 2){
		foreach ($out as $key => $value) {
			$str_out .= 'this.$input.filter(\'[name="'.$key.'"]\').val(value.'.$key.');';
		}
	}elseif($type == 3){
		$count = 0;
		foreach ($out as $key => $value) {
			$count++;
			$str_out .= 'if($("<div>").text(value.'.$key.').html() != ""){
				        	html += "'.$key.'["+$("<div>").text(value.'.$key.').html()+"],";
				        }';
			
		}
	}
	echo $str_out;
}