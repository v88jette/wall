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