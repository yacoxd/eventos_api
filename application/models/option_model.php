<?php if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class Option_model extends MY_Model {

    /**
     * Overloads default parameters
     */
    public $_table = 'ev_option';
    public $primary_key = 'op_id';
    public $return_type = RETURN_TYPE;

    public function __construct() {

        parent::__construct();
    }

}

/* End of file role_model.php */
/* Location: ./application/models/user_model.php */
