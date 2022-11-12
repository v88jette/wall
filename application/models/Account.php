<?php

class Account extends CI_Model {

	/**
	 * DOCU: This function will process the login form
	 * Created at: Nov 1 2022
	 * @author: v88jet
    */
	public function process_login($data){
        $result = ['status' => true, 'result' => null, 'message' => ''];
        try{
            $user_id = 1;
            $result['result'] = $user_id;
        }catch(Exception $e){   
            $result['status']   = false;
            $result['message']  = $e->getMessage();
        }finally{
            return $result;
        }
	}

    /**
	 * DOCU: This function will process the signup form
	 * Created at: Nov 1 2022
	 * @author: v88jet
    */
	public function process_signup($data){
        $result = ['status' => true, 'result' => null, 'message' => ''];
        try{
            $user_id = 1;
            $result['result'] = $user_id;
        }catch(Exception $e){   
            $result['status']   = false;
            $result['message']  = $e->getMessage();
        }finally{
            return $result;
        }
	}
}