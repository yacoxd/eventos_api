<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth {
    private $error = array();
    function __construct() {

        $this->ci = &get_instance();
        $this->ci->load->library('session');
        $this->ci->load->model('user_model', 'user_login');

        $this->ci->load->database();
    }
    
    private function _check_password($user_pwd, $pwd_form){
        
        if (md5($pwd_form) == $user_pwd) {
            return TRUE;
        }
        
        return FALSE;
    } 

    function login($login, $password) {

        if ((strlen($login) > 0) AND (strlen($password) > 0)) {

            if ($user = $this->ci->user_login->get_by(array('us_username' => $login))) {

                if ($this->_check_password($user['us_password'], $password)) {//

                        $this->ci->session->set_userdata(array(
                            'user_id' => $user['us_id'],
                            'username' => $user['us_username'],
                            'user_fullname' => $user['us_first_name'] .' '.$user['us_last_name'],
                            'user_token' => base64_encode($user['us_username'].':'.$password),
                        ));

                        return TRUE;
                    }

                } else { // fail - wrong password
                    return FALSE;
                }
            } else {
                return FALSE;
            }
        }
}

/* End of file Auth.php */
/* Location: ./application/libraries/Auth.php */
