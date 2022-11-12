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