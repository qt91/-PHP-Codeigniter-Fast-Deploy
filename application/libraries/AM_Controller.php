<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class AM_Controller extends MX_Controller
{
    var $form_fields = array(); //Container errors form validate
    var $data = array(); //Cantainer all data send to View
    var $sess = array(); //Session 
    var $setting_info = array(); //Container array setting with key and value
    
    public function __construct()
    {
        parent::__construct();
        // $this->load->model('settings/mdl_settings');
        
        // $user = $this->session->userdata('datauser');
        // $this->data['session'] = null;
        // if($user)
        //     $this->data['session'] = $user;
        
        // $arr = $this->mdl_settings->select_all();
        
        //Get all setting if exist
        // if($arr != false){
        //     foreach($arr as $key=>$val){
        //         $aTemp[$val['set_key']] = $val['set_value'];
        //     }
        //     $this->setting_info = $aTemp;
        //     $data['setting_info'] = $this->setting_info;
        // }
        
    }
    
    /**
     * Check login === 
     */
    public function is_logged()
    {
        $user = $this->session->userdata('datauser');
        if($user)
            return true;
        else
            return false;
    }
    
    /**
     * Show Error with ison format
     * $_POST['result_type'] quy dinh kieu du lieu tra ve (bool/int) cua Flag
     * $_POST['result_format'] quy dinh kieu dua lieu tra ve (json/text) cuar dat
     * 
     * @param   $msg string Noi dung thong bao
     * @param   $data mixed Du lieu kem them
     * @param   $result Ket qua tra ve ( Flag )
     */
    public function qt_error($msg,$data = 0,$result = false){
        $json_out = array('msg'=>$msg,
                         'dat'=>$data);
                 
        if(isset($_POST['result_type'])){
            if($_POST['result_type'] == 'bool'){
                $json_out['result'] = (bool)$result;
            }elseif(($_POST['result_type'] == 'int')){
                $json_out['result'] = (int)$result;
            }
        }else{
            $json_out['result'] = $result;
        }
        
        if(isset($_POST['result_format'])){
            if($_POST['result_format'] == 'text'){
                print_r($json_out);
            }
        }else{
            header('Content-Type: application/json');
            echo json_encode($json_out);   
        }
        exit();
    }

    /**
     * Show Success with ison format
     * $_POST['result_type'] quy dinh kieu du lieu tra ve (bool/int) cua Flag
     * $_POST['result_format'] quy dinh kieu dua lieu tra ve (json/text) cuar dat
     * 
     * @param   $msg string Noi dung thong bao
     * @param   $data mixed Du lieu kem them
     * @param   $result Ket qua tra ve ( Flag )
     */
    public function qt_success($msg,$data = 0, $result = true){
        $json_out = array('msg'=>$msg,
                         'dat'=>$data);
                 
        if(isset($_POST['result_type'])){
            if($_POST['result_type'] == 'bool'){
                $json_out['result'] = (bool)$result;
            }elseif(($_POST['result_type'] == 'int')){
                $json_out['result'] = (int)$result;
            }
        }else{
            $json_out['result'] = $result;
        }
        
        if(isset($_POST['result_format'])){
            if($_POST['result_format'] == 'text'){
                print_r($json_out);
            }
        }else{
            header('Content-Type: application/json');
            echo json_encode($json_out);   
        }
        exit();
    }
    
    /**
     * @param $_POST['update'] = array
     */
    function qt_update(){
        
        $_POST['update'] = array();
    }
    
    function qt_delete($id = 0){
        $id = (int)$id;
        
    }


    // dung lai v1

    
    /**
     * Show One message error validate form
     */
    public function qt_error_validate(){
        $er = validation_errors();
        $er = explode('</p>',$er);
        $this->qt_error(strip_tags($er[0]));
        /*
        foreach($er as $key=>$val)
        {
            $this->qt_error(strip_tags($val));
        }
        */
    }

    /**
     * Upload file
     */
    public function qtUpload($FileInput, $Path, $FileName,$Overwrite = FALSE)
    {
        $config['upload_path'] = $Path;
        $config['allowed_types'] = '*';
        $config['max_size'] = '99999999999';
        $config['overwrite'] = $Overwrite;
        //Doi ten file anh
        $config['file_name'] = $FileName;
        $CI =& get_instance();
        $CI->load->library('upload',$config);
        $CI->upload->initialize($config);
        if (!$CI->upload->do_upload($FileInput))
        {
            $this->data['errors'][] = $FileName.' - '.$CI->upload->display_errors();   
        }
        else
        {
            $NameImage = $CI->upload->data();
            $this->data['file_name'] = $NameImage['file_name'];
        }       
    }


}

?>