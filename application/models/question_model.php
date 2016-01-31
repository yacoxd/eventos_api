<?php if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class Question_model extends MY_Model {

    /**
     * Overloads default parameters
     */
    public $_table = 'ev_question';
    public $primary_key = 'qu_id';
    public $return_type = RETURN_TYPE;

    public function __construct() {

        parent::__construct();
    }

}

/* End of file role_model.php */
/* Location: ./application/models/question_model.php */
