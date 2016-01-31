<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @category    API
 * @author      Abner Tellez
 * @date        Enero 2016
*/

require APPPATH.'/libraries/REST_Controller.php';

class Questions extends REST_Controller{

    public function __construct() {
        parent::__construct();
        
        $this->size_response = 3;
        $this->user_id = 1;
        $this->user_username = 'yacoxd';
    }

    function all_questions_get(){
        
        $questions = $this->question->get_all();
        $response = array();
        
        foreach($questions as $question) {
            $response[]['question'] = @$question;
            $options = $this->option->get_many_by(array('op_question' => $question['qu_id']));
            $response[]['options'] = @$options;
        }
        
        if ($response){
             $this->response($response,200);    
        } else {
            $this->response(array('msg', 'No questions'),404);
        }
    }
    
    public function send_response_post(){
        
        if (! $user =$this->user->get($this->user_id)){
            $this->response(array('msg', 'User not found, call Grumpy cat!'),500);
        }
        
        if ($this->post('option')){
            
            if (! $this->option->get($this->post('option'))){
                $this->response(array('msg', 'Option not found, call Grumpy cat!'),500);
            }
            
            $data = array(
                    'ru_user' => $this->user_id,
                    'ru_option' => $this->post('option'),  
                    'ru_date_answer' => date('Y-m-d H:i:s'),
            );
            
            if ($this->result_question_user->insert($data)){
                $this->response(array('msg', 'Success'),200);    
            } else {
                $this->response(array('msg', 'Database Problem, call Grumpy cat!'),500);
            }
            
        } else {
            $this->response(array('msg', 'Bad Request, check: option and user'),400);
        }
        
        
        
        
        
    }
    
}