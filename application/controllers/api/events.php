<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @category    API
 * @author      Abner Tellez
 * @date        Enero 2016
*/

require APPPATH.'/libraries/REST_Controller.php';

class Events extends REST_Controller{

    public function __construct() {
        parent::__construct();
        
        $this->size_response = 3;
        $this->user_id  = $this->session->userdata('user_id');
        $this->user_username = $this->session->userdata('username');
    }

    function all_events_get(){
        
        if ($this->get('before')) {
            $id = $this->get('before');
            $events = $this->event->limit($this->size_response)->order_by('ev_id', 'desc')->get_many_by(array('ev_id > ' => $id ));    
        } else if ($this->get('after')) {
            $id = $this->get('after');
            $events = $this->event->limit($this->size_response)->order_by('ev_id', 'desc')->get_many_by(array('ev_id < ' => $id ));
        } else {
            $events = $this->event->limit($this->size_response)->order_by('ev_id', 'desc')->get_all();
        }
        
        $response = array();
        
        foreach($events as $event){
            //$response[]['info'] = @$event;
            $directory = "uploads/".$event['ev_id']."/";
            $images = glob($directory . "*.jpg");
            $images_event = array();
            
            if ($images){
                foreach($images as $image){
                    $images_event[] = base_url().$image;
                }    
            }
            
            $assistants = $this->event->get_all_assistences_by_event($event['ev_id']);
            $total_assistants = $this->event->get_total_assistences_by_event($event['ev_id']);
            
            //$response[]['info']['images'] = @$images_event;
            //$response[]['info']['assistants'] = @$assistants;

            $response[] = array(
                    'info' => @$event,
                    'date' => date('d-m-Y h:i:s a', strtotime(@$event['ev_date_time'])),
                    'image' => @$images_event,
                    'assistants' => @$assistants,
                    'total_assistants' => @$total_assistants,
                );

        }
        
        if ($response){
             $this->response($response,200);    
        } else {
            $this->response(array('msg', 'No event'),404);
        }
    }
    
    public function go_event_post(){
        
        if (! $user =$this->user->get($this->user_id)){
            $this->response(array('msg', 'User not found, call Grumpy cat!'),500);
        }
        
        if ($this->post('cant') && $this->post('event_id')){
            
            $data = array(
                    'ue_user' => $this->user_id,
                    'ue_event' => $this->post('event_id'),  
                    'ue_cant' => $this->post('cant'),
                    'ue_date' => date('Y-m-d H:i:s'),
            );
            
            if ($this->user_event->insert($data)){
                $this->response(array('msg', 'Success'),200);    
            } else {
                $this->response(array('msg', 'Database Problem, call Grumpy cat!'),500);
            }
            
        } else {
            $this->response(array('msg', 'Bad Request, check: cant, event_id, user_id'),400);
        }
        
        
        
        
        
    }
    
}