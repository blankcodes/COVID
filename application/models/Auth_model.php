<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_model extends CI_Model {
    function __construct(){ 
        $this->load->library('form_validation');
    }
    public function saveEmail(){
        $input['email_address'] = $this->input->post('email_address');
        $input['category'] = '0';
        $input['status'] = 'active';
        $input['created_at'] = date('Y-m-d H:i::s');
        $data['resultStatus'] = 'fail';

        $this->form_validation->set_rules(
            'email_address','Email address',
            'required|valid_email|is_unique[email_list.email_address]', 
            array(
                'required' => '%s is required !',
                'is_unique' => '%s already subscribed !',
                'valid_email' => 'Must contain a valid %s !',
            )
        );
        if($this->form_validation->run() == FALSE){
            $data['resultStatus'] = 'fail';
            $data['resultMsg'] = strip_tags(validation_errors());
        }
        else{
            $this->db->INSERT('email_list',$input);
            $data['resultStatus'] = 'success';
        }
        
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }
   
}