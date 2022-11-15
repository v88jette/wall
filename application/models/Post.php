<?php

class Post extends CI_Model {

    public function get_all_records(){
        try{
            $result = ['status'=>true, 'result'=>[], 'message'=>'Success'];

            $select_query =  "SELECT CONCAT(pusers.fname, ' ', pusers.lname) AS author, posts.content, posts.id, 
                                DATE_FORMAT(posts.created_at, '%b %d %Y') AS created_at, posts.user_id,
                                GROUP_CONCAT(CONCAT(rusers.fname, ' ', rusers.lname),'~~~',replies.content,'~~~',
                                DATE_FORMAT(replies.created_at, '%b %d %Y'),'~~~',replies.id,'~~~',replies.user_id,'~~~',replies.post_id) AS replies
                              FROM posts
                                LEFT JOIN replies ON posts.id = replies.post_id
                                INNER JOIN users AS pusers ON posts.user_id = pusers.id
                                LEFT JOIN users AS rusers ON replies.user_id = rusers.id
                              GROUP BY posts.id
                              ORDER BY posts.id DESC, replies.id DESC";

            $query_result = $this->db->query($select_query)->result_array();
            
            if(!$query_result){
                throw new Exception('Failed to get post records');
            }

            $result['result'] = $query_result;
        }catch(Exception $e){
            $result['status']   = false;
            $result['message']  = $e->getMessage();
        }finally{
            return $result;
        }
    }

    public function create($user_id, $post){
        try{
            $result = ['status'=>true, 'result'=>[], 'message'=>'Success'];

            $insert_query = "INSERT INTO `posts` (`user_id`, `content`) VALUES (?, ?)";
            $query_result = $this->db->query($insert_query, [$user_id, $post['content']]);
            
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

    public function destroy($post_id){
        try{
            $result = ['status'=>true, 'result'=>[], 'message'=>'Success'];

            $delete_post_replies_query = "DELETE FROM `replies` WHERE (`post_id` = ?)";
            $delete_post_replies_query_result = $this->db->query($delete_post_replies_query, $post_id);

            $delete_query = "DELETE FROM `posts` WHERE (`id` = ?)";
            $query_result = $this->db->query($delete_query, $post_id);
            
            if(!$query_result || !$delete_post_replies_query_result){
                throw new Exception('Failed to delete a post');
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