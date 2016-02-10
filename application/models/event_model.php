<?php if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class Event_model extends MY_Model {

    /**
     * Overloads default parameters
     */
    public $_table = 'ev_event';
    public $primary_key = 'ev_id';
    public $return_type = RETURN_TYPE;

    public function __construct() {

        parent::__construct();
    }
    
     public function get_all_assistences_by_event($event_id){
        
        $this->db->select('us_first_name,us_last_name,us_username, us_avatar, us_email,ue_cant, ue_date')
                ->from($this->_table)
                ->join('ev_user_event', 'ue_event = ev_id')
                ->join('ev_user', 'ue_user = us_id')
                ->where('ev_id', $event_id)
                ->group_by('us_id');
                
        $query = $this->db->get();
                
        if ($query->num_rows() == 0) {
            return false;
        } else {
            return $query->result_array();
        }
        
    }

    public function get_total_assistences_by_event($event_id){
        
        $this->db->select('ifnull(sum(ue_cant),0) as total')
                ->from($this->_table)
                ->join('ev_user_event', 'ue_event = ev_id')
                ->join('ev_user', 'ue_user = us_id')
                ->where('ev_id', $event_id)
                ->group_by('ev_id');
                
        $query = $this->db->get();
                
        if ($query->num_rows() == 0) {
            return array('total' => 0);
        } else {
            return $query->row_array();
        }
        
    }

}

/* End of file role_model.php */
/* Location: ./application/models/user_model.php */
