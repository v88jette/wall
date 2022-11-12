<?php

class Reply extends CI_Model {

	/**
	 * DOCU: This function will process the creation of a new reply/comment record
	 * Created at: Nov 1 2022
	 * @author: v88jet
    */
	public function create($data){
        $result = ['status' => true, 'result' => null, 'message' => ''];
        try{
            foreach($data as $key => $value){
                if($key === 'content' && $value === ''){
                    throw new Exception('Reply is required');
                }
                if($value === ''){
                    throw new Exception('Has missing input');
                }
                if($this->security->xss_clean($value, TRUE) === FALSE){
                    throw new Exception('Has suspicious input');
                }
            }
            if(strlen($data['content']) < 5){
                throw new Exception('Reply is too short. It must have at least 5 characters');
            }

            $insert_query = "INSERT INTO `wall`.`replies` (`user_id`, `post_id`, `content`) VALUES (?, ?, ?)";
            $run_query = $this->db->query($insert_query, $data);
            
            if(!$run_query){
              throw new Exception('Failed to create a new reply');  
            }

            $id = $this->db->insert_id();
            $query_result = [
                'user_id'       => $data['user_id'],
                'id'            => $id,
                'content'       => $data['content'],
                'created_at'    => gmdate('M d Y'),
                'author'        => 'You',
                'post_id'       => $data['post_id']
            ];
                
            $result['result'] = $query_result;
        }catch(Exception $e){   
            $result['status']   = false;
            $result['message']  = $e->getMessage();
        }finally{
            return $result;
        }
	}
}