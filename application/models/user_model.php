<?php if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class User_model extends MY_Model {

    /**
     * Overloads default parameters
     */
    public $_table = 'ev_user';
    public $primary_key = 'us_id';
    public $return_type = RETURN_TYPE;

    public function __construct() {

        parent::__construct();
    }
    
   

}

/* End of file role_model.php */
/* Location: ./application/models/user_model.php */
