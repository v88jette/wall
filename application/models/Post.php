<?php

class Post extends CI_Model {

	/**
	 * DOCU: This function will get all the post/message records
	 * Created at: Nov 1 2022
	 * @author: v88jet
    */
	public function get_all_records(){
        $result = ['status' => true, 'result' => null, 'message' => ''];
        try{
            $query = "SELECT CONCAT(pusers.fname, ' ', pusers.lname) AS author, posts.content, posts.created_at, posts.id, posts.user_id, GROUP_CONCAT(CONCAT(rusers.fname, ' ', rusers.lname),'~~~',replies.content,'~~~',replies.created_at,'~~~',replies.id,'~~~',replies.user_id,'~~~',replies.post_id) AS replies
            FROM posts
                LEFT JOIN replies ON posts.id = replies.post_id
                INNER JOIN users AS pusers ON posts.user_id = pusers.id
                LEFT JOIN users AS rusers ON replies.user_id = rusers.id
            GROUP BY posts.id
            ORDER BY posts.id DESC, replies.id DESC";
            $query_result = $this->db->query($query)->result_array();
            
            if(!$query_result){
                throw new Exception('Failed to get all post or message records');
            }

            $result['result'] = $query_result;
        }catch(Exception $e){   
            $result['status']   = false;
            $result['message']  = $e->getMessage();
        }finally{
            return $result;
        }
	}

	/**
	 * DOCU: This function will process the creation of a new post/message record
	 * Created at: Nov 1 2022
	 * @author: v88jet
    */
	public function create($data){
        $result = ['status' => true, 'result' => null, 'message' => ''];
        try{
            foreach($data as $key => $value){
                if($key === 'content' && $value === ''){
                    throw new Exception('Post is required');
                }
                if($value === ''){
                    throw new Exception('Has missing input');
                }
                if($this->security->xss_clean($value, TRUE) === FALSE){
                    throw new Exception('Has suspicious input');
                }
            }
            if(strlen($data['content']) < 5){
                throw new Exception('Post is too short. It must have at least 5 characters');
            }

            $insert_query = "INSERT INTO `wall`.`posts` (`user_id`, `content`) VALUES (?, ?)";
            $run_query = $this->db->query($insert_query, $data);
            
            if(!$run_query){
              throw new Exception('Failed to create a new post');  
            }

            $id = $this->db->insert_id();
            $query_result = [
                'user_id'       => $data['user_id'],
                'id'            => $id,
                'content'       => $data['content'],
                'created_at'    => gmdate("M d Y"),
                'author'        => 'You'];
            
            $result['result'] = $query_result;
        }catch(Exception $e){   
            $result['status']   = false;
            $result['message']  = $e->getMessage();
        }finally{
            return $result;
        }
	}
}