<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_model extends CI_Model {
    public function saveEmail(){
        $checkEmail = $this->checkEmail($this->input->post('email'));
        $input = array(
            'email_address'=>$this->input->post('email'),
            'category'=> '0',
            'status'=>'active',
            'created_at'=>date('Y-m-d H:i::s'),
        );
        $data['resultStatus'] = 'fail';
        if($checkEmail <= 0){
            $this->db->INSERT('email_list',$input);
            if($this->db->insert_id()){
                $data['resultStatus'] = 'success';
            }
        }
        else{
            $data['resultStatus'] = 'exist';
        }
        
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }
    public function checkEmail($email_address){
        return $this->db->WHERE('email_address', $email_address)
            ->GET('email_list')->num_rows();
    }
}