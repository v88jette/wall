<?php

class Reply extends CI_Model {

    public function create($user_id, $reply){
        try{
            $result = ['status'=>true, 'result'=>[], 'message'=>'Success'];

            $insert_query = "INSERT INTO `replies` (`user_id`, `post_id`, `content`) VALUES (?, ?, ?)";
            $query_result = $this->db->query($insert_query, [$user_id, $reply['post_id'], $reply['content']]);
            
            if(!$query_result){
                throw new Exception('Failed to add new reply');
            }

            $result['result'] = $query_result;
        }catch(Exception $e){
            $result['status']   = false;
            $result['message']  = $e->getMessage();
        }finally{
            return $result;
        }
    }

    public function destroy($reply_id){
        try{
            $result = ['status'=>true, 'result'=>[], 'message'=>'Success'];

            $delete_query = "DELETE FROM `replies` WHERE (`id` = ?)";
            $query_result = $this->db->query($delete_query, $reply_id);
            
            if(!$query_result){
                throw new Exception('Failed to delete a reply');
            }

            $result['result'] = $query_result;
        }catch(Exception $e){
            $result['status']   = false;
            $result['message']  = $e->getMessage();
        }finally{
            return $result;
        }
    }
}