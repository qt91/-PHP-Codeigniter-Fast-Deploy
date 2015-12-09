<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

/**
 * Form validation extended rules for CodeIgniter
 *
 * A list of useful rules for your form validating process.
 *
 * @package         CodeIgniter
 * @subpackage      Libraries
 * @category        Libraries
 * @author          Joseba Juaniz <patroklo@gmail.com>
 * @author          Jeroen van Meerendonk <hola@jeroen.bz>
 * @author          devbro <devbro@devbro.com> (until v2.1)
 * @license         GNU General Public License (GPL)
 * @link            https://github.com/jeroen/codeigniter-extended-rules
 * @version         3.0
 * 
 * 
 * Rules supported
 * ---------------------------------------------------------------------------------------------
 * file_required Checks if the a required file is uploaded.
 * file_size_max[size]          Returns FALSE if the file is bigger than the given size.
 * file_size_min[size]          Returns FALSE if the file is smaller than the given size.
 * file_allowed_type[type]      Tests the file extension for valid file types. You can put a group too (image,
 *                              application, word_document, code, zip).
 * file_disallowed_type[type]   Tests the file extension for no-valid file types
 * file_image_maxdim[x,y]       Returns FALSE if the image is smaller than given dimension.
 * file_image_mindim[x,y]       Returns FALSE if the image is bigger than given dimension.
 * file_image_exactdim[x,y]     Returns FALSE if the image is not the given dimension.
 * is_exactly[list]             Check if the field's value is in the list (separated by comas).
 * is_not[list]                 Check if the field's value is not permitted (separated by comas).
 * valid_hour[hour]             Check if the field's value is a valid 24 hour. [24H or 12H]
 * valid_date[format]               Check if the field's value has a valid date format.
 * valid_range_date[format]         Check if the field's value has a valid range of two date
 * 
 * 
 * Info
 * ---------------------------------------------------------------------------------------------
 * Size can be in format of 20KB (kilo Byte) or 20Kb(kilo bit) or 20MB or 20GB or ....
 * Size with no unit is assume as KB
 * Type is evaluated based on the file extention. 
 * Type can be given as several types seperated by comma
 * Type can be one of the groups of: image, application, php_code, word_document, compressed
 * 
 * 
 * Change Log
 * ---------------------------------------------------------------------------------------------
 * 4.1:
 *  Now the error field message shows all the error messages that it has and not only the first one.
 * 4.0:
 *  Where there is a file upload, now file_required and required force the user to upload a file.
 *  Added image icon mimes.
 *  Added valid_date method that checks if a field has a valid date format.
 *  Added valid_range_date method that checks if a field has a valid range of two dates.
 * 3.2:
 *  Bug fixes
 * 3.1:
 *  Added 'valid_hour'
 * 3.0:
 *  Working with CI 2.1.
 *  Separated the error messages from the library
 *  Added 'is_exactly' and 'is_not'
 * 2.1:
 *  fixed the issue: http://codeigniter.com/forums/viewthread/123816/P30/#629711
 * 
 */
 

class AM_Form_validation extends CI_Form_validation {

    function __construct($config = array())
    {
        parent::__construct($config);
        $this->CI =& get_instance();
    }

    public function error_array()
    {
        if (count($this->_error_array) === 0)
            return FALSE;
        else
            return $this->_error_array;
    }

    public function error_array_index()
    {
        if (count($this->_error_array) === 0)
            return FALSE;
        else{
            $errors = $this->_error_array;
            $new_errors = array();
            foreach($errors as $error){
                $new_errors[] = $error;
            }
            return $new_errors;
        }
    }

    public function error_array_new()
    {
        if (count($this->_error_array) === 0)
            return FALSE;
        else{
            $errors = $this->_error_array;
            $new_errors = array();
            foreach($errors as $key => $error){
                $new_errors[] = array($key, $error);
            }
            return $new_errors;
        }
    }

    public function set_rules_val($field,$description,$rule,& $form_fields){
        $this->set_rules($field,$description,$rule);
        $form_fields[] = $field;
    }

    public function get_field_value($form_fields){
        $result = array();
        foreach ($form_fields as $key => $value) {
            $result[$value] = $this->CI->input->post($value);
        }
        return $result;
    }

    function validate_phone($phone){
        $result = $this->CI->alta->format_phone($phone);
        if($result){
            return TRUE;
        } else {
            $this->CI->form_validation->set_message("validate_phone", 'Sai số điện thoại');
            return FALSE;
        }
    }
}