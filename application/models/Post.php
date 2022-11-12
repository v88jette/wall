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
            $query_result = [];
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
            $query_result = [];
            $result['result'] = $query_result;
        }catch(Exception $e){   
            $result['status']   = false;
            $result['message']  = $e->getMessage();
        }finally{
            return $result;
        }
	}
}