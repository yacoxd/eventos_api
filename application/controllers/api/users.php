<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @category    API
 * @author      Abner Tellez
 * @date        Enero 2016
*/

require APPPATH.'/libraries/REST_Controller.php';

class Users extends REST_Controller{

    public function __construct() {
        parent::__construct();
        
        $this->user_id  = $this->session->userdata('user_id');
        $this->user_username = $this->session->userdata('username');
        
    }

    function user_get(){
        if ($user =$this->user->get($this->user_id)){
            $this->response($user, 200);
        } else {
            $this->response(array('msg', 'User not found, call Grumpy cat!'),500);
        }
    }

    function auth_post(){
        print_r($this->input->post());
        
    }

    public function edit_post(){
        
        $data = array();
        
        if (! $user = $this->user->get($this->user_id)){
            $this->response(array('msg', 'User not found, call Grumpy cat!'),500);
        }
        
        if ($this->post('username')){
          if ($this->user->get_by(array('us_username' => $this->post('username'), 'us_id !=' => $this->user_id))){
             $this->response(array('msg', 'Username already used'),201); 
          }
          $data['us_username'] = $this->post('username');
        } 

        if ($this->post('email')){
          if ($this->user->get_by(array('us_email' => $this->post('email'), 'us_id !=' => $this->user_id))){
             $this->response(array('msg', 'Email already used'),201); 
          }
          $data['us_email'] = $this->post('email');
        } 
        
        if ($this->post('first_name')) $data['us_first_name'] = $this->post('first_name');
        if ($this->post('last_name')) $data['us_last_name'] = $this->post('last_name');
        if ($this->post('pwd')) $data['us_password'] = $this->post('pwd');
        if ($this->post('gender')) $data['us_gender'] = $this->post('gender');
        if ($this->post('dob')) $data['us_dob'] = date('Y-m-d', strtotime($this->post('dob')));
        if ($this->post('us_avatar')) $data['us_avatar'] = $this->post('us_avatar');
        
        if(!empty($_FILES['photo'])){
             $path = 'uploads/users/';
             $name = 'profile_picture_'.$user['us_id'].time();
             $unlink_picture = $path . $user['us_avatar'];
             $upload_file = $this->_upload_profile($name, $path, $_FILES['photo']);
                
             if ($upload_file == FALSE) {
                 $this->response(array('msg' => 'BAD REQUEST, ERROR PHOTO'), 400);
             } else {
                 if(file_exists($unlink_picture) && $user['us_avatar'] != ''){
                     unlink($unlink_picture);
                 }
                 create_thumbnail($path . $upload_file, '800', '800', $path .  $upload_file);
                 $data['us_avatar'] = $upload_file;                    
            }    
        }
        
        $data['us_user_modified'] = $this->user_username;
        $data['us_date_modified'] = date('Y-m-d H:i:s');
            
        if ($this->user->update($this->user_id,$data)){
             $this->response(array('msg', 'Success'),200);    
        } else {
             $this->response(array('msg', 'Database Problem, call Grumpy cat!'),500);
        }
    }
    
    function register_post(){
        
        $data = array();
        
        if (!$this->post('username') 
            || !$this->post('email')
            || !$this->post('first_name')
            || !$this->post('last_name')
            || !$this->post('pwd')) {
            $this->response(array('msg', 'Bad Request Problem, call Grumpy cat!'),400);
        }
        
        if ($this->post('username')){
          if ($this->user->get_by(array('us_username' => $this->post('username'),))){
             $this->response(array('msg', 'Username already used'),201); 
          }
          $data['us_username'] = $this->post('username');
        } 

        if ($this->post('email')){
          if ($this->user->get_by(array('us_email' => $this->post('email'), ))){
             $this->response(array('msg', 'Email already used'),201); 
          }
          $data['us_email'] = $this->post('email');
        } 
        
        if ($this->post('first_name')) $data['us_first_name'] = $this->post('first_name');
        if ($this->post('last_name')) $data['us_last_name'] = $this->post('last_name');
        if ($this->post('pwd')) md5($data['us_password'] = $this->post('pwd'));
        
        if ($data) {
            
            $data['us_user_created'] = $this->user_username;
            $data['us_date_created'] = date('Y-m-d H:i:s');
            
            if ($user = $this->user->insert($data)){
                $this->response(array('msg', 'Success ' . $user),200);    
            } else {
                $this->response(array('msg', 'Database Problem, call Grumpy cat!'),500);
            }     
        } else {
            $this->response(array('msg', 'Bad Request Problem, call Grumpy cat!'),400);
        }
    }
    
    private function _upload_profile($name, $destination, $file, $name_old = FALSE) {
        
       $name = url_title($name,'-');
       if (!empty($file['name'])) {
            $uploaddir = './uploads/users/';
            $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
            $uploadfile_path = $uploaddir . $name . '.' . $ext;
            $upload_file = array();
    
            if (move_uploaded_file($file['tmp_name'], $uploadfile_path)) {
                if($name_old){
                    unlink( $uploaddir.$name_old);
                }
                $upload_file['file_name'] = $name;
            } else {
                $upload_file['error'] = '1';
            }

            if (array_key_exists('error', $upload_file) || $upload_file == FALSE) {
                return FALSE;
            } else {
                return $upload_file['file_name'] . '.' . $ext;
            }
        } else {
            return FALSE;
        }
    }
    
}